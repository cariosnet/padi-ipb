	
	<div class="container">
		
		<div class="content_wrap">
			<div class="content_canvas">
				<!-- BreadCrumbs -->
				<div class="breadCrumb module">
					<ul>
						<li><a href="<?php echo site_url('home')?>">Home</a></li>
						<li><a href="<?php echo site_url('produk_hukum')?>">Produk Hukum</a></li>
						<li><?php echo $pages->TITLE?></li>
					</ul>
				</div>
				<!-- End of BreadCrumbs -->
				
				<div class="top_wrap">
					<div class="time"></div>
					<div class="social_media">
						
					</div>
					
					<div class="clear"></div>
				</div>
				
				<div class="content_title"><?php echo $pages->TITLE?></div>
				<div class="content_subtitle" style="padding: 0px;"></div>
				<div class="editor"></div>
				
				<div class="news_content">
					<div style="text-align: center; margin-bottom: 20px;">
						<a href="<?php echo $this->config->item('file_path').$pages->FILE ?>"><img alt="Download" src="<?php echo $this->config->item('layout_front')."images/downloads-icon.png"?>" /></a>
					</div>
					
					<?php echo $pages->DESC;?>
				</div>
				
				<!-- <div class="read_page_view">Dibaca: <?php //echo $pages->PAGE_VIEW;?> kali</div> -->
				<div class="content_action">
					
				</div>
			</div>
			
		</div>
		
		<div class="sidebar">
			<div class="box">
				<div class="news_popular">
					
					<div class="news_tab">
			            <ul>
			              <li><a href="#ph">Produk Hukum</a></li>
			              <li><a href="#bd">Bank Data</a></li>
			            </ul>
			        </div>
			        
			        <div class="tab_content" id="ph">
			        	<ul>
						<?php foreach ($listProdakHukum->result() as $produkHukum):?>
							<li>
								<a href="<?php echo site_url('produk_hukum/detail/'.$produkHukum->ID.'/'.$produkHukum->ALIAS)?>" title="<?php echo $produkHukum->TITLE?>"><?php echo $this->bogcamp->substr($produkHukum->TITLE, 70) ?></a>
							</li>
						<?php endforeach;?>
						</ul>
			        </div>
			        <div class="tab_content" id="bd">
			        	<ul>
						<?php foreach ($listBankData->result() as $bankData):?>
							<li>
								<a href="<?php echo site_url('bank_data/detail/'.$bankData->ID.'/'.$bankData->ALIAS)?>" title="<?php echo $bankData->TITLE?>"><?php echo $this->bogcamp->substr($bankData->TITLE, 70) ?></a>
							</li>
						<?php endforeach;?>
						</ul>
			        </div>
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>