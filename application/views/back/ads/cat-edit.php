			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-ads").addClass('active open');
		    		$("#submenu-adscat-list").addClass('active');
		        });

		        function setAlias(obj){
					var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
					$("#alias").val(text);
		        }
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Ubah Kategori Berita</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/ads')?>">Iklan</a><span class="divider">/</span></li>
						<li class='active'>Kategori Iklan</li>
					</ul>
				</div>
			</div>
			
			<div class="container-fluid" id="content-area">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Tambah Kategori</span>
							</div>
							<div class="box-body box-body-nopadding">
								<form action="<?php echo site_url('backoffice/ads_properties/cat/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Kanal</label>
										<div class="controls">
											<input type="text" onkeyup="setAlias(this);" onblur="setAlias(this);" name="cat_name" class="input-xlarge" data-rule-required="true" value="<?php echo $cat->CAT_NAME?>">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alias</label>
										<div class="controls">
											<input type="text" id="alias" name="cat_alias" class="input-xlarge" data-rule-required="true" value="<?php echo $cat->CAT_ALIAS?>">
											<input type="hidden" name="cat_alias_old" value="<?php echo $cat->CAT_ALIAS?>">
											<input type="hidden" name="id" value="<?php echo $cat->ID?>">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Urutan</label>
										<div class="controls">
											<input type="text" name="cat_order" class="input-mini" data-rule-integer="true" data-rule-required="true" placeholder="Angka.." value="<?php echo $cat->CAT_ORDER?>">
											<span class="help-block">Pilihan urutan untuk sorting kanal</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Parent</label>
										<div class="controls">
											<select name="parent" class='chosen-select input-block-level'>
												<option value="">-- Parent --</option>
												<?php foreach ($listCat->result() as $row): ?>
													<option value="<?php echo $row->ID ?>" <?php if($row->ID == $cat->PARENT)echo 'selected="selected"'?>><?php echo $row->CAT_NAME ?></option>
													
													<?php foreach ($this->X_Ads_Category_Model->getListCat($row->ID, $row->ID)->result() as $row2): ?>
														<option value="<?php echo $row2->ID ?>" style="padding-left: 40px;" <?php if($row2->ID == $cat->PARENT)echo 'selected="selected"'?>><?php echo $row2->CAT_NAME ?></option>
												
														
													<?php endforeach;?>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Deskripsi</label>
										<div class="controls">
											<textarea name="meta_desc" class="input-block-level" rows="5"><?php echo $cat->META_DESC?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Keyword</label>
										<div class="controls">
											<input type="text" name="meta_key" class="span12" data-rule-required="true" value="<?php echo $cat->META_KEYWORD?>">
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="<?php echo site_url('backoffice/ads_properties/cat')?>" class="button button-basic">Batal</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			