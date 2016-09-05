			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			
			<!-- TagIt -->	
			<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
			<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/css/Aristo/Aristo.css">
			
			<script src="<?php echo $this->config->item('ext_js');?>plugins/tag-it/js/tag-it.min.js" type="text/javascript"></script>
			<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/tag-it/css/jquery.tagit.css">
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-news").addClass('active open');
		    		$("#submenu-news-create").addClass('active');
		    		
		    		//var sampleTags = ;
// 		    	    $("#tagIt").tagit({
// 		    	    	availableTags: sampleTags
// 		    	    });
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/news/create/'?>"; 
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
						<li><a href="<?php echo site_url('backoffice/news')?>">Berita</a><span class="divider">/</span></li>
						<li class='active'>Buat Berita</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/news/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Berita Baru</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Kategori</label>
										<div class="controls">
											<select name="cat" class='chosen-select input-block-level'>
												<option value="">-- Pilih Kategori --</option>
												<?php foreach ($listCat->result() as $row): ?>
													<option value="<?php echo $row->ID ?>"><?php echo $row->CAT_NAME ?></option>
													
													<?php foreach ($this->X_News_Category_Model->getListCat($row->ID, $row->ID)->result() as $row2): ?>
														<option value="<?php echo $row2->ID ?>" style="padding-left: 40px;"><?php echo $row2->CAT_NAME ?></option>
												
														<?php foreach ($this->X_News_Category_Model->getListCat($row2->ID, $row2->ID)->result() as $row3): ?>
															<option value="<?php echo $row3->ID ?>" style="padding-left: 80px;"><?php echo $row3->CAT_NAME ?></option>
														<?php endforeach;?>
													<?php endforeach;?>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="text" onkeyup="setAlias(this);" onblur="setAlias(this);" name="news_title" class="input-xlarge span12" data-rule-required="true">
											<input type="hidden" name="alias" id="alias" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Sub Judul</label>
										<div class="controls">
											<input type="text" value="" name="news_subtitle" class="input-xlarge span12" data-rule-required="true">
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
												Untuk penampilan optimum.. Resolusi <strong>Minimal</strong> 650px * 350px (W = 650px, H = 350px)
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Judul Gambar</label>
										<div class="controls">
											<input type="text" name="news_picture_caption" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
<!-- 									<div class="control-group"> -->
<!-- 										<label for="textfield" class="control-label">Sumber Gambar</label> -->
<!-- 										<div class="controls"> -->
<!-- 											<input type="text" placeholder="" name="news_picture_source" class="input-xlarge span12" data-rule-required="true"> -->
<!-- 										</div> -->
<!-- 									</div> -->
									<div class="control-group">
										<label for="textfield" class="control-label">Penulis</label>
										<div class="controls">
											<input type="text" placeholder="Penulis 1, Penulis 2, dst..." name="writer" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
<!-- 									<div class="control-group"> -->
<!-- 										<label for="textfield" class="control-label">Editor</label> -->
<!-- 										<div class="controls"> -->
<!-- 											<input type="text" placeholder="Editor 1, Editor 2, dst..." name="editor" class="input-xlarge span12" data-rule-required="true"> -->
<!-- 										</div> -->
<!-- 									</div> -->
									<div class="control-group">
										<label for="timepicker" class="control-label">Waktu Berita</label>
										<div class="controls">
											<div class="bootstrap-timepicker">
												<input type="text" name="x_date" id="textfield" class="input-small datepick" value="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
												<input type="text" name="x_time" id="timepicker" class="input-mini timepick">
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
										<label for="textfield" class="control-label">Headline?</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="is_headline" value="1" class='uniform-me' data-rule-required="true"> Ya
											</label>
											<label class='radio-uniformed'>
												<input type="radio" checked="checked" name="is_headline" value="0" class='uniform-me' data-rule-required="true"> Tidak
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="status" checked="checked" value="A" class='uniform-me' data-rule-required="true"> Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="N" class='uniform-me' data-rule-required="true"> Tidak Aktif
											</label>
										</div>
									</div>
<!-- 									<div class="control-group"> -->
<!-- 										<label for="textfield" class="control-label">Tag</label> -->
<!-- 										<div class="controls"> -->
<!-- 											<div style="padding: 0px;"> -->
<!-- 												<input type="text" id="tagIt" name="tags" class="input-xlarge span12"> -->
<!-- 											</div> -->
<!-- 										</div> -->
<!-- 									</div> -->
									<div class="control-group">
										<label for="textfield" class="control-label">Deskripsi Singkat</label>
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
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan berita ??', 'Ya', 'Tidak');">Batal</a>
									</div>
								
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			