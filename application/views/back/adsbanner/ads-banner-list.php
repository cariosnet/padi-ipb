			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-adsbanner").addClass('active open');
		    		$("#submenu-adsbanner-list").addClass('active');
		        });

		    	function deleteRow(id){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/adsbanner/delete/'?>"+id; 
				}
		    </script>
		    <style>
		    	table.my-custom tr td{
		    		vertical-align: top;
		    	}
		    </style>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Daftar Iklan Banner</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/adsbanner')?>">Iklan</a><span class="divider">/</span></li>
						<li class='active'>Daftar Iklan Banner</li>
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
		    	
				<div class="row-fluid">
											<div class="span12">
												<div class="box">
													<div class="box-head">
														<i class="icon-table"></i>
														<span>Daftar Iklan Banner</span>
													</div>
													<div class="box-body box-body-nopadding">
														<div class="highlight-toolbar">
															<div class="pull-left"><div class="btn-toolbar">
																<div class="btn-group">
																	<a href="<?php echo site_url('backoffice/adsbanner/create')?>" class="button button-basic" rel="tooltip" title="Tambah Banner"><i class="icon-plus"></i> Tambah Iklan Banner</a>
																</div>
															</div></div>
														</div>
														<table class="table table-nomargin table-bordered dataTable table-striped table-hover my-custom">
															<thead>
																<tr>
																	<th width="20px">No.</th>
																	<th>Judul</th>
																	<th width="80px">Ukuran</th>
																	<th width="160px">Posisi</th>
																	<th width="20px">Urut</th>
																	<th width="20px">Status</th>
																	<th width="20px">Aksi</th>
																</tr>
															</thead>
															<tbody>
															<?php 
															$no = 1;
															foreach ($listBanner->result() as $row):
															?>
																<tr style="text-align: center;">
																	<td style="text-align: center;"><?php echo $no++;?>.</td>
																	<td><?php echo $row->TITLE?></td>
																	<td><?php if($row->KIND == 'a')echo 'Lebar: 972px'; else echo 'Lebar: 320px'; ?></td>
																	<td>
																		<ul>
																			<?php foreach ($this->X_Ads_Position_Model->getListPositionBannerJoin($row->ID)->result() as $postBan):?>
																				<li><?php echo $postBan->POSITION_NAME?></li>
																			<?php endforeach;?>
																		</ul>
																	</td>
																	<td style="text-align: center;"><?php echo $row->ORDER?></td>
																	<td style="text-align: center;"><img style="width: 20px;" alt="Y" src="<?php if($row->STATUS == 'A')$img = "true.png";else $img ="false.png"; echo $this->config->item('ext_img').$img;?>" /></td>
																	<td>
																		<div class="btn-toolbar" style="margin: 0; padding: 0;">
																			<div class="btn-group">
																				<a href="<?php echo site_url('backoffice/adsbanner/edit/'.$row->ID)?>" class='button button-basic button-small' rel="tooltip" title="Ubah"><i class="icon-edit"></i></a>
																				<a href="javascript:void(0);" class='button button-basic button-small' rel="tooltip" title="Hapus" onclick="confirmPopUp('deleteRow(<?php echo $row->ID?>)', 'Peringatan..', 'Anda yakin ingin dihapus ??', 'Ya', 'Tidak');"><i class="icon-trash"></i></a>
																			</div>
																		</div>
																	</td>
																</tr>
															<?php endforeach;?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
					</div>
			</div>