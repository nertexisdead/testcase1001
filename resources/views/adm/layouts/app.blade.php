<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/admin_files/css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/css/normalize.css" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.css" media="screen">
	<link rel="stylesheet icon" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/css/style.css" media="screen">

    <script src="{{ ENV('APP_URL') }}/admin_files/js/ckeditor/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/jquery-3.7.0.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/jquery.maskedinput.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/script.js?v=2"></script>

</head>

<body>

    <div class="wrapper">
		<div class="row" style="height: 100%">
			<div class="col-lg-1 p-4" style="background:#eee;">
				 <a href="{{ ENV('APP_URL') }}/admin" class="header-logo d-block pb-5">
                    <img src="" alt="логотип" title="логотип">
                </a>

				<ul style="">
					<li><a href="{{ ENV('APP_URL') }}/admin/personal">Личный кабинет</a></li>
                    <?php if (isset($user) && $user->role == 'admin') { ?>
                    <li><a href="{{ ENV('APP_URL') }}/admin/cars_for_adm">Создать машину</a></li>
                    <li><a href="{{ ENV('APP_URL') }}/admin/drivers">Создать водителя</a></li>
                    <?php
                    } ?>
				</ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            {{ $user->name }}
                        </a>

                <ul class="collapse list-unstyled" id="user">
                        <a class="dropdown-item" href="{{ ENV('APP_URL') }}/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-exit-to-app pr-1"></i> Выйти
                        </a>
                        <form id="logout-form" action="{{ ENV('APP_URL') }}/logout" method="POST" class="d-none">
                            @csrf
                        </form>
                        </ul>
                    </li>
                </ul>
			</div>
			<div class="col-lg-11  pt-4">


		  @yield('content')
		  </div>

		 </div>

    </div>

</body>

</html>
