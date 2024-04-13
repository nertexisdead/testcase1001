@extends('adm.layouts.app')

@section('content')


		<div class="px-lg-5 px-2" >

			<div class="card" style="min-height:85vh;" >
				<div class="card-body" >

					<div class="row" >

						<div class="col-12 text-center" >

							<p class="mb-0 h3 pt-5 text-danger">Личный кабинет</p>

						</div>

                        <div class="row" >
                            <div class="col-3">
                                Ваше имя: {{ $user->name }}
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-3">
                                Ваше роль: {{ $user->role }}
                            </div>
                        </div>

					</div>

                    <form action="{{ ENV('APP_URL') }}/admin/personal" method="GET">
                        <div class="row">
                            <div class="col-1 mb-3 mt-3">
                                <select name="start_time" class="form-control custom-select">
                                    <option value="">---</option>
                                    <?php
                                    for ($hour = 0; $hour < 24; $hour++) {
                                        for ($minute = 0; $minute < 60; $minute += 15) {
                                            $time = sprintf("%02d:%02d:00", $hour, $minute);
                                            echo '<option value="' . $time . '">' . $time . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-1 mb-3 mt-3">
                                <select name="end_time" class="form-control custom-select">
                                    <option value="">---</option>
                                    <?php
                                    for ($hour = 0; $hour < 24; $hour++) {
                                        for ($minute = 0; $minute < 60; $minute += 15) {
                                            $time = sprintf("%02d:%02d:00", $hour, $minute);
                                            echo '<option value="' . $time . '">' . $time . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-2 mb-3 mt-3">
                                <select name="role" id="role" class="form-control custom-select">
                                    <option value="">---</option>
                                    <option value="grand_master">Grand Master</option>
                                    <option value="master">Master</option>
                                    <option value="middle">Middle</option>
                                    <option value="junior">Junior</option>
                                </select>
                            </div>
                            <div class="col-2 mb-3 mt-3">
                                <input type="text" name="model" id="model" class="form-control">
                            </div>
                            <div class="col-1 mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                            </div>
                            <div class="col-1 mb-3 mt-3">
                                <a href="{{ ENV('APP_URL') }}/admin/personal" type="btn" class="btn btn-secondary">Cбросить</a>
                            </div>
                        </div>
                    </form>

                    <div class="row start_table" >
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Модель машины</th>
                                        <th>Доступные роли</th>
                                        <th>Время</th>
                                        <th>Занято/Не занято</th>
                                        <th>Имя водителя</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cars as $c) { ?>
                                    <tr>
                                        <td>{{ $c->model }}</td>
                                        <td>
                                            <?php
                                            $category = json_decode($c->roles);
                                            echo '<ul>';
                                                foreach ($category as $role) {
                                                    echo '<li>' . $role . '</li>';
                                                }
                                                echo '</ul>';
                                            ?>
                                        </td>
                                        <td>{{ $c->time }}</td>
                                        <td><input type="checkbox" class="check_car" name="check_car" data-id="{{ $c->id }}" <?php if ($c->user_id != null) { echo 'checked disabled'; } ?>></td>
                                        <td>
                                            <?php if($c->user_id != null) {
                                                echo $c->user->name;
                                            } else {
                                                echo '---';
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row filter_table" style="display: none" >

                    </div>

				</div>
			</div>

		</div>

<script>
    $('#time').change(function() {
        var selectedTime = $(this).val();
        $.ajax({
            url: '{{ route("select_time") }}',
            type: 'POST',
            data: {
                time: selectedTime,
                _token: '{{ csrf_token() }}'},
            success: function(response) {
                $('.start_table').hide();
                $('.filter_table').html(response.content).show();
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $(document).on('change', '.check_car', function() {
        var carId = $(this).data('id');

        $.ajax({
            url: '{{ route("update_car_availability") }}',
            type: 'POST',
            data: {
                car_id: carId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>

@endsection
