	<div class="indeks_title" style="font-weight: bold;"><a style="color: <?php echo $type['color']?>" href="<?php echo site_url('kanal/'.$type['url'])?>"><?php echo $type['name']?></a></div>
		<ul class="list_indeks_kanal">
			<?php 
				if($listNews->num_rows == 0)echo '<li>Tidak ada berita pada kriteria ini</li>';
				foreach ($listNews->result() as $news){
					echo '<li>';
					echo '<div class="time">'.$this->bogcamp->convertDate($news->DATE).'</div>';
					echo '<div class="title"><a href="'.site_url('news/'.$type['url'].'/'.$news->NEWS_ID.'/'.$news->ALIAS).'">'.$news->NEWS_TITLE.'</a></div>';
					echo '<div class="subtitle">'.$news->NEWS_SUBTITLE.'</div>';
					echo '</li>';
				}
			?>
		</ul>
