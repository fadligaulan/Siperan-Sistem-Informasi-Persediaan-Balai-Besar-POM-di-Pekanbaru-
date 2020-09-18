<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login BMN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo/logo.ico'); ?>"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/bootstrap/css/bootstrap.min.css'); ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/animate/animate.css'); ?>">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/css-hamburgers/hamburgers.min.css'); ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/select2/select2.min.css'); ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/util.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/main.css'); ?>">
	<style type="text/css">
		.error {
			color: red;
		}
	</style>
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url('assets/login/images/background.jpg'); ?>">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url('assets/login/images/logobbpompku.jpg'); ?>" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="<?php echo base_url('auth/login'); ?>">
					<span class="login100-form-title">
						WELCOME TO SISTEM INFORMASI PERSEDIAAN (SIPERAN)
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="nip" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="masuk" value="login">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
					    <?= $this->session->flashdata('pesan') ?>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	

	
	<!--===============================================================================================-->	
	<script src="<?php echo base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js'); ?>"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/popper.js'); ?>"></script>
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/select2/select2.min.js'); ?>"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/tilt/tilt.jquery.min.js'); ?>"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/js/main.js'); ?>"></script>

</body>
</html>