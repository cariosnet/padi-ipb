<!-- BootStrap Datepicker -->
	<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
	<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery.ui-i18n.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/css/pepper-grinder/jquery-ui-1.10.2.custom.min.css">
	
	<script type="text/javascript">
    	$(document).ready(function(){
    		$.datepicker.setDefaults($.datepicker.regional['in_ID']);
			$("#datepicker").datepicker({
				changeYear: true,
				changeMonth: true,
				dateFormat: 'dd-mm-yy',
				yearRange: '2000:2020',
				onSelect: sendFilterRequest
			});

			sendFilterRequest();
        });

    	function viewAll(){
        	$("#datepicker").val("");
        	sendFilterRequest();
        }

    	function sendFilterRequest(){
    		var loader = "<?php echo $this->config->item('ext_img').'loader/loading-git.gif' ?>";
    		
    	    jQuery.ajax({
    	        url: "<?php echo site_url('m/indeks/ajax_filter_special/fokus')?>", 
    	        data: $("#ajax_filter").serialize(),
    	        beforeSend: function(){
    	        	jQuery("#result").html('<div style="text-align: center;margin: 100px auto; font-size: 26px;"><img src="'+loader+'" /><br />Loading....</div>');
    	        },
    	        success: function(response){
    	                jQuery("#result").html(response);
    	            },
    	        type: "post", 
    	        dataType: "html"
    	    }); 

    	    return false;
    	}
    </script>
<div class="container">
	<div class="headline_wrap" style="min-height: 50px;">
		<div class="breadcrumbs">
			&raquo; Home&nbsp;
			&raquo; <a href="<?php echo site_url('m/indeks/fokus')?>">Indeks Fokus</a>&nbsp;
		</div>
		<div class="news_properties">
			<div class="content_title">Indeks Fokus</div>
		</div>
	</div>
				
	<div class="news_content">
		<form id="ajax_filter" action="<?php echo site_url('m/indeks/ajax_filter_special/fokus')?>" method="post">
			<table>
				<tr>
					<td>Tanggal</td>
						<td><input type="text" name="date" id="datepicker" style="width: 75px;" value="<?php echo date("d-m-Y")?>" />
				</tr>
				
				<tr>
					<td></td>
					<td>
						<input type="hidden" name="type" value="F" />
						<input type="hidden" name="name" value="Fokus" />
						<a href="javascript:void(0)" onclick="sendFilterRequest();" class="uibutton">Lihat Indeks</a>
						<a href="javascript:void(0)" onclick="viewAll();" class="uibutton special">Tampilkan Semua Indeks</a>	
					</td>
				</tr>
			</table>
		</form>
					
		<div id="result"></div>
	</div>
	
	<div class="content_action">
		<!-- FaceBook -->
		<div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('search')?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>
					
		<!-- Twitter  -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('search')?>" data-via="KlikPositif" data-lang="id" data-hashtags="KlikPositif">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				
		<!-- Place this tag where you want the +1 button to render. -->
		<div  class="g-plusone" data-size="medium"></div>
					
		<!-- Place this tag after the last +1 button tag. -->
		<script type="text/javascript">
			window.___gcfg = {lang: 'id'};
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
	</div>
	
	<!-- Berita Terkini -->
	<div class="list_news_title" style="background: #c93930">BERITA TERKINI</div>
	<ul class="list_news">
	<?php foreach ($listLatestNews->result() as $latest):?>
		<li>
			<a href="<?php echo site_url('m/news/read/'.$latest->NEWS_ID.'/'.$latest->ALIAS)?>" title="<?php echo $latest->NEWS_TITLE?>">
				<?php echo $this->bogcamp->substr($latest->NEWS_TITLE, 90) ?>
				<span class="list_news_time"><?php if(date('d-m-Y') == date('d-m-Y', strtotime($latest->DATE))) echo "(".date('H:i', strtotime($latest->DATE)).")";?></span>
			</a>
		</li>
	<?php endforeach;?>
	</ul>
	<div class="list_news_next"><a href="<?php echo site_url('m/indeks/fokus')?>">Indeks Fokus &raquo;</a></div>
	
	<!-- Populer -->
	<div class="list_news_title" style="background: #c93930">Populer</div>
	<ul class="list_news">
	<?php foreach ($listPopuler->result() as $populer):?>
		<li>
			<a href="<?php echo site_url('m/news/read/'.$populer->NEWS_ID.'/'.$populer->ALIAS)?>" title="<?php echo $populer->NEWS_TITLE?>">
				<?php echo $this->bogcamp->substr($populer->NEWS_TITLE, 90) ?>
				<span class="list_news_time"><?php if(date('d-m-Y') == date('d-m-Y', strtotime($populer->DATE))) echo "(".date('H:i', strtotime($populer->DATE)).")";?></span>
			</a>
		</li>
	<?php endforeach;?>
	</ul>
</div>