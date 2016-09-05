			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-potogal").addClass('active');
		        });
			
			$(document).ready(function(){
		    		$("#submenu-kategfoto-list").addClass('active');
		        });


		    	function deleteRow(id){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/potogal/deletekateg/'?>"+id; 
				}
		    </script>
		    <style>
		    	table.my-custom tr td{
		    		vertical-align: top;
		    	}
		    </style>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Daftar Kategori Foto</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li class='active'>Daftar Kategori Foto</li>
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
														<span>Daftar Kategori Foto</span>
													</div>
													<div class="box-body box-body-nopadding">
														<div class="highlight-toolbar">
															<div class="pull-left"><div class="btn-toolbar">
																<div class="btn-group">
																	<a href="<?php echo site_url('backoffice/potogal/createkateg')?>" class="button button-basic" rel="tooltip" title="Tambah Foto"><i class="icon-plus"></i> Tambah Kategori</a>
																</div>
															</div></div>
														</div>
														<table class="table table-nomargin table-bordered dataTable table-striped table-hover my-custom">
															<thead>
																<tr>
																	<th width="20px">No.</th>
																	<th>Judul</th>
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
																	<td style="text-align: center;"><img style="width: 20px;" alt="Y" src="<?php if($row->STATUS == 'A')$img = "true.png";else $img ="false.png"; echo $this->config->item('ext_img').$img;?>" /></td>
																	<td>
																		<div class="btn-toolbar" style="margin: 0; padding: 0;">
																			<div class="btn-group">
																				<a href="<?php echo site_url('backoffice/potogal/editkateg/'.$row->ID)?>" class='button button-basic button-small' rel="tooltip" title="Ubah"><i class="icon-edit"></i></a>
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