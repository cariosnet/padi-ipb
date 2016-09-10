<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<title>BackOffice | <?php echo $pageTitle;?></title>
	
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/jquery-ui.css">
	<!-- jQuery UI Theme -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/jquery.ui.theme.css">
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/bootstrap-responsive.min.css">
	<!-- small charts plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/jquery.easy-pie-chart.css">
	<!-- calendar plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/fullcalendar.css">
	<!-- Calendar printable -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/fullcalendar.print.css" media="print">
	<!-- chosen plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/chosen.css">
	<!-- CSS for Growl like notifications -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/jquery.gritter.css">
	
	<!-- timepicker plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/bootstrap-timepicker.min.css">
	<!-- multi select plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/multi-select.css">
	<!-- colorpicker plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/colorpicker.css">
	<!-- MultiUpload plupload plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/jquery.plupload.queue.css">
	<!-- MultiUpload plupload plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/jquery.plupload.queue.css">
	<!-- WYSIWYG plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/jquery.cleditor.css">
	<!-- Uniform plugin -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/uniform.default.min.css">
	
	<!-- Theme CSS -->
	<!--[if !IE]> -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/style.css">
	<!-- <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_back');?>css/style_ie.css">
	<![endif]-->
	
	<!-- jQuery -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.min.js"></script>
	<!-- Old jquery functions -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.migrate.min.js"></script>
	<!-- smoother animations -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.easing.min.js"></script>
	<!-- jQuery UI Core -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.ui.core.min.js"></script>
	<!-- jQuery UI Widget -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.ui.widget.min.js"></script>
	<!-- jQuery UI button -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.ui.button.min.js"></script>
	<!-- jQuery UI Spinner -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.ui.spinner.min.js"></script>
	<!-- jQuery UI Mouse -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.ui.mouse.min.js"></script>
	<!-- jQuery UI slider -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.ui.slider.min.js"></script>

	<!-- Bootstrap -->
	<script src="<?php echo $this->config->item('layout_back');?>js/bootstrap.min.js"></script>
	<!-- calendar plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/fullcalendar.min.js"></script>
	<!-- chosen plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/chosen.jquery.min.js"></script>
	<!-- Scrollable navigation -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.nicescroll.min.js"></script>
	<!-- Growl Like notifications -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.gritter.min.js"></script>
	<!-- dataTables plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.dataTables.min.js"></script>
	<!-- File upload plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/bootstrap-fileupload.js"></script>
	<!-- Form plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.form.min.js"></script>
	<!-- Validation plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.validate.min.js"></script>
	<!-- Additional methods for validation plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/additional-methods.min.js"></script>
	<!-- timerpicker plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/bootstrap-timepicker.min.js"></script>
	<!-- multi select plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.multi-select.min.js"></script>
	
	<!-- colorpicker plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/bootstrap-colorpicker.min.js"></script>
	<!-- multiUpload plupload plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/plupload.full.min.js"></script>
	<!-- multiUpload plupload plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.plupload.queue.min.js"></script>
	<!-- WYSIWYG plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.cleditor.min.js"></script>
	<!-- file upload plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/bootstrap-fileupload.min.js"></script>
	<!-- Uniform plugin -->
	<script src="<?php echo $this->config->item('layout_back');?>js/jquery.uniform.min.js"></script>

	<!-- BootStrap Datepicker -->
	<script src="<?php echo $this->config->item('ext_js');?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo $this->config->item('ext_js');?>plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.id.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/bootstrap-datepicker/css/datepicker.css">
	
	<!-- Just for demonstration -->
	<script src="<?php echo $this->config->item('layout_back');?>js/demonstration.min.js"></script>
	<!-- Theme framework -->
	<script src="<?php echo $this->config->item('layout_back');?>js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo $this->config->item('layout_back');?>js/application.min.js"></script>

	<!-- FaceBox -->
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_css');?>uibutton.css">
	<script src="<?php echo $this->config->item('ext_js');?>plugins/lightbox/facebox.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/lightbox/facebox.css">
	
	<script src="<?php echo $this->config->item('ext_js');?>apps.js"></script>
	
	<!-- Custom Scripts -->
	<style type="text/css">
		.table tr td{
			margin: 0px;
			padding-top: 0px;
			padding-bottom: 0px;
			vertical-align: middle;
		}
		
		.center{
			text-align: center;
		}
	</style>
