			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-ads").addClass('active open');
		    		$("#submenu-ads-create").addClass('active');
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/ads/'?>"; 
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Ubah Iklan</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/ads')?>">Iklan</a><span class="divider">/</span></li>
						<li class='active'>Ubah Iklan Baris</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/ads/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Data Pengiklan</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Pengiklan</label>
										<div class="controls">
											<input type="text" value="<?php echo $ads->ADS_AUTHOR; ?>" name="ads_author" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Telp. Pengiklan</label>
										<div class="controls">
											<input type="text" value="<?php echo $ads->ADS_AUTHOR_PHONE; ?>" name="ads_author_phone" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Email Pengiklan</label>
										<div class="controls">
											<input type="text" value="<?php echo $ads->ADS_AUTHOR_EMAIL; ?>" name="ads_author_email" class="input-xlarge span12">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat Pengiklan</label>
										<div class="controls">
											<textarea name="ads_author_address" class="input-block-level" rows="5" data-rule-required="true"><?php echo $ads->ADS_AUTHOR_ADDRESS; ?></textarea>
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
								<span>Form Iklan Baris</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Kategori</label>
										<div class="controls">
											<input type="hidden" name="id" value="<?php echo $ads->ADS_ID?>">
											<input type="hidden" id="alias" name="alias" value="<?php echo $ads->ALIAS?>">
											<input type="hidden" name="alias_old" value="<?php echo $ads->ALIAS?>">
											<select name="ads_cat" class='chosen-select input-block-level'>
												<?php foreach ($listCat->result() as $row): ?>
													<option value="<?php echo $row->ID ?>" <?php if($row->ID == $ads->ADS_CAT)echo 'selected="selected"'?>><?php echo $row->CAT_NAME ?></option>
													
													<?php foreach ($this->X_Ads_Category_Model->getListCat($row->ID, $row->ID)->result() as $row2): ?>
														<option value="<?php echo $row2->ID ?>" style="padding-left: 40px;" <?php if($row2->ID == $ads->ADS_CAT)echo 'selected="selected"'?>><?php echo $row2->CAT_NAME ?></option>
												
														<?php foreach ($this->X_Ads_Category_Model->getListCat($row2->ID, $row2->ID)->result() as $row3): ?>
															<option value="<?php echo $row3->ID ?>" style="padding-left: 80px;" <?php if($row3->ID == $ads->ADS_CAT)echo 'selected="selected"'?>><?php echo $row3->CAT_NAME ?></option>
														<?php endforeach;?>
													<?php endforeach;?>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="text" value="<?php echo $ads->ADS_TITLE; ?>" onkeyup="setAlias(this);" onblur="setAlias(this);" name="ads_title" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 650px; height: 350px;"><img src="<?php if($ads->ADS_PICTURE != '')echo $this->config->item('img_path').'ads/'.$ads->ADS_PICTURE; else echo 'http://www.placehold.it/650x350/EFEFEF/AAAAAA&amp;text=no+image' ?>" /></div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 650px; max-height: 350px; line-height: 20px;"></div>
												<div>
													<span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="ads_picture" /></span>
													<a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
											
											<input type="hidden" name="ads_picture_old" value="<?php echo $ads->ADS_PICTURE; ?>" />
											<span class="help-block" style="color: red">
												Untuk penampilan optimum.. Resolusi <strong>Minimal</strong> 650px * 350px (W = 650px, H = 350px)
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="timepicker" class="control-label">Tanggal Mulai</label>
										<div class="controls">
											<div class="bootstrap-timepicker">
												<input type="text" name="ads_start" id="textfield" class="input-small datepick" value="<?php echo date('d-m-Y', strtotime($ads->ADS_START)); ?>" data-date-format="dd-mm-yyyy" data-rule-required="true">
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="timepicker" class="control-label">Tanggal Selesai</label>
										<div class="controls">
											<div class="bootstrap-timepicker">
												<input type="text" name="ads_finish" id="textfield2" class="input-small datepick" value="<?php echo date('d-m-Y', strtotime($ads->ADS_FINISH)); ?>" data-date-format="dd-mm-yyyy" data-rule-required="true">
											</div>
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
								<span>Isi Iklan</span>
							</div>
							<div class="box-body box-body-nopadding">
								<textarea name="ads_content" class='span12' rows="10" id="editor1"><?php echo $ads->ADS_CONTENT; ?></textarea>
								
								<script type="text/javascript">
									var editor = CKEDITOR.replace('editor1', {
										skin: 'moonocolor'
									});
								</script>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah Berita</span>
							</div>
							<div class="box-body box-body-nopadding">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="AKTIF" class='uniform-me' data-rule-required="true" <?php if($ads->STATUS == 'AKTIF')echo 'checked="checked"';?>> Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="TIDAK AKTIF" class='uniform-me' data-rule-required="true" <?php if($ads->STATUS == 'TIDAK AKTIF')echo 'checked="checked"';?>> Tidak Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="REJECT" class='uniform-me' data-rule-required="true" <?php if($ads->STATUS == 'REJECT')echo 'checked="checked"';?>> Reject
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Description</label>
										<div class="controls">
											<textarea name="meta_desc" class="input-block-level" rows="5" data-rule-required="true"><?php echo $ads->META_DESC; ?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Keyword</label>
										<div class="controls">
											<input type="text" placeholder="Keyword 1, Ketword 2, ... Keyword n (Dipisahkan koma)" name="meta_key" class="span12" value="<?php echo $ads->META_KEY; ?>" data-rule-required="true">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan iklan ??', 'Ya', 'Tidak');">Batal</a>
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			