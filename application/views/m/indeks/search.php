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
	<div class="headline_wrap" style="min-height: 50px;">
		<div class="breadcrumbs">
			&raquo; Home&nbsp;
			&raquo; Pencarian&nbsp;
		</div>
		<div class="news_properties">
			<div class="content_title">Pencarian</div>
		</div>
	</div>
				
	<div class="news_content" style="min-height: 100px;">
		<!-- Google Custom Search -->
		<div id="cse" style="width: 100%;">Loading...</div>
	</div>
	
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