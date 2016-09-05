	<script type="text/javascript">
    	$(document).ready(function(){
        	var catId = "";
        	var catColor = "";
        	mainMenuHover("#mainMenu-"+catId, catColor);
    		$("#mainMenu-" + catId).addClass("active");
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
						<li><a href="<?php echo site_url('news/fokus')?>">Fokus</a></li>
					</ul>
				</div>
				<!-- End of BreadCrumbs -->
				
				<div class="top_wrap">
					<div class="time"><?php echo $this->bogcamp->convertDate($news->DATE)?></div>
					<div class="social_media">
						<a href="https://twitter.com/KlikPositif" class="twitter-follow-button" data-show-count="true">Follow @KlikPositif</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
					
					<div class="clear"></div>
				</div>
				
				<div class="content_title"><?php echo $news->NEWS_TITLE?></div>
				<div class="content_subtitle" ><?php echo $news->NEWS_SUBTITLE?></div>
				<div class="editor">Penulis: <?php echo $news->WRITER?> | Editor: <?php echo $news->EDITOR?></div>
				
				<div class="picture_wrap">
					<img class="news_picture" src="<?php if($news->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$news->NEWS_PICTURE; else echo "http://www.placehold.it/610x300/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="<?php echo $news->NEWS_TITLE?>" />
					<div class="caption"><?php echo $news->NEWS_PICTURE_CAPTION?> <?php if($news->NEWS_PICTURE_SOURCE != '')echo '('.$news->NEWS_PICTURE_SOURCE.')'; ?></div>
				</div>
				
				<div class="news_content">
					<?php echo $news->NEWS_CONTENT;?>
				</div>
				
				<!-- <div class="read_page_view">Dibaca: <?php //echo $news->PAGE_VIEW;?> kali</div> -->
				<div class="content_action">
					<!-- FaceBook -->
					<div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('news/fokus/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>
					
					<!-- Twitter  -->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('news/fokus/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-via="KlikPositif" data-lang="id" data-hashtags="KlikPositif">Tweet</a>
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
			<div class="comment_canvas">
				<div style="margin: 5px;" class="fb-comments" data-href="<?php echo site_url('news/fokus/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-width="627" data-num-posts="6"></div>
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