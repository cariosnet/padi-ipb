			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-link").addClass('active open');
		    		$("#submenu-link").addClass('active');
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/link'?>"; 
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Link Edit</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/link')?>">Link</a><span class="divider">/</span></li>
						<li class='active'>Tambah Link</li>
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
		    	
				<form action="<?php echo site_url('backoffice/link/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Form Link Edit</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama</label>
										<div class="controls">
											<input type="text" value="<?php echo $link->nama;?>" name="nama" class="input-xlarge span12" data-rule-required="true">
											<input type="hidden" name="id" value="<?php echo $link->id;?>" />
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Kategori</label>
										<div class="controls">
											<select name="link_kategori" class='chosen-select input-block-level'>
												<option value="">-- Pilih Kategori --</option>
												<?php foreach ($listCat->result() as $row): ?>
													<option <?php if($link->link_kategori == $row->id){echo 'selected="selected"';}?> value="<?php echo $row->id ?>"><?php echo $row->nama_kategori ?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Deskripsi</label>
										<div class="controls">
											<textarea name="deskripsi" class="input-block-level" rows="5" data-rule-required="true"><?php echo $link->deskripsi;?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat Tautan</label>
										<div class="controls">
											<input type="text" id="alias" value="<?php echo $link->ref_url;?>" name="ref_url" placeholder="http://link.com" class="input-xlarge span12" data-rule-required="true">
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
			
			
			