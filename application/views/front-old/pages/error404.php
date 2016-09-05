<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<title>Halaman Tidak Ditemukan</title>
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

</head>

<body class='error-body'>
	<div class="error-wrapper">
		<div class="number">
			<span>404</span>
			<i class="icon-warning-sign"></i>

		</div>
		<div class="description">
			Oops! Maaf, halaman yang anda minta tidak ditemukan.. ^_^.
		</div>
		<form action="<?php echo site_url('search') ?>" class='form-horizontal'>
			<div class="input-append">
				<input type="text" name="q" placeholder="Cari di sini..">
				<button type="submit" class="btn"><i class="icon-search"></i></button>
			</div>
		</form>
		<div class="buttons">
			<div class="pull-left"><a href="<?php echo site_url('home')?>" class="button button-basic"><i class="icon-arrow-left"></i> Kembali</a></div>
		</div>
	</div>
</body>

</html>

