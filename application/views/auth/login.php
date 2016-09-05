<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<!--[if !IE]> -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/style.css">
	<!-- <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/style_ie.css">
	<![endif]-->

	<!-- jQuery -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $this->config->item('layout_back');?>js/bootstrap.min.js"></script>
	
	<!-- FaceBox -->
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_css');?>uibutton.css">
	<script src="<?php echo $this->config->item('ext_js');?>plugins/lightbox/facebox.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/lightbox/facebox.css">
	
	<script src="<?php echo $this->config->item('ext_js');?>apps.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var alert = '<?php echo $alert;?>';
			if(alert==1)alertPopUp('Kesalahan', 'Username / Password anda salah.. Silahkan ulangi', 'OK');
			if(alert==2)alertPopUp('Kesalahan', 'Maaf.. Akun anda dinonaktifkan...<br />Hubungi Administrator untuk info lebih lanjut', 'OK');

			<?php if($this->session->flashdata('error') != null){?>
				alertPopUp('Kesalahan', '<?php echo $this->session->flashdata('error'); ?>', 'Tutup');
	    	<?php }else if($this->session->flashdata('information') != null){?>
	    		alertPopUp('Informasi', '<?php echo $this->session->flashdata('information'); ?>', 'Tutup');
	    	<?php }?>
		});
	</script>
	
	<style type="text/css">
		body, html{
			background:-webkit-gradient(radial, 50% 50%, 0, 50% 50%, 100, color-stop(0%, #eeeeee), color-stop(100%, #aaaaaa));background:-webkit-radial-gradient(#eeeeee,#aaaaaa);background:-moz-radial-gradient(#eeeeee,#aaaaaa);background:-o-radial-gradient(#eeeeee,#aaaaaa);background:radial-gradient(#eeeeee,#aaaaaa);
		}
	</style>
</head>
<body class='login-body'>
	<div class="login-wrap">
		<h2>Login</h2>
		<div class="login">
			<form action="<?php echo site_url('auth/users/login')?>" method="POST">
<!-- 				<a href="#" class='button button-basic-blue button-less-round'>Connect with <span>Facebook</span></a> -->
<!-- 				<a href="#" class='button button-basic-blue button-less-round button-twitter'>Connect with <span>Twitter</span></a> -->
				<div class="sep">o</div>
				<div class="email"><input type="text" name="username" placeholder="Username" class='input-block-level'></div>
				<div class="pw">
					<input type="password" name="password" placeholder="Password" class='input-block-level'>
				</div>
				<button type="submit" value="Sign In" name="login" class='button button-basic-darkblue btn-block'>Sign In</button>
			</form>
		</div>
		<a href="javascript:alertPopUp('Bantuan', 'Silahkan hubungi Administrator untuk mendapatkan password baru', 'Tutup');;" class='pw-link'>Lupa <span>password</span>? <i class="icon-arrow-right"></i></a>
	</div>
</body>

</html>