			<script src="<?php echo $this->config->item('ext_js')?>plugins/jcrop/js/jquery.min.js"></script>
			<script src="<?php echo $this->config->item('ext_js')?>plugins/jcrop/js/jquery.Jcrop.min.js"></script>
			<link rel="stylesheet" href="<?php echo $this->config->item('ext_js')?>plugins/jcrop/css/jquery.Jcrop.min.css" type="text/css" />
			
			<script type="text/javascript">
				$(document).ready(function(){
					$("#menu-dialog").addClass('active open');
		    		
					$('#cropbox').Jcrop({
						aspectRatio: 650/350,
						minSize: [650],
						setSelect: [ 105, 70, 180, 180 ],
						onSelect: updateCoords,
						onChange: updateCoords,
						onRelease: updateCoords
					});
					
				});
				
				$(window).bind('beforeunload', function(e){
					if(checkCoords()){
						$('#cropUnLoad').val('Crop');					
						$.ajax({
					        url		: '<?php echo site_url('backoffice/dialog/croping/'.$row->NEWS_ID)?>', 
					        data	: $('#cropFrom').serialize(),
					        beforeSend: function(){
					        	alert('Photo akan diresize otomatis...');
					        },
					        type	: "post", 
					        dataType: "html"
					    }); 
					}
				});
	
				function updateCoords(c){
					    
					$('#x').val(c.x);
					$('#y').val(c.y);
					$('#w').val(c.w);
					$('#h').val(c.h);
				};
	
				function checkCoords(){
					if (parseInt($('#w').val())){
						$(window).unbind('beforeunload');
						$(window).unbind('unload');
	
						$('#crop').val('Cropping...');
						return true;
					}
					alertPopUp('Perhatian..!!!', 'Harap pilih area yang akan dipotong pada photo...', 'Tutup');
					return false;
				};

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/dialog/fokus/'?>"; 
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Berita Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/dialog')?>">Wawancara</a><span class="divider">/</span></li>
						<li class='active'>Crop Gambar</li>
					</ul>
				</div>
			</div>
			
			<div class="container-fluid" id="content-area">
				<?php if($this->session->flashdata('error') != null):?>
	        		<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
		    	<?php endif;?>
		    	<?php if($this->session->flashdata('success') != null):?>
		        	<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
		    	<?php endif;?>
		    	
				<form enctype="multipart/form-data" onsubmit="return checkCoords();" id="cropFrom" action="<?php echo site_url('backoffice/dialog/croping/'.$row->NEWS_ID)?>" class="form-horizontal form-bordered form-validate" method="post">
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Potong Gambar</span>
							</div>
							<div class="box-body box-body-nopadding">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Area Croping</label>
										<div class="controls">
											<input type="hidden" id="x" name="x" />
											<input type="hidden" id="y" name="y" />
											<input type="hidden" id="w" name="w" />
											<input type="hidden" id="h" name="h" />
											
											<input type="hidden" id="cropUnLoad" name="cropUnLoad" />
											<input type="hidden" name="img" value="<?php echo $row->NEWS_PICTURE?>" />
											
						        			<img alt="<?php echo $row->NEWS_TITLE;?>" id="cropbox" src="<?php echo $this->config->item('img_path').'news/'.$row->NEWS_PICTURE; ?>" /><br />
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			