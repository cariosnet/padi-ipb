	<!-- Google Custom Search -->
	<script src="//www.google.com/jsapi" type="text/javascript"></script>
	<script type="text/javascript"> 
	  google.load('search', '1', {language : 'id', style : google.loader.themes.V2_DEFAULT});
	  google.setOnLoadCallback(function() {
	    var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
	      '017518231131874195260:uwuaykgbimq', customSearchOptions);
	    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
	    customSearchControl.draw('cse');
	    function parseParamsFromUrl() {
	      var params = {};
	      var parts = window.location.search.substr(1).split('\x26');
	      for (var i = 0; i < parts.length; i++) {
	        var keyValuePair = parts[i].split('=');
	        var key = decodeURIComponent(keyValuePair[0]);
	        params[key] = keyValuePair[1] ?
	            decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
	            keyValuePair[1];
	      }
	      return params;
	    }
	
	    var urlParams = parseParamsFromUrl();
	    var queryParamName = "q";
	    if (urlParams[queryParamName]) {
	      customSearchControl.execute(urlParams[queryParamName]);
	    }
	  }, true);
	</script>
	<div class="container">
		<?php foreach ($listBanner->result() as $banner):?>
		<?php if($banner->TYPE == "I"){?>
			<div class="ads_top1">
				<?php if($banner->URL != "")echo "<a href='".$banner->URL."' target='_blank' />";?>
					<img src="<?php if($banner->EMBED != '')echo $this->config->item('img_path').'banner/'.$banner->EMBED; else echo 'http://www.placehold.it/972x90/EFEFEF/AAAAAA&amp;text=No+Image+Available'; ?>" />
				<?php if($banner->URL != "")echo "</a>";?>
			</div>
		<?php }else{?>
			<div class="ads_top_google">
				<?php echo $banner->HTML;?>
			</div>
		<?php } endforeach;?>
		
		<div class="content_wrap">
			<div class="content_canvas">
				<!-- BreadCrumbs -->
				<div class="breadCrumb module">
					<ul>
						<li><a href="<?php echo site_url('home')?>">Home</a></li>
						<li><a href="javascript:void(0)">Pencarian</a></li>
					</ul>
				</div>
				<!-- End of BreadCrumbs -->
				
				<div class="top_wrap">
					<div class="time">Pencarian Berita</div>
					<div class="social_media">
						<a href="https://twitter.com/KlikPositif" class="twitter-follow-button" data-show-count="true">Follow @KlikPositif</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
					
					<div class="clear"></div>
				</div>
				
				<div class="content_title">Pencarian Berita KlikPositif.com</div>
				<div class="content_subtitle" ></div>
				<div class="editor"></div>
				
				<div class="news_content" style="min-height: 150px;">
					<!-- Google Custom Search -->
					<div id="cse" style="width: 100%;">Loading...</div>
				</div>
				
				<!-- <div class="read_page_view">Dibaca: <?php //echo $news->PAGE_VIEW;?> kali</div> -->
				<div class="content_action">
					<!-- FaceBook -->
					<div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('search')?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>
					
					<!-- Twitter  -->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('search')?>" data-via="KlikPositif" data-lang="id" data-hashtags="KlikPositif">Tweet</a>
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
			</div>
		</div>
		
		<div class="sidebar">
			<?php foreach ($listBannerSide->result() as $banner):?>
			<?php if($banner->TYPE == "I"){?>
				<div class="ads_side">
					<?php if($banner->URL != "")echo "<a href='".$banner->URL."' target='_blank' />";?>
						<img src="<?php if($banner->EMBED != '')echo $this->config->item('img_path').'banner/'.$banner->EMBED; else echo 'http://www.placehold.it/320x200/EFEFEF/AAAAAA&amp;text=No+Image+Available'; ?>" />
					<?php if($banner->URL != "")echo "</a>";?>
				</div>
			<?php }else{?>
				<div class="ads_side_google">
					<?php echo $banner->HTML;?>
				</div>
			<?php } endforeach;?>
			
			<div class="box">
				<div class="news_popular">
					
					<div class="news_tab">
			            <ul>
			              <li><a href="#populer">POPULER</a></li>
			              <li><a href="#latest">TERKINI</a></li>
			            </ul>
			        </div>
			        
			        <div class="tab_content" id="populer">
			        	<ul>
						<?php foreach ($listPopuler->result() as $populer):?>
							<li>
								<div class="time"><?php echo $this->bogcamp->convertDate($populer->DATE)?></div>
								<a href="<?php echo site_url('news/read/'.$populer->NEWS_ID.'/'.$populer->ALIAS)?>" title="<?php echo $populer->NEWS_TITLE?>"><?php echo $this->bogcamp->substr($populer->NEWS_TITLE, 70) ?></a>
							</li>
						<?php endforeach;?>
						</ul>
			        </div>
			        <div class="tab_content" id="latest">
			        	<ul>
						<?php foreach ($listLatestNews->result() as $latestNews):?>
							<li>
								<div class="time"><?php echo $this->bogcamp->convertDate($latestNews->DATE)?></div>
								<a href="<?php echo site_url('news/read/'.$latestNews->NEWS_ID.'/'.$latestNews->ALIAS)?>" title="<?php echo $latestNews->NEWS_TITLE?>"><?php echo $this->bogcamp->substr($latestNews->NEWS_TITLE, 70) ?></a>
							</li>
						<?php endforeach;?>
						</ul>
			        </div>
				</div>
			</div>
			
			<div class="box">
				<div class="positifers">
					<div class="title">positifers</div>
					
					<ul>
						<?php foreach ($listForum->result() as $forum):?>
							<li><a href="<?php echo base_url().'forum/viewtopic.php?f='.$forum->forum_id.'&t='.$forum->topic_id?>" target="_blank"><?php echo $forum->post_subject?></a></li>
						<?php endforeach;?>
					</ul>
					
					<div class="positifers_bottom">
						<a href="<?php echo base_url('forum')?>" target="_blank"><strong>Join</strong> our forum and be <strong>POSITIFERS</strong></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>