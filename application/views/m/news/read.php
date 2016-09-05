<div class="container">
	<div class="headline_wrap">
		<div class="breadcrumbs">
			&raquo; Home&nbsp;
			<?php 
				for ($i = 0; $i < count($breadData);$i++){
					echo '&raquo; <a href="'.site_url('kanal/'.$breadData[$i]['CAT_ALIAS']).'">'.$breadData[$i]['CAT_NAME'].'</a>&nbsp;';
				}
			?>
		</div>
		<div class="news_properties">
			<div class="time"><?php echo $this->bogcamp->convertDate($news->DATE)?></div>
			<div class="content_title" <?php if($cat->COLOR != '')echo 'style="color:'.$cat->COLOR.'"';?>><?php echo $news->NEWS_TITLE?></div>
			<div class="content_subtitle" ><?php echo $news->NEWS_SUBTITLE?></div>
			<div class="editor">Penulis: <?php echo $news->WRITER?> | Editor: <?php echo $news->EDITOR?></div>
		</div>
	</div>
	
	<div class="picture_wrap">
		<img class="news_picture" src="<?php if($news->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$news->NEWS_PICTURE; else echo "http://www.placehold.it/610x300/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="<?php echo $news->NEWS_TITLE?>" />
		<div class="caption" <?php if($cat->COLOR != '')echo 'style="color:'.$cat->COLOR.'"';?>><?php echo $news->NEWS_PICTURE_CAPTION?> <?php if($news->NEWS_PICTURE_SOURCE != '')echo '('.$news->NEWS_PICTURE_SOURCE.')'; ?></div>
	</div>
				
	<div class="news_content">
		<?php echo $news->NEWS_CONTENT;?>
		
		<div class="related_title" <?php if($cat->COLOR != '')echo 'style="color:'.$cat->COLOR.'"';?>>Berita Terkait:</div>
			<ul class="rel">
				<?php foreach ($listRelated->result() as $rel):?>
					<li><a href="<?php echo site_url('news/read/'.$rel->NEWS_ID.'/'.$rel->ALIAS)?>"><?php echo $rel->NEWS_TITLE;?></a></li>
				<?php endforeach;?>
				<?php if($listRelated->num_rows == 0)echo "<li style='list-style: none;'>Tidak ada berita terkait</li>";?>
			</ul>
	</div>
	
	<div class="content_action">
		<!-- FaceBook -->
		<div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>
					
		<!-- Twitter  -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-via="KlikPositif" data-lang="id" data-hashtags="KlikPositif">Tweet</a>
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
	
	<div class="comment_canvas">
		<div style="z-index: -10" class="fb-comments" data-href="<?php echo site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-width="" data-num-posts="3"></div>
	</div>
	
	<!-- Fokus -->
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
	<div class="list_news_next"><a href="<?php echo site_url('m/indeks/'.$cat->CAT_ALIAS)?>">Indeks <?php echo $cat->CAT_NAME?> &raquo;</a></div>
	
	<!-- Wawancara -->
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