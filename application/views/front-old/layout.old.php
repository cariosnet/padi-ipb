<!doctype html>
<html lang="id" dir="ltr">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<title><?php echo $pageTitle?></title>
	
	<link rel="shortcut icon" href="<?php echo $this->config->item('layout_front') ?>images/logo-icon.png" type="image/x-icon" />
	<?php 
		if(isset($meta_desc))echo "<meta name='description' content='".quotes_to_entities($meta_desc)."' />";else echo "<meta name='description' content='".quotes_to_entities($this->bogcamp->getSetting(3))."' />";
		if(isset($meta_key))echo "<meta name='keywords' content='".$meta_key."' />";else echo "<meta name='keywords' content='".$this->bogcamp->getSetting(4)."' />";
	?>
	
	<!-- Facebook SDK, Open Graph Configurations -->
	<?php 
		$fb_admins = array();
		$fb_admins = explode(",", $this->bogcamp->getSetting(8));
		
		for($i = 0; $i < count($fb_admins); $i++){
			echo '<meta property="fb:admins" content="'.$fb_admins[$i].'" />';
		}			
		unset($i)
	?>
	<meta property="fb:app_id" content="<?php echo $this->bogcamp->getSetting(7);?>" /> 
	
	<meta property="og:type"   content="article" /> 
	<meta property="og:url"    content="<?php echo $this->bogcamp->getFullUrlRequest();?>" /> 
	<meta property="og:title"  content="<?php echo $pageTitle?>" /> 
	<?php 
		if(isset($meta_desc))echo "<meta property='og:description' content='".quotes_to_entities($meta_desc)."' />";else echo "<meta property='og:description' content='".quotes_to_entities($this->bogcamp->getSetting(3))."' />";
		if(isset($og_image))echo "<meta property='og:image' content='".$og_image."' />";else echo "<meta property='og:image' content='".$this->config->item('ext_img')."icon/200x200.png' />";
	?>
	
	<meta name="alexaVerifyID" content="l1Tx8_LUvMgaxSyJNJ3Q6OHpkyY" />
	
	<!-- Style -->
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_front');?>css/base.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('layout_front');?>css/google.css">
	
	<!-- jQuery -->
	<script src="<?php echo $this->config->item('layout_front');?>js/jquery-1.7.2.min.js"></script>

	<!-- FaceBox -->
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_css');?>uibutton.css">
	<script src="<?php echo $this->config->item('ext_js');?>plugins/lightbox/facebox.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/lightbox/facebox.css">
	
	<script src="<?php echo $this->config->item('ext_js');?>apps.js"></script>
	
	<!-- BreadCumbs -->
	<script type="text/javascript" src="<?php echo $this->config->item('ext_js'); ?>plugins/breadcrumbs/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo $this->config->item('ext_js'); ?>plugins/breadcrumbs/jquery.jBreadCrumb.1.1.js"></script>
	<script type="text/javascript">
    	$(document).ready(function(){
    		$(".breadCrumb").jBreadCrumb(); 
    		getServerTime();

    		var tabContainers = jQuery('div.tab_content');
			tabContainers.hide().filter(':first').show();
			
			jQuery('div.news_tab ul a').click(function () {
				tabContainers.hide();
				tabContainers.filter(this.hash).show();
				jQuery('div.news_tab ul a').removeClass('active');
				jQuery(this).addClass('active');
				return false;
			}).filter(':first').click();
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

        function mainMenuHover(obj, color){
            $(obj).css('background', color);
    		$("nav .sub").css('background', color);

    		if($(obj).attr('class') != "active"){
        		$("ul.main_menu li.active > ul").children().css('visibility', 'hidden');
            }
        }

        function mainMenuOut(obj){
            var cssAttr = $("ul.main_menu li.active").attr('style');
        	if($(obj).attr('class') != "active"){
        		$(obj).css('background', '');
    			$("ul.main_menu li.active > ul").children().css('visibility', 'visible');
        		$("nav .sub").attr('style', cssAttr);
            }
        }

        function subMenuHover(obj, color){
            $("nav .sub").css('background', color);
        }
        
        function subMenuOut(obj){
        	var cssAttr = $("ul.main_menu li.active").attr('style');
            if($(obj).attr('class') != "active"){
            	$("ul.main_menu li.active > ul").children().css('visibility', 'visible');
        		$("nav .sub").attr('style', cssAttr);
            }
        }
    </script>
</head>
<body style="background-color: #FFF;">
<!-- 	<header> -->
<!-- 		<div class="top_bar"></div> -->
<!-- 		<div class="content"> -->
<!-- 			<div class="top_bar_menu">Positifers <a href="javascript:maintenance();">Daftar</a> &raquo; <a href="javascript:maintenance();">Masuk</a></div> -->
<!-- 			<div class="head_left"> -->
<!--				<a href="<?php echo site_url();?>" title="Home"><img alt="Logo KlikPositif" src="<?php echo $this->config->item('layout_front') ?>images/logo.png"></a>
<!-- 				<div class="head_time"><span id="time"></span> WIB</div> -->
<!-- 			</div> -->
<!-- 			<div class="head_right"> -->
<!--				<a href="https://www.facebook.com/<?php echo $this->bogcamp->getSetting(5);?>" target="_blank"><img style="height: 30px;" alt="Logo Facebook" src="<?php echo $this->config->item('layout_front') ?>images/header/fb.png" /></a>
				<a href="https://twitter.com/<?php echo $this->bogcamp->getSetting(6);?>" target="_blank"><img style="height: 30px;" alt="Logo Twitter" src="<?php echo $this->config->item('layout_front') ?>images/header/twitter.png" /></a>
<!-- 			</div> -->
<!-- 		</div> -->
		
<!-- 		<div class="clear"></div> -->
<!-- 	</header> -->
	
	<!-- Navigation -->
	<nav>
		<div class="main">
			<div class="menu_home"><a title="Menuju ke Beranda" href="<?php echo site_url();?>"><img src="<?php echo $this->config->item('layout_front') ?>images/logo-icon.png" /></a></div>
			<ul class="main_menu">
			<?php foreach ($this->X_News_Category_Model->getListCat()->result() as $mainMenu):?>
				<li onmouseout="mainMenuOut(this);" onmouseover="mainMenuHover(this, '<?php echo $mainMenu->COLOR?>')" id="<?php echo "mainMenu-".$mainMenu->ID?>">
					<a href="<?php echo site_url('kanal/'.$mainMenu->CAT_ALIAS)?>"><?php echo $mainMenu->CAT_NAME?></a>
					<?php 
						$listSub = $this->X_News_Category_Model->getListCat($mainMenu->ID);
						if($listSub->num_rows() > 0):
					?>
					<ul>
					<?php foreach ($listSub->result() as $subMenu):?>
						<li><a onmouseout="subMenuOut(this);" onmouseover="subMenuHover(this, '<?php echo $mainMenu->COLOR?>')" href="<?php echo site_url('kanal/'.$subMenu->CAT_ALIAS)?>"><?php echo $subMenu->CAT_NAME?></a></li>
					<?php endforeach;?>
					</ul>
					<?php endif;?>
				</li>
			<?php endforeach;?>
			</ul>
			
			<div class="search_simple">
				<form action="<?php echo site_url('search')?>" method="get">
	                <input type="text" name="q" style=" width: 200px;" placeholder="Pencarian..." />
	                <input type="submit" value="" class="search_button" />
	            </form>
	        </div>
		</div>
		
		<div class="sub"></div>
	</nav>
	
	<!-- Content -->
	<?php echo $this->load->view($content, $contentData);?>
	<!-- End of Content -->
	
	<!-- Footer -->
	<footer>
		<div class="wrapper">
			<div class="foot_content_wrap">
				<div class="foot_logo">
					<img src="<?php echo $this->config->item('layout_front') ?>images/footer/logo_footer.png" alt="Logo KlikPositif" />
				</div>
				<div class="social_media">
					<a href="https://www.facebook.com/<?php echo $this->bogcamp->getSetting(5);?>" target="_blank"><img class="facebook" src="<?php echo $this->config->item('layout_front') ?>images/footer/fb_icon_footer.png" alt="Logo Facebook" /></a>
					<a href="https://www.twitter.com/<?php echo $this->bogcamp->getSetting(6);?>" target="_blank"><img class="twitter" src="<?php echo $this->config->item('layout_front') ?>images/footer/twitter_icon_footer.png" alt="Logo Twitter" /></a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="foot_menu_wrap">
				<ul class="foot_menu">
					<?php if($this->agent->is_mobile()):?>
					<li><a href="<?php echo site_url($this->uri->uri_string())."?version=mobile";?>" style="color: #ff7903; font-weight: bold;">Versi Mobile</a></li>
					<?php endif;?>
					
					<?php foreach ($this->bogcamp->getListPages()->result() as $footMenu):?>
						<li><a href="<?php echo site_url('pages/'.$footMenu->ALIAS)?>"><?php echo $footMenu->TITLE?></a></li>
					<?php endforeach;?>
					
					<li><a href="<?php echo site_url('indeks')?>">Indeks</a></li>
				</ul>
				<div class="copyright">KlikPositif &copy; 2013</div>
				<div class="clear"></div>
			</div>
		</div>
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