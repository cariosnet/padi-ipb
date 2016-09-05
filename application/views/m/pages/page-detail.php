<div class="container">
	<div class="headline_wrap" style="min-height: 50px;">
		<div class="breadcrumbs">
			&raquo; Home&nbsp;
			&raquo; Halaman&nbsp;
			&raquo; <?php echo $pages->TITLE?>&nbsp;
		</div>
		<div class="news_properties">
			<div class="content_title"><?php echo $pages->TITLE?></div>
		</div>
	</div>
				
	<div class="news_content">
		<?php echo $pages->CONTENT;?>
	</div>
	
	<div class="content_action">
		<!-- FaceBook -->
		<div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('pages/'.$pages->ALIAS)?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>
					
		<!-- Twitter  -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('pages/'.$pages->ALIAS)?>" data-via="KlikPositif" data-lang="id" data-hashtags="KlikPositif">Tweet</a>
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
	<div class="list_news_next"><a href="<?php echo site_url('m/indeks/fokus')?>">Indeks Fokus &raquo;</a></div>
	
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