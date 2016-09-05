<div class="container">
	<div class="headline_wrap">
		<div class="breadcrumbs">&raquo; Home</div>
		<div class="headline">
			<div class="title">&raquo; Headline</div>
			<?php foreach ($listHeadline->result() as $headline):?>
				<img src="<?php if($headline->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$headline->NEWS_PICTURE;else echo $this->config->item('layout_mobile').'images/no-image.png'; ?>" alt="<?php echo $headline->NEWS_TITLE?>" />
				<div class="info" >
					<h2><a href="<?php echo site_url('m/news/read/'.$headline->NEWS_ID.'/'.$headline->ALIAS)?>" ><?php echo $this->bogcamp->substr($headline->NEWS_TITLE, 80) ?></a></h2>
					<p><?php echo $this->bogcamp->substr($headline->META_DESC, 180) ?>. <a href="<?php echo site_url('m/news/read/'.$headline->NEWS_ID.'/'.$headline->ALIAS)?>" style="font-weight: bold" >Baca Selengkapnya</a> &raquo;</p>
				</div>
			    
			<?php endforeach;?>
			
			<div class="clear"></div>
		</div>
	</div>
	
	<!-- Berita Terkini -->
	<ul class="list_news">
		<?php foreach ($listLatestNews->result() as $latestNews):?>
		<li>
			<a href="<?php echo site_url('m/news/read/'.$latestNews->NEWS_ID.'/'.$latestNews->ALIAS)?>" title="<?php echo $latestNews->NEWS_TITLE?>">
				<?php echo $this->bogcamp->substr($latestNews->NEWS_TITLE, 90) ?>
				<span class="list_news_time"><?php if(date('d-m-Y') == date('d-m-Y', strtotime($latestNews->DATE))) echo "(".date('H:i', strtotime($latestNews->DATE)).")";?></span>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
	<div class="list_news_next"><a href="<?php echo site_url('m/indeks')?>">Indeks Berita &raquo;</a></div>
	
	<!-- News from Kanal -->
	<?php foreach ($listParent->result() as $cat):?>
		<div class="list_news_title" <?php if($cat->COLOR != "") echo 'style="background: '.$cat->COLOR.'"'?>><?php echo $cat->CAT_NAME?></div>
		<ul class="list_news">
			<?php foreach ($this->newslogic->getListNewsCatRel($cat->ID, null, null, 6, 0)->result() as $newsBoxRow):?>
			<li>
				<a <?php if($cat->COLOR != "") echo 'style="color: '.$cat->COLOR.'"'?> href="<?php echo site_url('m/news/read/'.$newsBoxRow->NEWS_ID.'/'.$newsBoxRow->ALIAS)?>" title="<?php echo $newsBoxRow->NEWS_TITLE?>">
					<?php echo $this->bogcamp->substr($newsBoxRow->NEWS_TITLE, 90) ?>
					<span class="list_news_time"><?php if(date('d-m-Y') == date('d-m-Y', strtotime($newsBoxRow->DATE))) echo "(".date('H:i', strtotime($newsBoxRow->DATE)).")";?></span>
				</a>
			</li>
			<?php endforeach;?>
		</ul>
	<?php endforeach;?>
	
	<!-- Fokus -->
	<div class="list_news_title" style="background: #c93930">FOKUS</div>
	<?php foreach ($listFokus->result() as $fokus):?>
		<div class="list_news_special">
			<img src="<?php if($fokus->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$fokus->NEWS_PICTURE; else echo $this->config->item('layout_mobile').'images/no-image.png'; ?>" alt="<?php echo $fokus->NEWS_TITLE?>" />
			<div class="info" >
				<h2><a href="<?php echo site_url('m/news/fokus/'.$fokus->NEWS_ID.'/'.$fokus->ALIAS)?>" ><?php echo $this->bogcamp->substr($fokus->NEWS_TITLE, 80) ?></a></h2>
				<p><?php echo $this->bogcamp->substr($fokus->META_DESC, 180) ?>. <a href="<?php echo site_url('m/news/read/'.$fokus->NEWS_ID.'/'.$fokus->ALIAS)?>" style="font-weight: normal;" >Baca Selengkapnya</a> &raquo;</p>
			</div>
			
			<div class="clear"></div>
		</div>
			    
	<?php endforeach;?>
	<div class="list_news_next"><a href="<?php echo site_url('m/indeks/fokus')?>">Indeks Fokus &raquo;</a></div>
	
	<!-- Wawancara -->
	<div class="list_news_title" style="background: #c93930">Wawancara</div>
	<?php foreach ($listDialog->result() as $dialog):?>
		<div class="list_news_special">
			<img src="<?php if($dialog->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$dialog->NEWS_PICTURE;else echo $this->config->item('layout_mobile').'images/no-image.png'; ?>" alt="<?php echo $dialog->NEWS_TITLE?>" />
			<div class="info" >
				<h2><a href="<?php echo site_url('m/news/dialog/'.$dialog->NEWS_ID.'/'.$dialog->ALIAS)?>" ><?php echo $this->bogcamp->substr($dialog->NEWS_TITLE, 80) ?></a></h2>
				<p><?php echo $this->bogcamp->substr($dialog->META_DESC, 180) ?>. <a href="<?php echo site_url('m/news/dialog/'.$dialog->NEWS_ID.'/'.$dialog->ALIAS)?>" style="font-weight: normal;" >Baca Selengkapnya</a> &raquo;</p>
			</div>
			
			<div class="clear"></div>
		</div>
			    
	<?php endforeach;?>
	<div class="list_news_next"><a href="<?php echo site_url('m/indeks/dialog')?>">Indeks Wawancara &raquo;</a></div>
	
</div>