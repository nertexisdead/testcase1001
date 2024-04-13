@extends('adm.layouts.app')

@section('content')

	<div class="px-lg-5 px-2" >

		<div class="card" >
			<div class="card-body" >

				<div class="row" >

					<div class="col-12" >

						<a href="{{env('APP_URL')}}/admin/drivers/new" class="btn btn-info"><i class="mdi mdi-plus-circle-outline pr-2"></i>Создание водителя</a>

						<hr>

					</div>


					<div class="row">
    					<div class="col-3">
        					<p class="h5 text-uppercase font-weight-bold">Машины</p>
    					</div>
					</div>

					<div class="col-12" >
						<hr>
					</div>

				</div>
					<table class="table">

							<tr>
                                <td>#id</td>
                                <td>Имя водителя</td>
                                <td>Действия</td>
                            </tr>


                                <?php foreach ($users as $u) { ?>
                                <tr>
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>
                                        <a href="{{env('APP_URL')}}/admin/drivers/edit/{{$u->id}}" class="btn btn-warning" >Редактировать</a>
                                        <a href="{{env('APP_URL')}}/admin/drivers/remove/{{$u->id}}" class="btn btn-danger mx-2" >Удалить</a>
                                    </td>
                                </tr>
							<?php } ?>


						</table>


			</div>
		</div>

	</div>


@endsection
