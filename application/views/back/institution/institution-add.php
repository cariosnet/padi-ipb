			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-pages").addClass('active open');
		    		$("#selectType").change(function(){
						if($(this).val() == 1){
							$(".linkInput").hide();
							$(".artikelInput").show();
						}else{
							$(".linkInput").show();
							$(".artikelInput").hide();
						}
		    		});
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/institution'?>";
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Institusi Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/institution')?>">Institusi</a><span class="divider">/</span></li>
						<li class='active'>Tambah Institusi</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/institution/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Institusi Baru</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Lembaga / Institusi</label>
										<div class="controls">
											<input type="text" name="name" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<select name="status">
												<option value="">-- Pilih Status --</option>
												<?php foreach ($listStatus->result() as $parent):?>
												<option value="<?php echo $parent->ID?>"><?php echo $parent->STATUS?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Daerah</label>
										<div class="controls">
											<input type="text" name="area" data-rule-required="true" class="input-xlarge span6">
										</div>
									</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Deskripsi</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group artikelInput">
										<label for="textfield" class="control-label">Deskripsi Singkat</label>
										<div class="controls">
											<textarea name="desc" id="desc_editor" class="input-block-level" rows="5"></textarea>
                                            <script type="text/javascript">
                                                var editor = CKEDITOR.replace('desc_editor', {
                                                    skin: 'moonocolor'
                                                });
                                                CKFinder.setupCKEditor( editor, '<?php echo base_url()?>extra/ckfinder' ) ;
                                            </script>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan halaman ??', 'Ya', 'Tidak');">Batal</a>
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			