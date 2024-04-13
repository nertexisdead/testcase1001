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

<form id="user_new_form" action="{{env('APP_URL')}}/admin/cars_for_adm/update" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="cars_id" value="{{ $cars->id }}">

	 @csrf

	<div class="px-lg-5 px-2" >

		<div class="card card-border-info pt-3" >

			<div class="card-header bg-info">

				<div class="row">
					<div class="col-12">
						<p class="h4 mt-2 text-dark" ><i class="mdi mdi-account-plus pr-1"></i>Редактирование машины</p>
					</div>
				</div>



			</div>

			<div class="card-body" >


				<div class="row my-lg-3 my-lg-3 my-2" >

					<div class="col-12 col-lg-7 pt-3" >
						<p class="h6" >Модель <span class="text-info">*</span></p>
						<input id="name" class="form-control" name="model" placeholder="Название модели" value="{{ $cars->model }}" >
					</div>

				</div>

                <div class="row my-lg-3 my-lg-3 my-2" >

					<div class="col-12 col-lg-2 pt-3" >
						<p class="h6" >Время поездки <span class="text-info">*</span></p>
						<input type="time" class="form-control" name="time" value="{{ $cars->time }}" >
					</div>

				</div>

                <div class="row my-lg-3 my-lg-3 my-2" >

					<div class="col-12 col-lg-7 pt-3" >
						<p class="h6" >Выбор категорий которые получат доступ <span class="text-info">*</span></p>
                        <?php $roles = json_decode($cars->roles) ?>
						<select name="roles[]" id="roles" class="form-control roles" multiple>
                            <option value="grand_master" <?php if (in_array("grand_master", $roles)) echo "selected"; ?>>Grand Master</option>
                            <option value="master" <?php if (in_array("master", $roles)) echo "selected"; ?>>Master</option>
                            <option value="middle" <?php if (in_array("middle", $roles)) echo "selected"; ?>>Middle</option>
                            <option value="junior" <?php if (in_array("junior", $roles)) echo "selected"; ?>>Junior</option>
                        </select>
					</div>

				</div>



				<div class="row my-3 my-lg-5" >
					<div class="col-12" >
						<div class="d-lg-flex justify-content-start" >
							<a class="btn btn-outline-secondary" href="{{env('APP_URL')}}/admin/cars_for_adm" >Отмена</a>
							<button type="submit" class="btn btn-primary ml-3" ><i class="mdi mdi-check pr-2"></i>Сохранить</button>
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
