			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			
			<!-- TagIt -->	
			<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
			<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/css/Aristo/Aristo.css">
			
			<script src="<?php echo $this->config->item('ext_js');?>plugins/tag-it/js/tag-it.min.js" type="text/javascript"></script>
			<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/tag-it/css/jquery.tagit.css">
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-artikel<?php echo $idx;?>").addClass('active open');
		    		$("#submenu-artikel-create<?php echo $idx;?>").addClass('active');

		    		//var sampleTags = ;
// 		    	    $("#tagIt").tagit({
// 		    	    	availableTags: sampleTags
// 		    	    });
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/artikel/page/'.$idx?>"; 
				}

		    	function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Ubah <?php echo getArtikelName($idx)?></h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/artikel/page/'.$idx)?>"><?php echo getArtikelName($idx);?></a><span class="divider">/</span></li>
						<li class='active'>Ubah <?php echo getArtikelName($idx);?></li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/artikel/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Ubah <?php echo getArtikelName($idx);?></span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Kategori</label>
										<div class="controls">
											<input type="hidden" name="id" value="<?php echo $news->NEWS_ID?>">
											<input type="hidden" id="alias" name="alias" value="<?php echo $news->ALIAS?>">
											<input type="hidden" name="alias_old" value="<?php echo $news->ALIAS?>">
											<select name="cat" class='chosen-select input-block-level'>
												<option value="">-- Parent --</option>
												<?php foreach ($listCat->result() as $row): ?>
													<option value="<?php echo $row->ID ?>" <?php if($row->ID == $news->CAT)echo 'selected="selected"'?>><?php echo $row->CAT_NAME ?></option>
													
													<?php foreach ($this->X_News_Category_Model->getListCatType($idx, $row->ID)->result() as $row2): ?>
														<option value="<?php echo $row2->ID ?>" style="padding-left: 40px;" <?php if($row2->ID == $news->CAT)echo 'selected="selected"'?>><?php echo $row2->CAT_NAME ?></option>
												
														<?php foreach ($this->X_News_Category_Model->getListCatType($idx, $row2->ID)->result() as $row3): ?>
															<option value="<?php echo $row3->ID ?>" style="padding-left: 80px;" <?php if($row3->ID == $news->CAT)echo 'selected="selected"'?>><?php echo $row3->CAT_NAME ?></option>
														<?php endforeach;?>
													<?php endforeach;?>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									
									<div class="control-group">
										<label for="textfield" class="control-label">Judul</label>
										<div class="controls">
											<input type="text" value="<?php echo $news->NEWS_TITLE?>" onkeyup="setAlias(this);" onblur="setAlias(this);" name="news_title" class="input-xlarge span12" data-rule-required="true">
											<input type="hidden" name="type" value="<?php echo $idx;?>" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Sub Judul</label>
										<div class="controls">
											<input type="text" value="<?php echo $news->NEWS_SUBTITLE?>" name="news_subtitle" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 650px; height: 350px;"><img src="<?php if($news->NEWS_PICTURE != '')echo $this->config->item('img_path').'news/'.$news->NEWS_PICTURE; else echo 'http://www.placehold.it/650x350/EFEFEF/AAAAAA&amp;text=no+image' ?>" /></div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 650px; max-height: 350px; line-height: 20px;"></div>
												<div>
													<span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="news_picture" /></span>
													<a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
											
											<input type="hidden" name="news_picture_old" value="<?php echo $news->NEWS_PICTURE; ?>" />
											<span class="help-block" style="color: red">
												Untuk penampilan optimum.. Resolusi <strong>Minimal</strong> 650px * 350px (W = 650px, H = 350px)
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Judul Gambar</label>
										<div class="controls">
											<input type="text" value="<?php echo $news->NEWS_PICTURE_CAPTION?>" name="news_picture_caption" class="input-xlarge span12" >
										</div>
									</div>
<!-- 									<div class="control-group"> -->
<!-- 										<label for="textfield" class="control-label">Sumber Gambar</label> -->
<!-- 										<div class="controls">
											<input type="text" placeholder="" value="<?php echo $news->NEWS_PICTURE_SOURCE?>" name="news_picture_source" class="input-xlarge span12" data-rule-required="true">
<!-- 										</div> -->
<!-- 									</div> -->
									<div class="control-group">
										<label for="textfield" class="control-label">Penulis</label>
										<div class="controls">
											<input type="text" value="<?php echo $news->WRITER?>" placeholder="Penulis 1, Penulis 2, dst..." name="writer" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
<!-- 									<div class="control-group"> -->
<!-- 										<label for="textfield" class="control-label">Editor</label> -->
<!-- 										<div class="controls"> 
											<input type="text" value="<?php echo $news->EDITOR?>" placeholder="Editor 1, Editor 2, dst..." name="editor" class="input-xlarge span12" data-rule-required="true">
<!-- 										</div> -->
<!-- 									</div> -->
									<div class="control-group">
										<label for="timepicker" class="control-label">Waktu Artikel</label>
										<div class="controls">
											<div class="bootstrap-timepicker">
												<input type="text" name="x_date" id="textfield" class="input-small datepick" value="<?php echo date("d-m-Y", strtotime($news->DATE));?>" data-date-format="dd-mm-yyyy">
												<input type="text" name="x_time" id="timepicker" class="input-mini timepick" value="<?php echo date("H:i:s", strtotime($news->DATE));?>">
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
								<span>Isi Artikel</span>
							</div>
							<div class="box-body box-body-nopadding">
								<textarea name="news_content" class='span12' rows="10" id="editor1"><?php echo $news->NEWS_CONTENT?></textarea>
								
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
								<span>Form Ubah Artikel</span>
							</div>
							<div class="box-body box-body-nopadding">
									
									<div class="control-group">
										<label for="textfield" class="control-label">Headline?</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="is_headline" value="1" class='uniform-me' data-rule-required="true" <?php if($news->IS_HEADLINE == 1)echo 'checked="checked"';?>> Ya
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="is_headline" value="0" class='uniform-me' data-rule-required="true" <?php if($news->IS_HEADLINE == 0)echo 'checked="checked"';?>> Tidak
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="A" class='uniform-me' data-rule-required="true" <?php if($news->STATUS == 'A')echo 'checked="checked"';?>> Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="N" class='uniform-me' data-rule-required="true" <?php if($news->STATUS == 'N')echo 'checked="checked"';?>> Tidak Aktif
											</label>
										</div>
									</div>
<!-- 									<div class="control-group"> -->
<!-- 										<label for="textfield" class="control-label">Tag</label> -->
<!-- 										<div class="controls"> 
											<div style="padding: 0px;">
												<input type="text" id="tagIt" name="tags" class="input-xlarge span12" value="<?php echo $news->TAGS?>">
<!-- 											</div> -->
<!-- 										</div> -->
<!-- 									</div> -->
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Description</label>
										<div class="controls">
											<textarea name="meta_desc" class="input-block-level" rows="5" data-rule-required="true"><?php echo $news->META_DESC?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Keyword</label>
										<div class="controls">
											<input type="text" placeholder="Keyword 1, Ketword 2, ... Keyword n (Dipisahkan koma)" value="<?php echo $news->META_KEY?>" name="meta_key" class="span12" data-rule-required="true">
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
			
			
			