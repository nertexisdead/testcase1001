<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cars;

use App\Exports\InvoiceExport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Auth;
use Session;
use DB;
use DateTime;
use File;
use Storage;
use Cache;
use Hash;
use Mail;
use Carbon\Carbon;
use DatePeriod;
use DateInterval;

use Excel;



class AdminController extends Controller
{

	protected $vars = array();

    public function __construct()
    {
		$this->middleware('auth');
    }

	public function index()
    {
        $user = Auth::user();

        $this->vars['user']=$user;

		return view('adm.index')->with($this->vars)->render();
    }

    public function personal(Request $request)
    {
        $user = Auth::user();

        $query = Cars::whereJsonContains('roles', $user->role);

        $model = $request->input('model');
        $role = $request->input('role');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        if ($model) {
            $query->where('model', 'like', '%' . $model . '%');
        }
        if ($role) {
            $query->whereJsonContains('roles', $role);
        }
        if ($start_time && $end_time) {
            $query->whereBetween('time', [$start_time, $end_time]);
        }

        $cars = $query->get();

        $this->vars['user'] = $user;
        $this->vars['cars'] = $cars;

        return view('adm.personal')->with($this->vars)->render();
    }

    public function select_time(Request $request)
    {
        $selectedTime = $request->time;
        $user = Auth::user();

        $userRole = $user->role;

        $cars = Cars::where('id', '>', 0)
                    ->whereJsonContains('roles', $userRole)
                    ->orderBy('id', 'ASC')
                    ->get();

        $content = '<div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Модель машины</th>
                                    <th>Время</th>
                                    <th>Занято/Не занято</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($cars as $c) {

                                $isCheckedAndDisabled = ($c->user_id != null) ? 'checked disabled' : '';

                                if ($c->time > $selectedTime) {
                                    $content .= '<tr>
                                                    <td>' . $c->model . '</td>
                                                    <td>' . $c->time . '</td>
                                                    <td><input type="checkbox" class="check_car" name="check_car" data-id="' . $c->id . '" ' . $isCheckedAndDisabled . '></td>
                                                </tr>';
                                }
                            }
        $content .= '</tbody>
                    </table>
                </div>';

        $data = [
            'user' => $user,
            'content' => $content,
        ];

        return response()->json($data);
    }

    public function update_car_availability(Request $request)
    {
        $carId = $request->car_id;

        // Получаем текущего пользователя
        $userId = Auth::id();

        // Находим машину по идентификатору
        $car = Cars::where('id', $carId)->first();

        // Проверяем, была ли найдена машина
        if ($car) {
            // Если машина найдена, присваиваем ей идентификатор пользователя
            $car->user_id = $userId;
            $car->save();

            return response()->json(['message' => 'Информация о занятости машины обновлена']);
        } else {
            // Если машина не найдена, возвращаем сообщение об ошибке
            return response()->json(['error' => 'cars not found'], 404);
        }
    }


/*
========================= adm cars crud =========================
*/

	public function cars_for_adm_list(Request $request)
	{
		$cars=Cars::where('id','>',0)->orderBy('id','ASC')->get();

        $user = Auth::user();

        $this->vars['user']=$user;
		$this->vars['cars']=$cars;

		return view('adm.cars.list')->with($this->vars)->render();
	}

	public function cars_for_adm_new(Request $request)
	{
        $user = Auth::user();

        $this->vars['user']=$user;

		return view('adm.cars.new')->with($this->vars)->render();
	}

	public function cars_for_adm_save(Request $request)
	{

		$cars=new Cars;

		$cars->model=$request->model;
        $cars->time=$request->time;
		$cars->roles=json_encode($request->roles);

		$cars->save();

		return  redirect('/admin/cars_for_adm');

	}

    public function cars_for_adm_edit(Request $request, $id)
	{

		$cars=Cars::whereId($id)->first();
        $user = Auth::user();

        $this->vars['user']=$user;
        $this->vars['cars']=$cars;


		return view('adm.cars.edit')->with($this->vars)->render();

	}

    public function cars_for_adm_update(Request $request)
	{

		$cars=Cars::where('id', $request->cars_id)->first();

		$cars->model=$request->model;
        $cars->time=$request->time;
		$cars->roles=json_encode($request->roles);

		$cars->save();

		return  redirect('/admin/cars_for_adm');

	}

    public function cars_for_adm_remove(Request $request)
	{

		$cars=Cars::whereId($id)->first();

		$cars->delete();

		return  redirect('/admin/cars_for_adm');

	}

    /*
========================= drivers =========================
*/

	public function drivers_list(Request $request)
	{
		$users=User::where('id','>',0)->orderBy('id','ASC')->get();

        $user = Auth::user();

        $this->vars['user']=$user;
		$this->vars['users']=$users;

		return view('adm.drivers.list')->with($this->vars)->render();
	}

	public function drivers_new(Request $request)
	{
        $user = Auth::user();

        $this->vars['user']=$user;

		return view('adm.drivers.new')->with($this->vars)->render();
	}

	public function drivers_save(Request $request)
	{

		$user=new User;

		$user->name=$request->name;
        $user->role=$request->role;
		$user->login=$request->login;
        $user->password=Hash::make($request->password);
        $user->pwd=$request->password;


		$user->save();

		return  redirect('/admin/drivers');

	}

    public function drivers_edit(Request $request, $id)
	{

		$users=User::whereId($id)->first();
        $user = Auth::user();

        $this->vars['user']=$user;
        $this->vars['users']=$users;


		return view('adm.drivers.edit')->with($this->vars)->render();

	}

    public function drivers_update(Request $request)
	{

		$user=User::where('id', $request->users_id)->first();

		$user->name=$request->name;
        $user->role=$request->role;
		$user->login=$request->login;
        $user->password=Hash::make($request->password);
        $user->pwd=$request->password;

		$user->save();

		return  redirect('/admin/drivers');

	}

    public function drivers_remove(Request $request)
	{

		$user=Cars::whereId($id)->first();

		$user->delete();

		return  redirect('/admin/drivers');

	}

}
