@extends('adm.layouts.app')

@section('content')

	<div class="px-lg-5 px-2" >

		<div class="card" >
			<div class="card-body" >

				<div class="row" >

					<div class="col-12" >

						<a href="{{env('APP_URL')}}/admin/cars_for_adm/new" class="btn btn-info"><i class="mdi mdi-plus-circle-outline pr-2"></i>Создание машины</a>

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
                                <td>Модель машины</td>
                                <td>Действия</td>
                            </tr>


                                <?php foreach ($cars as $c) { ?>
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->model }}</td>
                                    <td>
                                        <a href="{{env('APP_URL')}}/admin/cars_for_adm/edit/{{$c->id}}" class="btn btn-warning" >Редактировать</a>
                                        <a href="{{env('APP_URL')}}/admin/cars_for_adm/remove/{{$c->id}}" class="btn btn-danger mx-2" >Удалить</a>
                                    </td>
                                </tr>
							<?php } ?>


						</table>


			</div>
		</div>

	</div>


@endsection
