			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-potogal").addClass('active');
		    
		    		changeType("#type:checked");
		        });

			$(document).ready(function(){
		    		$("#submenu-kategfoto-list").addClass('active');
		        });
			
		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/potogal/kateg/'?>"; 
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Kategori Foto Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/potogal')?>">Kategori Foto Galeri</a><span class="divider">/</span></li>
						<li class='active'>Ubah Kategori Foto</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/potogal/submitkateg') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah Kategori Foto</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="hidden" value="<?php echo $ads->ID?>" name="id" />
											
											<input type="text" name="title" class="input-xlarge span12" data-rule-required="true" value="<?php echo $ads->TITLE?>">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Keterangan</label>
										<div class="controls">
											<textarea name="desc" class="input-block-level" rows="5" data-rule-required="true"><?php echo $ads->DESC?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="A" class='uniform-me' data-rule-required="true" <?php if($ads->STATUS == 'A')echo 'checked="checked"';?>> Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="N" class='uniform-me' data-rule-required="true" <?php if($ads->STATUS == 'N')echo 'checked="checked"';?>> Tidak Aktif
											</label>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan kategori foto ??', 'Ya', 'Tidak');">Batal</a>
									</div>
							</div>
							
						</div>
					</div>
					</div>
				</form>
			</div>