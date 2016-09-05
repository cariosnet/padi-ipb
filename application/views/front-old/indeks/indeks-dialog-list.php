	<!-- BootStrap Datepicker -->
	<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
	<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery.ui-i18n.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/css/Aristo/Aristo.css">
	
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
    	        url: "<?php echo site_url('indeks/ajax_filter_special/fokus')?>", 
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
		<?php foreach ($listBanner->result() as $banner):?>
		<?php if($banner->TYPE == "I"){?>
			<div class="ads_top1">
				<?php if($banner->URL != "")echo "<a href='".$banner->URL."' target='_blank' />";?>
					<img src="<?php if($banner->EMBED != '')echo $this->config->item('img_path').'banner/'.$banner->EMBED; else echo 'http://www.placehold.it/972x90/EFEFEF/AAAAAA&amp;text=No+Image+Available'; ?>" />
				<?php if($banner->URL != "")echo "</a>";?>
			</div>
		<?php }else{?>
			<div class="ads_top_google">
				<?php echo $banner->HTML;?>
			</div>
		<?php } endforeach;?>
		
		<div class="content_wrap">
			<div class="content_canvas">
				<!-- BreadCrumbs -->
				<div class="breadCrumb module">
					<ul>
						<li><a href="<?php echo site_url('home')?>">Home</a></li>
						<li><a href="javascript:void(0)">Indeks Wawancara</a></li>
					</ul>
				</div>
				<!-- End of BreadCrumbs -->
				
				<div class="content_title">Indeks</div>
				<div class="content_subtitle" style="padding: 0px; margin-bottom: 10px;"></div>
				
				<div class="news_content" style="min-height: 350px;">
					<form id="ajax_filter" action="<?php echo site_url('indeks/ajax_filter_special')?>" method="post">
						Tanggal: <input type="text" name="date" id="datepicker" style="width: 75px;" value="<?php echo date("d-m-Y")?>" />
						<input type="hidden" name="type" value="D" />
						<input type="hidden" name="name" value="Wawancara" />
						<a href="javascript:void(0)" onclick="sendFilterRequest();" class="uibutton">Lihat Indeks</a>
						<a href="javascript:void(0)" onclick="viewAll();" class="uibutton special">Tampilkan Semua Indeks</a>
					</form>
					
					<div id="result"></div>
				</div>
				
				<!-- <div class="read_page_view">Dibaca: <?php //echo $news->PAGE_VIEW;?> kali</div> -->
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
			</div>
		</div>
		
		<div class="sidebar">
			<?php foreach ($listBannerSide->result() as $banner):?>
			<?php if($banner->TYPE == "I"){?>
				<div class="ads_side">
					<?php if($banner->URL != "")echo "<a href='".$banner->URL."' target='_blank' />";?>
						<img src="<?php if($banner->EMBED != '')echo $this->config->item('img_path').'banner/'.$banner->EMBED; else echo 'http://www.placehold.it/320x200/EFEFEF/AAAAAA&amp;text=No+Image+Available'; ?>" />
					<?php if($banner->URL != "")echo "</a>";?>
				</div>
			<?php }else{?>
				<div class="ads_side_google">
					<?php echo $banner->HTML;?>
				</div>
			<?php } endforeach;?>
			
			<div class="box">
				<div class="news_popular">
					
					<div class="news_tab">
			            <ul>
			              <li><a href="#populer">POPULER</a></li>
			              <li><a href="#latest">TERKINI</a></li>
			            </ul>
			        </div>
			        
			        <div class="tab_content" id="populer">
			        	<ul>
						<?php foreach ($listPopuler->result() as $populer):?>
							<li>
								<div class="time"><?php echo $this->bogcamp->convertDate($populer->DATE)?></div>
								<a href="<?php echo site_url('news/read/'.$populer->NEWS_ID.'/'.$populer->ALIAS)?>" title="<?php echo $populer->NEWS_TITLE?>"><?php echo $this->bogcamp->substr($populer->NEWS_TITLE, 70) ?></a>
							</li>
						<?php endforeach;?>
						</ul>
			        </div>
			        <div class="tab_content" id="latest">
			        	<ul>
						<?php foreach ($listLatestNews->result() as $latestNews):?>
							<li>
								<div class="time"><?php echo $this->bogcamp->convertDate($latestNews->DATE)?></div>
								<a href="<?php echo site_url('news/read/'.$latestNews->NEWS_ID.'/'.$latestNews->ALIAS)?>" title="<?php echo $latestNews->NEWS_TITLE?>"><?php echo $this->bogcamp->substr($latestNews->NEWS_TITLE, 70) ?></a>
							</li>
						<?php endforeach;?>
						</ul>
			        </div>
				</div>
			</div>
			
			<div class="box">
				<div class="positifers">
					<div class="title">positifers</div>
					
					<ul>
						<?php foreach ($listForum->result() as $forum):?>
							<li><a href="<?php echo base_url().'forum/viewtopic.php?f='.$forum->forum_id.'&t='.$forum->topic_id?>" target="_blank"><?php echo $forum->post_subject?></a></li>
						<?php endforeach;?>
					</ul>
					
					<div class="positifers_bottom">
						<a href="<?php echo base_url('forum')?>" target="_blank"><strong>Join</strong> our forum and be <strong>POSITIFERS</strong></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>