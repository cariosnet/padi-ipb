<div class="container">
	<div style="padding-top: 12px;float: left;margin-right: 15px;">
		<div class="box2 orange" style="margin:0;border-radius:0;">
			<div class="title">Artikel</div>
			<?php foreach ($news->result() as $row){?>
			<div class="news_list">
				<div class="news_image">
					<img src="<?php if($row->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$row->NEWS_PICTURE; else echo "http://www.placehold.it/650x350/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="<?php echo $row->NEWS_TITLE?>" />
				</div>
				<div class="news_detail">
					<div class="news_title">
						<a href="<?php echo site_url('news/read/'.$row->NEWS_ID.'/'.$row->ALIAS)?>" ><?php echo $this->bogcamp->substr($row->NEWS_TITLE, 80) ?></a>
					</div>
					<div class="news_desc">
						<div style="margin-bottom: 5px;"><?php echo $row->META_DESC;?></div>
						<a href="<?php echo site_url('news/read/'.$row->NEWS_ID.'/'.$row->ALIAS)?>" style="font-weight: bold" >Baca Selengkapnya</a> &raquo;
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<?php }?>
		</div>
	</div>
	<div style="padding-top: 12px;float: left;width: 312px;">
			<div class="box green" style="margin-bottom: 10px;">
				<div class="title">Regulasi</div>
				<ul>
					<?php foreach ($listRegulasi->result() as $produkHukum):?>
						<li>
							<a href="<?php echo site_url('bank_data/detail/'.$produkHukum->ID.'/'.$produkHukum->ALIAS)?>" title="<?php echo $produkHukum->TITLE?>"><?php echo $this->bogcamp->substr($produkHukum->TITLE, 90) ?></a>
						</li>
					<?php endforeach;?>
					</ul>
				<div style="margin: 10px; text-align: right;"><a href="<?php echo site_url('bank_data/list/PR')?>">Daftar Regulasi</a> &raquo;</div>
			</div>
			<div class="box green" style="margin-bottom: 10px;">
				<div class="title">Dokumen</div>
				<ul>
					<?php foreach ($listDokumen->result() as $produkHukum):?>
						<li>
							<a href="<?php echo site_url('bank_data/detail/'.$produkHukum->ID.'/'.$produkHukum->ALIAS)?>" title="<?php echo $produkHukum->TITLE?>"><?php echo $this->bogcamp->substr($produkHukum->TITLE, 90) ?></a>
						</li>
					<?php endforeach;?>
				</ul>
				<div style="margin: 10px; text-align: right;"><a href="<?php echo site_url('bank_data/list/DO')?>">Daftar Dokumen</a> &raquo;</div>
			</div>
			<div class="box green last" style="margin-bottom: 10px;">
				<div class="title">Produk</div>
				<ul>
					<?php foreach ($listProduk->result() as $produkHukum):?>
						<li>
							<a href="<?php echo site_url('bank_data/detail/'.$produkHukum->ID.'/'.$produkHukum->ALIAS)?>" title="<?php echo $produkHukum->TITLE?>"><?php echo $this->bogcamp->substr($produkHukum->TITLE, 90) ?></a>
						</li>
					<?php endforeach;?>
					</ul>
				<div style="margin: 10px; text-align: right;"><a href="<?php echo site_url('bank_data/list/PR')?>">Daftar Produk</a> &raquo;</div>
			</div>
			<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>