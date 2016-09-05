<div class="indeks_title" style="font-weight: bold;">Daftar Iklan Baris</div>
		
<ul class="list_indeks_kanal">
<?php foreach ($listAds->result() as $row):?>
	<li>
		<div style="float: left; margin-right: 10px;"><img class="news_picture" style="width: 100px; padding: 0px; margin: 0px;" src="<?php if($row->ADS_PICTURE != "")echo $this->config->item('img_path').'ads/'.$row->ADS_PICTURE; else echo "http://www.placehold.it/100x66/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="<?php echo $row->ADS_TITLE?>" /></div>
		<div class="title"><a href="<?php echo site_url('ads/read/'.$row->ADS_ID.'/'.$row->ALIAS)?>"><?php echo $row->ADS_TITLE?></a></div>
		<div class="subtitle"><?php echo $row->META_DESC;?></div>
		
		<div class="clear"></div>
	</li>
<?php endforeach;?>
<?php if($listAds->num_rows == 0)echo '<li>Tidak ada iklan iklan ditemukan pada kriteria ini</li>';?>
</ul>
