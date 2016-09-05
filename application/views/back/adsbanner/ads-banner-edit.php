			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-adsbanner").addClass('active open');
		    		$("#submenu-adsbanner-create").addClass('active');

		    		changeType("#type:checked");
		        });

		    	function changeType(obj){
					var x = $(obj).val();

					if(x == "I"){
						$("#toggle_link").show();
						$("#toggle_image").show();
						$("#toggle_text").hide();
					}else{
						$("#toggle_link").hide();
						$("#toggle_image").hide();
						$("#toggle_text").show();
					}
		    	}

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/adsbanner/'?>"; 
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Berita Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/adsbanner')?>">Iklan Banner</a><span class="divider">/</span></li>
						<li class='active'>Ubah Iklan</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/adsbanner/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah Iklan banner</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="hidden" value="<?php echo $ads->ID?>" name="id" />
											<input type="hidden" value="<?php echo $ads->KIND?>" name="kind" />
											<input type="text" name="title" class="input-xlarge span12" data-rule-required="true" value="<?php echo $ads->TITLE?>">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Jenis</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="type" id="type" value="I" class='uniform-me' data-rule-required="true" <?php if($ads->TYPE == 'I')echo 'checked="checked"';?> onclick="changeType(this);"> Image
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="type" id="type" value="C" class='uniform-me' data-rule-required="true" <?php if($ads->TYPE == 'C')echo 'checked="checked"';?> onclick="changeType(this);"> HTML Script
											</label>
										</div>
									</div>
									<div class="control-group" id="toggle_text">
										<label for="textfield" class="control-label">HTML Script</label>
										<div class="controls">
											<textarea name="html" class="input-block-level" rows="5" data-rule-required="true"><?php echo $ads->HTML?></textarea>
										</div>
									</div>
									<div class="control-group" id="toggle_image">
										<label for="textfield" class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: <?php echo $widthSizeTmp;?>px;"><img src="<?php if($ads->EMBED != '')echo $this->config->item('img_path').'banner/'.$ads->EMBED; else echo 'http://www.placehold.it/'.$widthSizeTmp.'x'.$heightSize.'/EFEFEF/AAAAAA&amp;text=no+image'; ?>" /></div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: <?php echo $widthSizeTmp;?>px; max-height: <?php echo $heightSize;?>px; line-height: 20px;"></div>
												<div>
													<span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="embed" /></span>
													<a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
											<span class="help-block" style="color: red">
												Resolusi &raquo; <strong>Lebar: <?php echo $widthSize;?>px</strong>
												<input type="hidden" name="embed_old" value="<?php echo $ads->EMBED;?>" />
												<input type="hidden" name="width_size" value="<?php echo $widthSize;?>" />
											</span>
										</div>
									</div>
									<div class="control-group" id="toggle_link">
										<label for="textfield" class="control-label">Link</label>
										<div class="controls">
											<input type="text" name="url" class="input-xlarge span12" data-rule-url="true" value="<?php echo $ads->URL?>" placeholder="URL / Hyperlink Untuk Iklan contoh: http://klikpositif.com/contoh">
											
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Posisi</label>
										<div class="controls">
											<select multiple="multiple" id="my-select" name="position[]" class='multiselect'>
												<?php foreach ($listPosition->result() as $posisi):?>
												<option value='<?php echo $posisi->ID?>' <?php if(in_array($posisi->ID, $position))echo 'selected="selected"';?>><?php echo $posisi->POSITION_NAME?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									
									<div class="control-group">
										<label for="textfield" class="control-label">Urutan</label>
										<div class="controls">
											<input type="text" name="order" class="input-mini" data-rule-integer="true" data-rule-required="true" placeholder="Angka.." value="<?php echo $ads->ORDER?>">
											
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
									<div class="control-group">
										<label for="textfield" class="control-label">Keterangan</label>
										<div class="controls">
											<textarea name="desc" class="input-block-level" rows="5" data-rule-required="true"><?php echo $ads->DESC?></textarea>
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan berita ??', 'Ya', 'Tidak');">Batal</a>
									</div>
							</div>
							
						</div>
					</div>
					</div>
				</form>
			</div>