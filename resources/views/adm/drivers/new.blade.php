@extends('adm.layouts.app')

@section('content')

<style>
    .select2-container {
        width: 1053px!important;
    }

    .selection {
        width: 100%;
    }
</style>

<form id="user_new_form" action="{{env('APP_URL')}}/admin/drivers/save" method="post" enctype="multipart/form-data" >

	 @csrf

	<div class="px-lg-5 px-2" >

		<div class="card card-border-info pt-3" >

			<div class="card-header bg-info">

				<div class="row">
					<div class="col-12">
						<p class="h4 mt-2 text-dark" ><i class="mdi mdi-account-plus pr-1"></i>Добавление нового водителя</p>
					</div>
				</div>



			</div>

			<div class="card-body" >


				<div class="row my-lg-3 my-lg-3 my-2" >

					<div class="col-12 col-lg-7 pt-3" >
						<p class="h6" >Имя <span class="text-info">*</span></p>
						<input id="name" class="form-control" name="name" placeholder="Имя водителя" required >
					</div>

				</div>

                <div class="row my-lg-3 my-lg-3 my-2" >

					<div class="col-12 col-lg-7 pt-3" >
						<p class="h6" >Должность <span class="text-info">*</span></p>
						<select name="role" id="role" class="form-control">
                            <option value="grand_master">Grand Master</option>
                            <option value="master">Master</option>
                            <option value="middle">Middle</option>
                            <option value="junior">Junior</option>
                        </select>
					</div>

				</div>

                <div class="row my-lg-3 my-lg-3 my-2" >

					<div class="col-12 col-lg-7 pt-3" >
						<p class="h6" >Логин <span class="text-info">*</span></p>
						<input id="name" class="form-control" name="login" placeholder="Логин" required >
					</div>

				</div>

                <div class="row my-lg-3 my-lg-3 my-2" >

					<div class="col-12 col-lg-7 pt-3" >
						<p class="h6" >Пароль <span class="text-info">*</span></p>
						<input id="name" class="form-control" name="password" placeholder="Пароль" required >
					</div>

				</div>



				<div class="row my-3 my-lg-5" >
					<div class="col-12" >
						<div class="d-lg-flex justify-content-start" >
							<a class="btn btn-outline-secondary" href="{{env('APP_URL')}}/admin/drivers" >Отмена</a>
							<button type="submit" class="btn btn-primary ml-3" ><i class="mdi mdi-check pr-2"></i>Создать</button>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>

</form>

<script>
  $(document).ready(function() {
    $('#roles').select2();
  });
</script>

@endsection
