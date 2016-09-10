			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-lembaga").addClass('active open');
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
					window.location = "<?php echo base_url().'backoffice/pages'?>"; 
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Ubah Menu</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/pages')?>">Menu</a><span class="divider">/</span></li>
						<li class='active'>Ubah Menu</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/pages/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah Menu</span>
							</div>
							<div class="box-body box-body-nopadding">
								
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="hidden" name="id" value="<?php echo $pages->ID?>">
											<input type="hidden" name="alias_old" value="<?php echo $pages->ALIAS?>">
											<input type="text" value="<?php echo $pages->TITLE?>" onkeyup="setAlias(this);" onblur="setAlias(this);" name="title" class="input-xlarge span12" data-rule-required="true">
											<input type="hidden" id="alias" value="<?php echo $pages->ALIAS?>" name="alias" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									
									
									<div class="control-group">
										<label for="textfield" class="control-label">Parent</label>
										<div class="controls">
											<select name="parent">
												<option value="">-- Sebagai Parent --</option>
												<?php foreach ($listParent->result() as $parent):?>
												<?php if($parent->ID != $pages->ID): ?>
												<option value="<?php echo $parent->ID?>" <?php if($pages->PARENT == $parent->ID)echo 'selected="selected"';?>><?php echo $parent->TITLE?></option>
												<?php endif;?>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									
									<div class="control-group">
										<label for="textfield" class="control-label">Warna</label>
										<div class="controls">
											<input type="text" name="color" class="input-mini colorpick" value="<?php echo $pages->COLOR?>" data-rule-required="true">
											<span class="help-block">Pilihan warna untuk menu</span>
										</div>
									</div>
									
									<div class="control-group">
										<label for="textfield" class="control-label">Urutan</label>
										<div class="controls">
											<input type="hidden" value="<?php echo $pages->ORDER;?>" name="order_old" />
											<input type="text"  name="order" value="<?php echo $pages->ORDER?>" class="input-mini" data-rule-integer="true" data-rule-required="true" placeholder="Angka..">
											<span class="help-block">Pilihan urutan untuk halaman (Bilangan Bulat)</span>
										</div>
									</div>
									
									
									<div class="control-group">
										<label for="textfield" class="control-label">Type</label>
										<div class="controls">
											<select name="type" id="selectType">
												<option <?php if($pages->TYPE==1)echo "selected='selected'";?> value="1">Page</option>
												<option <?php if($pages->TYPE==2)echo "selected='selected'";?> value="2">Link Path</option>
											</select>
										</div>
									</div>
									<div class="control-group linkInput" <?php if($pages->TYPE==1)echo 'style="display: none;"';?>>
										<label for="textfield" class="control-label">Link Path</label>
										<div class="controls">
											<input type="text" name="ref_url" class="input-xlarge span12" value="<?php echo $pages->REF_URL;?>">
											<span class="help-block">Isi path menu dengan pemisah "/", contoh: dokumen/regulasi. Atau kosongkan untuk path "home"</span>
										</div>
									</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="row-fluid" <?php if($pages->TYPE==2)echo 'style="display: none;"';?>>
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-list-ul"></i>
								<span>Isi Berita</span>
							</div>
							<div class="box-body box-body-nopadding">
								<textarea name="content" class='span12' rows="5" id="editor1"><?php echo $pages->CONTENT?></textarea>
							
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
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah Menu</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group"  <?php if($pages->TYPE==2)echo 'style="display: none;"';?>>
										<label for="textfield" class="control-label">Meta Description</label>
										<div class="controls">
											<textarea name="meta_desc" class="input-block-level" rows="5" ><?php echo $pages->META_DESC?></textarea>
										</div>
									</div>
									<div class="control-group"  <?php if($pages->TYPE==2)echo 'style="display: none;"';?>>
										<label for="textfield" class="control-label">Meta Keyword</label>
										<div class="controls">
											<input type="text" placeholder="Keyword 1, Ketword 2, ... Keyword n (Dipisahkan koma)" value="<?php echo $pages->META_KEY?>" name="meta_key" class="span12" >
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan ??', 'Ya', 'Tidak');">Batal</a>
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			