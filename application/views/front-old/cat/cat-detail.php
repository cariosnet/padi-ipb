<script src="<?php echo $this->config->item('ext_js');?>plugins/slidorion/jquery.slidorion.min.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/slidorion/css/slidorion.css">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#slidorion').slidorion({
				interval: 5000,
				effect: 'slideRandom'
			});
		});
	</script>
    
    <div class="container">
		<div class="content_wrap">
			<div class="kanal_headline" <?php if($catObj->row()->COLOR != '') echo 'style="background: '.$catObj->row()->COLOR.'"'; ?>>
				<div id="slidorion">
					<div class="kanal_title"><?php echo $catObj->row()->CAT_NAME?></div>
					<div id="slider2">
						<?php $nHeadLine = 1; foreach ($listHeadline->result() as $headline):?>
						<div id="slide<?php echo $nHeadLine++;?>" class="slide">
							<img src="<?php if($headline->NEWS_PICTURE != '')echo $this->config->item('img_path').'news/'.$headline->NEWS_PICTURE;else echo 'http://www.placehold.it/316x170/EFEFEF/AAAAAA&amp;text=No+Image+Available'; ?>" alt="<?php echo $headline->NEWS_TITLE?>" width="316px" />
						</div>
						<?php endforeach;?>
					</div>
			
					<div id="accordion">
						<?php foreach ($listHeadline->result() as $headline):?>
						<div class="link-header"><?php echo $headline->NEWS_TITLE?></div>
						<div class="link-content">
							<div class="time"><?php echo $this->bogcamp->convertDate($headline->DATE)?></div>
							<p class="sub_title" <?php if($catObj->row()->COLOR != '') echo 'style="color: '.$catObj->row()->COLOR.'"'; ?>><?php echo $headline->NEWS_TITLE?></p>
							<p><?php echo $headline->META_DESC?></p>
							
							<a href="<?php echo site_url('news/read/'.$headline->NEWS_ID.'/'.$headline->ALIAS)?>" title="<?php echo $headline->NEWS_TITLE?>">Selengkapnya</a> &raquo;
						</div>
						<?php endforeach;?>
					</div>
			
				</div>
			</div>
			<div class="kanal_box_wrap">
				<div class="kanal_latest">
					<div class="title">Terkini</div>
					<ul>
					<?php foreach ($listLatest->result() as $latest):?>
						<li>
							<div class="time"><?php echo $this->bogcamp->convertDate($latest->DATE);?></div>
							
							<a href="<?php echo site_url('news/read/'.$latest->NEWS_ID.'/'.$latest->ALIAS)?>" title="<?php echo $latest->NEWS_TITLE?>"><img src="<?php if($latest->NEWS_PICTURE != '')echo $this->config->item('img_path').'news/'.$latest->NEWS_PICTURE;else echo 'http://www.placehold.it/128x69/EFEFEF/AAAAAA&amp;text=No+Image+Available'; ?>" alt="<?php echo $latest->NEWS_TITLE?>" /></a>
							<div class="news_title"><a href="<?php echo site_url('news/read/'.$latest->NEWS_ID.'/'.$latest->ALIAS)?>"><?php echo $this->bogcamp->substr($latest->NEWS_TITLE, 60)?></a></div>
							
							<?php echo $this->bogcamp->substr($latest->NEWS_SUBTITLE, 60);?> .<a href="<?php echo site_url('news/read/'.$latest->NEWS_ID.'/'.$latest->ALIAS)?>" title="<?php echo $latest->NEWS_TITLE?>">Selengkapnya</a> &raquo;
							<div class="clear"></div>
						</li>
					<?php endforeach;?>
					</ul>
				</div>
				<div class="kanal_pilihan">
					<div class="title">Pilihan Redaksi</div>
					<ul>
					<?php foreach ($listPilihan->result() as $pilihan):?>
						<li><a href="<?php echo site_url('news/read/'.$pilihan->NEWS_ID.'/'.$pilihan->ALIAS)?>" title="<?php echo $pilihan->NEWS_TITLE?>"><?php echo $this->bogcamp->substr($pilihan->NEWS_TITLE, 40)?></a></li>
					<?php endforeach;?>
					</ul>
				</div>
				
				<a href="<?php echo site_url('indeks/'.$catObj->row()->CAT_ALIAS)?>" class="uibutton">Indeks <?php echo $catObj->row()->CAT_NAME?> &raquo;</a>
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
			
			<!--
			<div class="kanal_gallery">
				<div class="title">Galeri <?php //echo $catObj->row()->CAT_NAME?></div>
				<div style="height: 212px;"></div>
			</div>
			-->
		</div>
		<div class="clear"></div>
		
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
		
		<div class="content_wrap" style="width: 738px;">
			<?php foreach ($listParent->result() as $cat): $loop = 1;?>
			<div class="kanal_box">
				<div class="news_box" <?php if($cat->COLOR != '') echo 'style="border-top: 4px solid '.$cat->COLOR.'"'; ?>>
					<div class="title"><a href="<?php echo site_url('kanal/'.$cat->CAT_ALIAS)?>" <?php if($cat->COLOR != '') echo 'style="color: '.$cat->COLOR.'"'; ?>><?php echo $cat->CAT_NAME; ?></a></div>
					
					<?php 
					$newsBox = $this->newslogic->getListNewsCatRel($cat->ID, null, null, 6, 0);
					foreach ($newsBox->result() as $newsBoxRow):
						if($loop == 1){
					?>
							<div class="top_news">
								<a href="<?php echo site_url('news/read/'.$newsBoxRow->NEWS_ID.'/'.$newsBoxRow->ALIAS)?>"><img src="<?php if($newsBoxRow->NEWS_PICTURE != '')echo $this->config->item('img_path').'news/'.$newsBoxRow->NEWS_PICTURE;else echo 'http://www.placehold.it/148x80/EFEFEF/AAAAAA&amp;text=No+Image+Available'; ?>" alt="<?php echo $newsBoxRow->NEWS_TITLE?>" /></a>
								
								<div class="top_news_title"><a title="<?php echo $newsBoxRow->NEWS_TITLE?>" href="<?php echo site_url('news/read/'.$newsBoxRow->NEWS_ID.'/'.$newsBoxRow->ALIAS)?>" <?php if($cat->COLOR != '') echo 'style="font-weight: bold;color: '.$cat->COLOR.'"'; ?>><?php echo $this->bogcamp->substr($newsBoxRow->NEWS_TITLE, 50)?></a></div>
								<?php echo $this->bogcamp->substr($newsBoxRow->META_DESC, 106); ?>
								
								<div class="clear"></div>
							</div>
							
							<span style="font-weight: bold; font-size: 8pt;">Berita Lainnya:</span>
					<?php 
							$loop++;
						}
					endforeach;
					?>
						<ul>
						<?php 
							$loop = 1;
							foreach ($newsBox->result() as $newsBoxRow):
								if($loop > 1):							
						?>	
							<li>
								<a title="<?php echo $newsBoxRow->NEWS_TITLE?>" href="<?php echo site_url('news/read/'.$newsBoxRow->NEWS_ID.'/'.$newsBoxRow->ALIAS)?>"><?php echo $this->bogcamp->substr($newsBoxRow->NEWS_TITLE, 50); ?></a>
							</li>
						<?php 
								endif;
								
								$loop++;
							endforeach;
						?>
						</ul>
				</div>
			</div>
			<?php endforeach;?>
			
			<div class="clear"></div>
		</div>
		
		<div class="kanal_sidebar">
			<div class="box">
				<div class="positifers">
					<div class="title">positifers</div>
					
					<ul>
						<?php foreach ($listForum->result() as $forum):?>
							<li><a href="<?php echo base_url().'forum/viewtopic.php?f='.$forum->forum_id.'&t='.$forum->topic_id?>" target="_blank"><?php echo $forum->post_subject?></a></li>
						<?php endforeach;?>
					</ul>
					
					<div class="positifers_bottom">
						<a href="<?php echo base_url()."forum"?>" target="_blank"><strong>Join</strong> our forum and be <strong>POSITIFERS</strong></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>