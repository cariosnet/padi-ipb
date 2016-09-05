<div class="box">
	<div class="news_popular">
		
		<div class="news_tab">
            <ul>
              <li style="list-style: none;"><a href="<?php echo site_url('bank_data')?>" >Regulasi</a></li>
            </ul>
        </div>
        
        <div class="tab_content" id="populer">

			<ul>
			<?php foreach ($listRegulasi->result() as $produkHukum):?>
		<li>
			<a href="<?php echo site_url('bank_data/detail/'.$produkHukum->ID.'/'.$produkHukum->ALIAS)?>" title="<?php echo $produkHukum->TITLE?>"><?php echo $this->bogcamp->substr($produkHukum->TITLE, 90) ?></a>
		</li>
	<?php endforeach;?>
		</ul>
        </div>
	</div>
</div>

<div class="box">
	<div class="news_popular">
		
		<div class="news_tab">
            <ul>
              <li style="list-style: none;"><a href="<?php echo base_url();?>artikel/8" >Produk</a></li>
            </ul>
        </div>
        
        <div class="tab_content" id="populer2">

			<ul>
						<?php foreach ($listProduk->result() as $produkHukum):?>
			              <li>
			                <a href="<?php echo site_url('news/read/'.$produkHukum->NEWS_ID.'/'.$produkHukum->ALIAS)?>" title="<?php echo $produkHukum->NEWS_TITLE?>"><?php echo $this->bogcamp->substr($produkHukum->NEWS_TITLE, 90) ?></a>
			              </li>
			            <?php endforeach;?>						
			        </ul>
					<?php if($listProduk->num_rows() == 7){?>
					<div style="margin: 10px; text-align: right;"><a href="<?php echo base_url()?>artikel/8">Indeks Produk</a> &raquo;</div>
					<?php }?>
        </div>
	</div>
</div>