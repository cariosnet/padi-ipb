<div class="container">
	<div class="headline_wrap">
		<div class="breadcrumbs">
			&raquo; Home&nbsp;
			&raquo; Kanal&nbsp;
			<?php 
				for ($i = 0; $i < count($breadData);$i++){
					echo '&raquo; <a href="'.site_url('kanal/'.$breadData[$i]['CAT_ALIAS']).'">'.$breadData[$i]['CAT_NAME'].'</a>&nbsp;';
				}
			?>
		</div>
		<div class="headline">
			<div class="title">&raquo; Headline Kanal <?php echo $catObj->row()->CAT_NAME?></div>
			<?php foreach ($listHeadline->result() as $headline):?>
				<div class="list_news_special">
				<img src="<?php if($headline->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$headline->NEWS_PICTURE;else echo $this->config->item('layout_mobile').'images/no-image.png'; ?>" alt="<?php echo $headline->NEWS_TITLE?>" />
				<div class="info" >
					<h2><a href="<?php echo site_url('m/news/read/'.$headline->NEWS_ID.'/'.$headline->ALIAS)?>" ><?php echo $this->bogcamp->substr($headline->NEWS_TITLE, 80) ?></a></h2>
					<p><?php echo $this->bogcamp->substr($headline->META_DESC, 180) ?>. <a href="<?php echo site_url('m/news/read/'.$headline->NEWS_ID.'/'.$headline->ALIAS)?>" style="font-weight: bold" >Baca Selengkapnya</a> &raquo;</p>
				</div>
			    
			    <div class="clear"></div>
			    </div>
			<?php endforeach;?>
			
			<div class="clear"></div>
		</div>
	</div>
	
	<!-- Berita Terkini -->
	<div class="list_news_title" <?php if($catObj->row()->COLOR != "") echo "style='background: ".$catObj->row()->COLOR."'";?>>BERITA TERKINI</div>
	<ul class="list_news">
		<?php foreach ($listLatest->result() as $latestNews):?>
		<li>
			<a href="<?php echo site_url('m/news/read/'.$latestNews->NEWS_ID.'/'.$latestNews->ALIAS)?>" title="<?php echo $latestNews->NEWS_TITLE?>">
				<?php echo $this->bogcamp->substr($latestNews->NEWS_TITLE, 90) ?>
				<span class="list_news_time"><?php if(date('d-m-Y') == date('d-m-Y', strtotime($latestNews->DATE))) echo "(".date('H:i', strtotime($latestNews->DATE)).")";?></span>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
	<div class="list_news_next"><a href="<?php echo site_url('m/indeks/'.$catObj->row()->CAT_ALIAS)?>">Indeks <?php echo $catObj->row()->CAT_NAME?> &raquo;</a></div>
	
	<!-- Berita Pilihan -->
	<div class="list_news_title" style="background: #012837">BERITA PILIHAN</div>
	<ul class="list_news">
		<?php foreach ($listPilihan->result() as $pilihan):?>
		<li>
			<a href="<?php echo site_url('m/news/read/'.$pilihan->NEWS_ID.'/'.$pilihan->ALIAS)?>" title="<?php echo $pilihan->NEWS_TITLE?>">
				<?php echo $this->bogcamp->substr($pilihan->NEWS_TITLE, 90) ?>
				<span class="list_news_time"><?php if(date('d-m-Y') == date('d-m-Y', strtotime($pilihan->DATE))) echo "(".date('H:i', strtotime($pilihan->DATE)).")";?></span>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>

<!-- Sub Kanal  -->
<?php if($listSubKanal->num_rows() > 0):?>
<div class="sub_kanal_menu">
	<div class="title">&raquo; Sub Kanal <?php echo $catObj->row()->CAT_NAME;?> &laquo;</div>
	
	<ul>
	<?php foreach ($listSubKanal->result() as $subKanal):?>
		<li><a href="<?php echo site_url('m/kanal/'.$subKanal->CAT_ALIAS)?>"><?php echo $subKanal->CAT_NAME?></a></li>
	<?php endforeach;?>
	</ul>
</div>
<?php endif;?>