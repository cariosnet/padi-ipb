			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-fokus").addClass('active open');
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/fokus/create/'?>"; 
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Fokus Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/fokus')?>">Fokus</a><span class="divider">/</span></li>
						<li class='active'>Tambah Fokus</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/fokus/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Fokus Baru</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="hidden" id="alias" name="alias">
											<input type="text" onkeyup="setAlias(this);" onblur="setAlias(this);" name="news_title" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Sub Judul</label>
										<div class="controls">
											<input type="text" name="news_subtitle" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 300px; height: 162px;"><img src="http://www.placehold.it/300x162/EFEFEF/AAAAAA&amp;text=no+image" /></div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 650px; max-height: 350px; line-height: 20px;"></div>
												<div>
													<span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="news_picture" /></span>
													<a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
											
											<span class="help-block" style="color: red">
												Untuk penampilan optimum.. Resolusi <strong>WAJIB</strong> 650px * 350px (W = 650px, H = 350px)
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Judul Gambar</label>
										<div class="controls">
											<input type="text" name="news_picture_caption" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Sumber Gambar</label>
										<div class="controls">
											<input type="text" placeholder="" name="news_picture_source" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Penulis</label>
										<div class="controls">
											<input type="text" placeholder="Penulis 1, Penulis 2, dst..." name="writer" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Editor</label>
										<div class="controls">
											<input type="text" placeholder="Editor 1, Editor 2, dst..." name="editor" class="input-xlarge span12" data-rule-required="true">
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
								<textarea name="news_content" class='span12' rows="10" id="editor1"></textarea>
								
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
								<span>Form Berita Baru</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="A" class='uniform-me' data-rule-required="true"> Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="N" class='uniform-me' data-rule-required="true"> Tidak Aktif
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Description</label>
										<div class="controls">
											<textarea name="meta_desc" class="input-block-level" rows="5" data-rule-required="true"></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Keyword</label>
										<div class="controls">
											<input type="text" placeholder="Keyword 1, Ketword 2, ... Keyword n (Dipisahkan koma)" name="meta_key" class="span12" data-rule-required="true">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan fokus ??', 'Ya', 'Tidak');">Batal</a>
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			