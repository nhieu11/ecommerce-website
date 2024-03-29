<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <base href="/">
	<link href="assets/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/admin/css/datepicker3.css" rel="stylesheet">
	<link href="assets/admin/css/styles.css" rel="stylesheet">

	<!--[if lt IE 9]>
<script src="assets/admin/js/html5shiv.js"></script>
<script src="assets/admin/js/respond.min.js"></script>
<![endif]-->

</head>

<body>

	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
                <div class="panel-heading">HUST STORE LOGIN</div>

                @if (session("thongbao"))
                <div class="alert alert-danger" role="alert">
                    <strong>{{ session("thongbao") }}</strong>
                </div>
                @endif

                @if ($errors->any())
                @component('admin.layouts.components.alert')
                @slot('type', 'danger')
                @slot('stroke', 'cancel')
                {{ $errors->first() }}
                @endcomponent
                @endif

				<div class="panel-body">
					<form method="POST">
						@csrf
						<fieldset>
							<div class="form-group">
							<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" value="{{ old('email') }}">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button type="submit" class="btn btn-primary">Login</button>

						</fieldset>
							<br/>

						{{-- <div align="center" class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div> --}}
						<!-- @if($errors->has('g-recaptcha-response'))
						<span class="invalid-feedback" style="display:block">
							<strong>{{$errors->first('g-recaptcha-response')}}</strong>
						</span>
						@endif -->

					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->



	<script src="assets/admin/js/jquery-1.11.1.min.js"></script>
	<script src="assets/admin/js/bootstrap.min.js"></script>
	<script src="assets/admin/js/chart.min.js"></script>
	<script src="assets/admin/js/chart-data.js"></script>
	<script src="assets/admin/js/easypiechart.js"></script>
	<script src="assets/admin/js/easypiechart-data.js"></script>
	<script src="assets/admin/js/bootstrap-datepicker.js"></script>
	<script>
		! function ($) {
			$(document).on("click", "ul.nav li.parent > a > span.icon", function () {
				$(this).find('em:first').toggleClass("glyphicon-minus");
			});
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
			if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
			if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>
