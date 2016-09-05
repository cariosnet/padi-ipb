	<script type="text/javascript">
    	$(document).ready(function(){
        	
        });
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
						<li><a href="<?php echo site_url('ads')?>">Iklan Baris</a></li>
						<?php 
							for ($i = 0; $i < count($breadData);$i++){
								echo '<li><a href="'.site_url('kanal/'.$breadData[$i]['CAT_ALIAS']).'">'.$breadData[$i]['CAT_NAME'].'</a></li>';
							}
						?>
					</ul>
				</div>
				<!-- End of BreadCrumbs -->
				
				<div class="top_wrap">
					<div class="time">Tanggal Posting: <?php echo date('d-m-Y', strtotime($ads->ADS_START));?></div>
					<div class="social_media">
						<a href="https://twitter.com/KlikPositif" class="twitter-follow-button" data-show-count="true">Follow @KlikPositif</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
					
					<div class="clear"></div>
				</div>
				
				<div class="content_title"><?php echo $ads->ADS_TITLE?></div>
				<div class="content_subtitle" style="padding-bottom: 0px;"></div>
				<div class="editor">Pengiklan: <?php echo $ads->ADS_AUTHOR?></div>
				
				<div class="picture_wrap">
					<img class="news_picture" src="<?php if($ads->ADS_PICTURE != "")echo $this->config->item('img_path').'ads/'.$ads->ADS_PICTURE; else echo "http://www.placehold.it/610x300/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="<?php echo $ads->ADS_TITLE?>" />
					<div class="caption"><?php echo $ads->ADS_TITLE?></div>
				</div>
				
				<div class="news_content">
					<?php echo $ads->ADS_CONTENT;?>
				</div>
				
				<!-- <div class="read_page_view">Dibaca: <?php //echo $ads->PAGE_VIEW;?> kali</div>  -->
				<div class="content_action">
					<!-- FaceBook -->
					<div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('ads/read/'.$ads->ADS_ID.'/'.$ads->ALIAS)?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>
					
					<!-- Twitter  -->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('ads/read/'.$ads->ADS_ID.'/'.$ads->ALIAS)?>" data-via="KlikPositif" data-lang="id" data-hashtags="KlikPositif">Tweet</a>
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
						<a href="<?php echo base_url('forum');?>" target="_blank"><strong>Join</strong> our forum and be <strong>POSITIFERS</strong></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>