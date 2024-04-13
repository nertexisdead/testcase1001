@extends('adm.layouts.app')

@section('content')


		<div class="px-lg-5 px-2" >

			<div class="card" style="min-height:85vh;" >
				<div class="card-body" >

					<div class="row" >

						<div class="col-12 text-center" >

							<p class="mb-0 h3 pt-5 text-danger">Добро пожаловать в административную панель!</p>
							<a class="mb-0 h6 mt-2 " href="{{env('APP_URL')}}" >Перейти на фронтальную часть сайта</a>

						</div>

					</div>

				</div>
			</div>

		</div>


@endsection
