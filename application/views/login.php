<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Area</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url()?>assets/Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/Login/css/main.css">
<!--===============================================================================================-->
<style>
	.ml12 {
	font-weight: 200;
	/* font-size: 1.8em; */
	font-size: 1em;
	text-transform: uppercase;
	letter-spacing: 0.1em;
	
	}

	.ml12 .letter {
	display: inline;
	line-height: 1em;
	}
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?=base_url()?>assets/Login/images/kampus-2013.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?= site_url('Auth/proceed')?>" method="post">
					<span class="login100-form-logo">
						<!-- <i class="zmdi zmdi-landscape"></i> -->
                        <img src="<?=base_url()?>assets/Login/images/logorounded.png" alt="" width="115px">
					</span>

					<span class="login100-form-title p-b-34 p-t-20">
                        <img src="<?=base_url()?>assets/Login/images/logoname.png" alt="" width="300px">
					</span>
					<span class="ml12 login100-form-title p-b-30">    APLIKASI VISUALISASI MANAJEMEN ASET</span>
					<p></p>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="user_name" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="user_pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">Login </button>
					</div>
				</form>		
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/Login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<!-- <script src="<?=base_url()?>assets/Login/vendor/bootstrap/js/popper.js"></script> -->
	<script src="<?=base_url()?>assets/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/Login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url()?>assets/Login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/Login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/Login/js/main.js"></script>
<!--===============================================================================================-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<script>
		// Wrap every letter in a span
		var textWrapper = document.querySelector('.ml12');
		textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

		anime.timeline({loop: true})
		.add({
			targets: '.ml12 .letter',
			translateX: [40,0],
			translateZ: 0,
			opacity: [0,1],
			easing: "easeOutExpo",
			duration: 1200,
			delay: (el, i) => 500 + 30 * i
		}).add({
			targets: '.ml12 .letter',
			translateX: [0,-30],
			opacity: [1,0],
			easing: "easeInExpo",
			duration: 1100,
			delay: (el, i) => 100 + 30 * i
		});
	</script>

</body>
</html>