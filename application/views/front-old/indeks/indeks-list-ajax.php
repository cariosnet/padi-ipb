
<?php foreach ($listCat->result() as $row):?>
	<?php if($row->PARENT == ""){?>
	<div class="indeks_title" style="font-weight: bold;"><a style="color: <?php echo $row->COLOR?>" href="<?php echo site_url('kanal/'.$row->CAT_ALIAS)?>"><?php echo $row->CAT_NAME;?></a></div>
		<ul class="list_indeks_kanal">
			<?php 
				$listNews = $this->X_News_Model->getListNewsIndeks($row->ID, $date);
				if($listNews->num_rows == 0)echo '<li>Tidak ada berita pada kriteria ini</li>';
				foreach ($listNews->result() as $news){
					echo '<li>';
					echo '<div class="time">'.$this->bogcamp->convertDate($news->DATE).'</div>';
					echo '<div class="title"><a href="'.site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS).'">'.$news->NEWS_TITLE.'</a></div>';
					echo '<div class="subtitle">'.$news->NEWS_SUBTITLE.'</div>';
					echo '</li>';
				}
			?>
		</ul>
		
		<?php foreach ($listCat->result() as $row2):?>
			<?php if($row2->PARENT == $row->ID){?>
			<div class="indeks_title"><a style="color: <?php echo $row->COLOR?>" href="<?php echo site_url('kanal/'.$row2->CAT_ALIAS)?>"><?php echo $row2->CAT_NAME;?></a></div>
				<ul class="list_indeks_kanal">
					<?php 
						$listNews = $this->X_News_Model->getListNewsIndeks($row2->ID, $date);
						if($listNews->num_rows == 0)echo '<li>Tidak ada berita pada kriteria ini</li>';
						foreach ($listNews->result() as $news){
							echo '<li>';
							echo '<div class="time">'.$this->bogcamp->convertDate($news->DATE).'</div>';
							echo '<div class="title"><a href="'.site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS).'">'.$news->NEWS_TITLE.'</a></div>';
							echo '<div class="subtitle">'.$news->NEWS_SUBTITLE.'</div>';
							echo '</li>';
						}
					?>
				</ul>
				<?php foreach ($listCat->result() as $row3):?>
					<?php if($row3->PARENT == $row2->ID){?>
					<div class="indeks_title"><a style="color: <?php echo $row->COLOR?>" href="<?php echo site_url('kanal/'.$row3->CAT_ALIAS)?>"><?php echo $row3->CAT_NAME;?></a></div>
						<ul class="list_indeks_kanal">
							<?php 
								$listNews = $this->X_News_Model->getListNewsIndeks($row3->ID, $date);
								if($listNews->num_rows == 0)echo '<li>Tidak ada berita pada kriteria ini</li>';
								foreach ($listNews->result() as $news){
									echo '<li>';
									echo '<div class="time">'.$this->bogcamp->convertDate($news->DATE).'</div>';
									echo '<div class="title"><a href="'.site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS).'">'.$news->NEWS_TITLE.'</a></div>';
									echo '<div class="subtitle">'.$news->NEWS_SUBTITLE.'</div>';
									echo '</li>';
								}
							?>
						</ul>
					
					<?php }?>
				<?php endforeach;?>
			
			<?php }?>
		<?php endforeach;?>
		
	<?php }else if($listCat->num_rows == 1){?>
	<div class="indeks_title" style="font-weight: bold;"><a style="color: <?php echo $row->COLOR?>" href="<?php echo site_url('kanal/'.$row->CAT_ALIAS)?>"><?php echo $row->CAT_NAME;?></a></div>
		<ul class="list_indeks_kanal">
			<?php 
				$listNews = $this->X_News_Model->getListNewsIndeks($row->ID, $date);
				if($listNews->num_rows == 0)echo '<li>Tidak ada berita pada kriteria ini</li>';
				foreach ($listNews->result() as $news){
					echo '<li>';
					echo '<div class="time">'.$this->bogcamp->convertDate($news->DATE).'</div>';
					echo '<div class="title"><a href="'.site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS).'">'.$news->NEWS_TITLE.'</a></div>';
					echo '<div class="subtitle">'.$news->NEWS_SUBTITLE.'</div>';
					echo '</li>';
				}
			?>
		</ul>
<?php } endforeach;?>
