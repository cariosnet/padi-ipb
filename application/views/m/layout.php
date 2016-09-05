<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<title><?php echo $pageTitle;?></title>
	
	<link rel="shortcut icon" href="<?php echo $this->config->item('layout_front') ?>images/logo-icon.png" type="image/x-icon" />
	<?php 
		if(isset($meta_desc))echo "<meta name='description' content='".$meta_desc."' />";else echo "<meta name='description' content='".$this->bogcamp->getSetting(3)."' />";
		if(isset($meta_key))echo "<meta name='keywords' content='".$meta_key."' />";else echo "<meta name='keywords' content='".$this->bogcamp->getSetting(4)."' />";
	?>
	
	<meta property="fb:admins" content="<?php echo $this->bogcamp->getSetting(8);?>" />
	<meta property="fb:app_id" content="<?php echo $this->bogcamp->getSetting(7);?>" /> 
	
	<meta name="alexaVerifyID" content="l1Tx8_LUvMgaxSyJNJ3Q6OHpkyY" />
	
	<!-- Style -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_mobile');?>css/style.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_css');?>uibutton.css">
	
	<!-- jQuery -->
	<script src="<?php echo $this->config->item('layout_front');?>js/jquery-1.7.2.min.js"></script>
	
	<!-- Js -->
	<script type="text/javascript">
    	$(document).ready(function(){
    		getServerTime();
        });

    	//Server Time
		function getServerTime(){
			$.ajax({
		        url: "<?php echo site_url('services/server_time')?>",
		        success: function(response){
		        	if(response.tanggal != ""){
			        	var hari = response.hari;
		        		var tanggal = response.tanggal;
		        		var waktu = response.waktu.split(":");
		        		
		        		var jam = waktu[0];
		    	    	var menit = waktu[1];
		    	    	var detik = waktu[2];
		        		setTime(hari, tanggal, jam, menit, detik);
		        	}
		        },
		        type: "post", 
		        dataType: "json"
		    }); 
		} 
	    
	    function setTime(hari, tanggal, jam, menit, detik){
	    	if(detik == 60){
	    		menit = parseFloat(menit) +1;
	    		detik = 0;
	    	}
	    	if(menit == 60){
	    		jam = parseFloat(jam) +1;
	    		menit = 0;
	    	}
	    	if(jam == 24){
	    		jam = 0;
	    	}
	    	
	    	if(detik.toString().length == 1)detik = "0" + detik;
	    	if(menit.toString().length == 1)menit = "0" + menit;
	    	if(jam.toString().length == 1)jam = "0" + jam;
	    	
	    	var waktu = jam + ":" + menit + ":" + detik;
	    	var serverTime = hari + ", " +tanggal + " | " + waktu;
	    	$('#time').html(serverTime);

	    	hari = hari.replace("'", "\\'");
	    	setTimeout("setTime('"+hari+"', '"+tanggal+"', '" + parseFloat(jam) + "', '" + parseFloat(menit) + "', '" + (parseFloat(detik)+1) + "')",1000);
	    }
    </script>
</head>
<body>
	<header>
		<div class="logo">
			<img alt="Logo Klikpositif" src="<?php echo $this->config->item('layout_mobile');?>images/logo_atas.png">
		</div>
		<div id="time" class="server_time"></div>
		
<!-- 		<div class="ads_header"> -->
<!-- 			<img alt="Ads Klikpositif" width="140px" src="http://www.placehold.it/150x40/EFEFEF/AAAAAA&amp;text=No+Image+Available"> -->
<!-- 		</div> -->
		
	</header>
	
	<!-- Navigation -->
	<nav>
		<ul>
			<li><a href="<?php echo site_url('m/home')?>">Home</a></li>
			<?php foreach ($this->X_News_Category_Model->getListCat()->result() as $mainMenu):?>
				<li id="<?php echo "mainMenu-".$mainMenu->ID?>">
					<a <?php if($mainMenu->COLOR != "")echo 'style="background: '.$mainMenu->COLOR.'"'?> href="<?php echo site_url('m/kanal/'.$mainMenu->CAT_ALIAS)?>"><?php echo $mainMenu->CAT_NAME?></a>
				</li>
			<?php endforeach;?>
		</ul>
	</nav>
	
	<!-- Content -->
	<?php echo $this->load->view($content, $contentData);?>
	<!-- End of Content -->
	
	<div class="search">
		<form action="<?php echo site_url('m/search')?>" method="get">
	    	<input type="text" name="q" style=" width: 200px; height: 16px;" placeholder="Pencarian KlikPositif.." />
	        <input type="submit" value="" class="search_button" />
	    </form>
	</div>
	
	<!-- Footer -->
	<footer>
		<div class="logo">
			<img alt="Logo Klikpositif" width="140px" src="<?php echo $this->config->item('layout_mobile');?>images/logo_bawah.png">
		</div>
		<ul class="foot_menu">
			<?php if($this->agent->is_mobile()):?>
			<li><a href="<?php echo site_url(substr($this->uri->uri_string(), 2))."?version=desktop";?>" style="color: #ff7903; font-weight: bold;">Versi Desktop</a></li>
			<?php endif;?>
					
			<?php foreach ($this->bogcamp->getListPages()->result() as $footMenu):?>
			<li><a href="<?php echo site_url('m/pages/'.$footMenu->ALIAS)?>"><?php echo $footMenu->TITLE?></a></li>
			<?php endforeach;?>
					
			<li><a href="<?php echo site_url('indeks')?>">Indeks</a></li>
		</ul>
		<div class="copyright">Copyright &copy; 2013 KlikPositif.com. All Right Reserved</div>
	</footer>
	
	<!-- Facebook SDK -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $this->bogcamp->getSetting(7);?>";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<!-- Google Analitics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-40277333-1', 'klikpositif.com');
	  ga('send', 'pageview');
	
	</script>
</body>
</html>