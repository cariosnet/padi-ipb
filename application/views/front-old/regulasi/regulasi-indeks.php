	<script type="text/javascript">
    	$(document).ready(function(){
    		sendFilterRequest();
        });

        function viewAll(){
        	$("#title").val("");
        	sendFilterRequest();
        }

    	function sendFilterRequest(){
    		var loader = "<?php echo $this->config->item('ext_img').'loader/loading-git.gif' ?>";
    		
    	    jQuery.ajax({
    	        url: "<?php echo site_url('indeks/ajax_filter_special/regulasi')?>", 
    	        data: $("#ajax_filter").serialize(),
    	        beforeSend: function(){
    	        	jQuery("#result").html('<div style="text-align: center;margin: 100px auto; font-size: 26px;"><img src="'+loader+'" /><br />Loading....</div>');
    	        },
    	        success: function(response){
    	                jQuery("#result").html(response);
    	            },
    	        type: "post", 
    	        dataType: "html"
    	    }); 

    	    return false;
    	}
    </script>
	
	<div class="container">
		
		<div class="content_wrap">
			<div class="content_canvas">
				<!-- BreadCrumbs -->
				<div class="breadCrumb module">
					<ul>
						<li><a href="<?php echo site_url('home')?>">Home</a></li>
						<li><a href="javascript:void(0)">Regulasi</a></li>
					</ul>
				</div>
				<!-- End of BreadCrumbs -->
				
				<div class="content_title">Indeks regulasi</div>
				<div class="content_subtitle" style="padding: 0px; margin-bottom: 10px;"></div>
				
				<div class="news_content" style="min-height: 350px;">
					<form id="ajax_filter" action="<?php echo site_url('indeks/ajax_filter_special')?>" method="post" onsubmit="return sendFilterRequest()">
						Title: <input type="text" name="title" id="title" style="width: 275px;" value="" />
						<input type="hidden" name="type" value="RE" />
						<input type="hidden" name="name" value="Regulasi" />
						<a href="javascript:void(0)" onclick="sendFilterRequest();" class="uibutton">Cari Regulasi</a>
						<a href="javascript:void(0)" onclick="viewAll();" class="uibutton special">Tampilkan Semua Indeks</a>
					</form>
					
					<div id="result"></div>
				</div>
				
				<!-- <div class="read_page_view">Dibaca: <?php //echo $news->PAGE_VIEW;?> kali</div> -->
				<div class="content_action">
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
			
			<?php $this->load->view("front/sidebar");?>
			
			
		</div>
		
		<div class="clear"></div>
	</div>