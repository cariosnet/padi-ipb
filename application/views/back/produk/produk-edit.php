			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-dokumen").addClass('active open');
		    		$("#submenu-produk").addClass('active');
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/produk'?>"; 
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Ubah Produk</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/produk')?>">Produk</a><span class="divider">/</span></li>
						<li class='active'>Ubah Produk</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/produk/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah Produk</span>
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
										<label for="textfield" class="control-label">Kategori</label>
										<div class="controls">
											<select name="kategori" class='chosen-select input-block-level'>
												<option value="">-- Parent --</option>
												<?php foreach ($listCat->result() as $row11): ?>
													<option value="<?php echo $row11->ID ?>" <?php if($row11->ID == $row->KATEGORI)echo 'selected="selected"'?>><?php echo $row11->CAT_NAME ?></option>
													
													<?php foreach ($this->X_News_Category_Model->getListCatType($idx, $row11->ID)->result() as $row2): ?>
														<option value="<?php echo $row2->ID ?>" style="padding-left: 40px;" <?php if($row2->ID == $row->KATEGORI)echo 'selected="selected"'?>><?php echo $row2->CAT_NAME ?></option>
												
														<?php foreach ($this->X_News_Category_Model->getListCatType($idx, $row2->ID)->result() as $row3): ?>
															<option value="<?php echo $row3->ID ?>" style="padding-left: 80px;" <?php if($row3->ID == $row->KATEGORI)echo 'selected="selected"'?>><?php echo $row3->CAT_NAME ?></option>
														<?php endforeach;?>
													<?php endforeach;?>
												<?php endforeach;?>
											</select>
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
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan Produk ??', 'Ya', 'Tidak');">Batal</a>
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			