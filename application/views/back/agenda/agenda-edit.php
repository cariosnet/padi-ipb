			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-hukum").addClass('active open');
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/agenda'?>"; 
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Ubah Agendam</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/agenda')?>">Agendam</a><span class="divider">/</span></li>
						<li class='active'>Ubah Agendam</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/agenda/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah Agenda</span>
							</div>
							<div class="box-body box-body-nopadding">
								
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="hidden" name="id" value="<?php echo $row->ID?>">
											<input type="hidden" id="alias" name="alias" value="<?php echo $row->ALIAS?>">
											<input type="hidden" name="alias_old" value="<?php echo $row->ALIAS?>">
											<input type="text" value="<?php echo $row->TITLE?>" onkeyup="setAlias(this);" onblur="setAlias(this);" name="title" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="timepicker" class="control-label">Waktu</label>
										<div class="controls">
											<div class="bootstrap-timepicker">
												<input type="text" name="x_date" id="textfield" class="input-small datepick" value="<?php echo date("d-m-Y", strtotime($row->DATE));?>" data-date-format="dd-mm-yyyy">
												<input type="text" name="x_time" id="timepicker" class="input-mini timepick" value="<?php echo date("H:i:s", strtotime($row->DATE));?>">
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">File</label>
										<div class="controls">
											<input type="hidden" name="file_old" value="<?php echo $row->FILE?>">
											<a target="_blank" href="<?php echo $this->config->item('file_path').$row->FILE?>"><?php echo $row->FILE?></a><br />
											<input type="file" name="file" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="A" class='uniform-me' data-rule-required="true" <?php if($row->STATUS == 'A')echo 'checked="checked"';?>> Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="N" class='uniform-me' data-rule-required="true" <?php if($row->STATUS == 'N')echo 'checked="checked"';?>> Tidak Aktif
											</label>
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
								<i class="icon-list-ul"></i>
								<span>Isi Berita</span>
							</div>
							<div class="box-body box-body-nopadding">
								<textarea name="desc" class='span12' rows="10" id="editor1"><?php echo $row->DESC?></textarea>
								
								<script type="text/javascript">
									var editor = CKEDITOR.replace('editor1', {
										skin: 'moonocolor'
									});
									CKFinder.setupCKEditor( editor, '<?php echo base_url()?>extra/ckfinder' ) ;
								</script>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head"></div>
							<div class="box-body box-body-nopadding">
									
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan Agendam ??', 'Ya', 'Tidak');">Batal</a>
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			