</head>

<body data-layout="fixed">
	<div id="top"> 
		<div class="container-fluid">
			<div class="pull-left">
				<a href="<?php echo site_url('backoffice')?>" id="brand"><span></span>IPB 3S</a>
				<div class="collapse-me">
					<!-- <a href="#" class="button">
						<i class="icon-comments icon-white"></i>
						Komentar Baru
						<span class="badge badge-info">3</span>
					</a>
					<a href="messages.html" class="button">
						<i class="icon-warning-sign icon-white"></i>
						Spam
						<span class="badge badge-important">21</span>
					</a>
					<a href="messages.html" class="button">
						<i class="icon-trash icon-white"></i>
						Trash Komentar
						<span class="badge badge-default">21</span>
					</a> -->
				</div>
			</div>
			
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="button dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-user"></i><?php echo $this->session->userdata('FULLNAME')?><span class="caret"></span></a>
					<div class="dropdown-menu pull-right">
						<div class="right-details">
							<h6>Logged in as</h6>
							<span class="name"><a href="<?php echo site_url('backoffice/profile')?>"><?php echo $this->session->userdata('USERNAME')?></a></span>
							<a target="_blank" href="<?php echo base_url()."docs/docs-admin.pdf"?>" class="highlighted-link">Butuh Bantuan?</a>
							<ul>
								<li>
									<a href="<?php echo site_url('backoffice/profile/edit')?>">Ubah Profile</a>
								</li>
								<li>
									<a href="<?php echo site_url();?>" target="_blank">Ke Halaman Depan</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<a href="<?php echo site_url('auth/users/logout')?>" class="button">
					<i class="icon-signout"></i>
					Keluar
				</a>
			</div>
		</div>
	</div>

	<div id="main">
		<div id="navigation">
			<div class="search">
				
			</div>

			<ul class="mainNav" data-open-subnavs="multi">
				<li id="menu-home"><a href="<?php echo site_url('backoffice/home')?>"><i class="icon-home icon-white"></i><span>Dashboard</span></a></li>
				
				<li id="menu-news">
					<a href="#"><i class="icon-edit icon-white"></i><span>Berita</span></a>
					<ul class="subnav">
						<li id="submenu-news-list"><a href="<?php echo site_url('backoffice/news')?>">Daftar Berita</a></li>
						<li id="submenu-news-create"><a href="<?php echo site_url('backoffice/news/create')?>">Buat Berita</a></li>
						<li id="submenu-newscat-list"><a href="<?php echo site_url('backoffice/news_properties/index/1')?>">Kategori Berita</a></li>
					</ul>
				</li>
				<li id="menu-artikel2">
				<a href="#"><i class="icon-file icon-white"></i><span>Artikel</span></a>
					<ul class="subnav">
						<li id="submenu-artikel-list2"><a href="<?php echo site_url('backoffice/artikel/page/2')?>">Daftar Artikel</a></li>
						<li id="submenu-artikel-create2"><a href="<?php echo site_url('backoffice/artikel/create/2')?>">Buat Artikel</a></li>
						<li id="submenu-artikelcat-list2"><a href="<?php echo site_url('backoffice/news_properties/index/2')?>">Kategori Artikel</a></li>
					</ul>
				</li>
				<!--<li id="menu-artikel3">
				<a href="#"><i class="icon-file icon-white"></i><span>Referensi</span></a>
					<ul class="subnav">
						<li id="submenu-artikel-list3"><a href="<?php /*echo site_url('backoffice/artikel/page/3')*/?>">Daftar Referensi</a></li>
						<li id="submenu-artikel-create3"><a href="<?php /*echo site_url('backoffice/artikel/create/3')*/?>">Buat Referensi</a></li>
						<li id="submenu-artikelcat-list3"><a href="<?php /*echo site_url('backoffice/news_properties/index/3')*/?>">Kategori Referensi</a></li>
					</ul>
				</li>
				<li id="menu-artikel4">
				<a href="#"><i class="icon-file icon-white"></i><span>Wisata Pulau</span></a>
					<ul class="subnav">
						<li id="submenu-artikel-list4"><a href="<?php /*echo site_url('backoffice/artikel/page/4')*/?>">Daftar</a></li>
						<li id="submenu-artikel-create4"><a href="<?php /*echo site_url('backoffice/artikel/create/4')*/?>">Buat Baru</a></li>
						<li id="submenu-artikelcat-list4"><a href="<?php /*echo site_url('backoffice/news_properties/index/4')*/?>">Kategori</a></li>
					</ul>
				</li>
				<li id="menu-artikel5">
				<a href="#"><i class="icon-file icon-white"></i><span>Serba-Serbi Pulau</span></a>
					<ul class="subnav">
						<li id="submenu-artikel-list5"><a href="<?php /*echo site_url('backoffice/artikel/page/5')*/?>">Daftar</a></li>
						<li id="submenu-artikel-create5"><a href="<?php /*echo site_url('backoffice/artikel/create/5')*/?>">Buat Baru</a></li>
						<li id="submenu-artikelcat-list5"><a href="<?php /*echo site_url('backoffice/news_properties/index/5')*/?>">Kategori</a></li>
					</ul>
				</li>
				<li id="menu-artikel6">
				<a href="#"><i class="icon-file icon-white"></i><span>PPKT</span></a>
					<ul class="subnav">
						<li id="submenu-artikel-list6"><a href="<?php /*echo site_url('backoffice/artikel/page/6')*/?>">Daftar</a></li>
						<li id="submenu-artikel-create6"><a href="<?php /*echo site_url('backoffice/artikel/create/6')*/?>">Buat Baru</a></li>
						<li id="submenu-artikelcat-list6"><a href="<?php /*echo site_url('backoffice/news_properties/index/6')*/?>">Kategori</a></li>
					</ul>
				</li>-->
				<!--<li id="menu-artikel8">
				<a href="#"><i class="icon-file icon-white"></i><span>Produk</span></a>
					<ul class="subnav">
						<li id="submenu-artikel-list8"><a href="<?php /*echo site_url('backoffice/artikel/page/8')*/?>">Daftar</a></li>
						<li id="submenu-artikel-create8"><a href="<?php /*echo site_url('backoffice/artikel/create/8')*/?>">Buat Baru</a></li>
						<li id="submenu-artikelcat-list8"><a href="<?php /*echo site_url('backoffice/news_properties/index/8')*/?>">Kategori</a></li>
					</ul>
				</li>-->

                <li id="menu-wilayah">
				<a href="#"><i class="icon-file icon-white"></i><span>Data Sebaran</span></a>
					<ul class="subnav">
						<li id="submenu-artikel-list8"><a href="<?php echo site_url('backoffice/wilayah')?>">Daftar Wilayah</a></li>
						<li id="submenu-artikel-create8"><a href="<?php echo site_url('backoffice/sebaran')?>">Daftar Sebaran</a></li>
					</ul>
				</li>

                <li id="menu-lembaga"><a href="<?php echo site_url('backoffice/institution')?>"><i class="icon-file-alt icon-white"></i><span>Institusi/Lembaga</span></a></li>
                <li id="menu-stok"><a href="<?php echo site_url('backoffice/stok')?>"><i class="icon-file-alt icon-white"></i><span>Stok</span></a></li>
                <li id="menu-penangkar"><a href="<?php echo site_url('backoffice/penangkar')?>"><i class="icon-file-alt icon-white"></i><span>Penangkar</span></a></li>
				<li id="menu-agenda"><a href="<?php echo site_url('backoffice/agenda')?>"><i class="icon-calendar icon-white"></i><span>Agenda</span></a></li>
				<li id="menu-program"><a href="<?php echo site_url('backoffice/program')?>"><i class="icon-lock icon-white"></i><span>Aplikasi Terkait</span></a></li>
				<li id="menu-pages"><a href="<?php echo site_url('backoffice/pages')?>"><i class="icon-file-alt icon-white"></i><span>Menu</span></a></li>
				<li id="menu-link">
				<a href="#"><i class="icon-tags icon-white"></i><span>Link Terkait</span></a>
					<ul class="subnav">
						<li id="submenu-link"><a href="<?php echo site_url('backoffice/link')?>">Daftar Link</a></li>
						<li id="submenu-kategorilink"><a href="<?php echo site_url('backoffice/link/kategori')?>">Kategori Link</a></li>
					</ul>
				</li>
				<!--<li id="menu-dokumen">
				<a href="#"><i class="icon-folder-open icon-white"></i><span>Regulasi</span></a>
					<ul class="subnav">
						<li id="submenu-regulasi"><a href="<?php /*echo site_url('backoffice/regulasi')*/?>">Daftar Regulasi</a></li>
						<li id="submenu-dokumen"><a href="<?php /*echo site_url('backoffice/dokumen')*/?>">Dokumen</a></li>
						<li id="submenu-produk"><a href="<?php /*echo site_url('backoffice/produk')*/?>">Produk</a></li>
						<li id="submenu-dokumen-kategori"><a href="<?php /*echo site_url('backoffice/news_properties/index/7')*/?>">Kategori Regulasi</a></li>
					</ul>
				</li>-->
				<li id="menu-potogal">
                    <a href="#"><i class="icon-picture icon-white"></i><span>Galeri</span></a>
                    <ul class="subnav">
						<li id="submenu-foto-list"><a href="<?php echo site_url('backoffice/potogal')?>">Daftar Galeri Foto</a></li>
						<li id="submenu-kategfoto-list"><a href="<?php echo site_url('backoffice/potogal/kateg')?>">Kategori Foto</a></li>
					</ul>
                </li>
				<li id="menu-adm">
					<a href="#"><i class="icon-cogs icon-white"></i><span>Administrasi</span><span class="label">3</span></a>
					<ul class="subnav">
						<li id="submenu-users-list"><a href="<?php echo site_url('backoffice/users')?>">Pengguna Backoffice</a></li>
						<li id="submenu-setting-list"><a href="<?php echo site_url('backoffice/setting')?>">Pengaturan</a></li>
						<li><a href="<?php echo base_url('forum')?>" target="_blank">Ke Forum</a></li>
					</ul>
				</li>      
			</ul>
			<div class="status button">
				<div class="status-top">
					Copyright &copy; 2013
				</div>
				<div class="status-bottom">
					
				</div>
			</div>
		</div>
		<div id="content">
			<!-- Content -->
			<?php echo $this->load->view($content, $contentData);?>
			<!-- End of Content -->
		</div>
	</div>
	<div class="navi-functions">
		<div class="btn-group btn-group-custom">
			<a href="avascript:void(0)" class="button button-square layout-not-fixed notify" rel="tooltip" title="Toggle fixed-nav" data-notify-message="Fixed nav is now {{state}}" data-notify-title="Toggled fixed nav">
				<i class="icon-unlock"></i>
			</a>
			<a href="javascript:void(0)" class="button button-square layout-not-fluid notify button-active" rel="tooltip" title="Toggle fixed-layout" data-notify-message="Fixed layout is now {{state}}" data-notify-title="Toggled fixed layout">
				<i class="icon-exchange"></i>
			</a>
			
			<!--
			<a href="#" class="button button-square toggle-active notify" rel="tooltip" title="Toggle Automatic data refresh" data-notify-message="Automatic data-refresh is now {{state}}" data-notify-title="Toggled automatic data refresh">
				<i class="icon-refresh"></i>
			</a>
			<a href="#" class="button button-square button-active force-last notify-toggle toggle-active notify" rel="tooltip" title="Toggle notification"  data-notify-message="Notifications turned {{state}}" data-notify-title="Toggled notifications">
				<i class="icon-bullhorn"></i>
			</a> 
			-->
		</div>
	</div>
</body>

</html>