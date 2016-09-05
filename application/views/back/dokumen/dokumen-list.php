			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-dokumen").addClass('active open');
		    		$("#submenu-dokumen").addClass('active');
		        });

		    	function deleteRow(id){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/dokumen/delete/'?>"+id; 
				}
		    </script>
		    <style>
		    	table.my-custom tr td{
		    		vertical-align: top;
		    	}
		    </style>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Daftar Dokumen</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/dokumen')?>">Dokumen</a><span class="divider">/</span></li>
						<li class='active'>Daftar Dokumen</li>
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
														<span>Daftar Dokumen</span>
													</div>
													<div class="box-body box-body-nopadding">
														<div class="highlight-toolbar">
															<div class="pull-left"><div class="btn-toolbar">
																<div class="btn-group">
																	<a href="<?php echo site_url('backoffice/dokumen/create')?>" class="button button-basic" rel="tooltip" title="Tambah Dokumen"><i class="icon-plus"></i> Tambah Dokumen</a>
																</div>
															</div></div>
														</div>
														<table class="table table-nomargin table-bordered dataTable table-striped table-hover my-custom">
															<thead>
																<tr>
																	<th width="20px">No.</th>
																	<th>Judul</th>
																	<th width="70px">File</th>
																	<th width="150px">Tanggal</th>
																	<th width="20px">Status</th>
																	<th width="20px">View</th>
																	<th width="20px">Aksi</th>
																</tr>
															</thead>
															<tbody>
															<?php 
															$no = 1;
															foreach ($listData->result() as $row):
															?>
																<tr style="text-align: center;">
																	<td style="text-align: center;"><?php echo $no++;?>.</td>
																	<td><a target="_blank" href="<?php echo site_url('dokumen/detail/'.$row->ID.'/'.$row->ALIAS)?>"><?php echo $row->TITLE?></a></td>
																	<td><a target="_blank" href="<?php echo $this->config->item('file_path').$row->FILE?>">Download</a></td>
																	<td><?php echo date('d M Y H:i:s', strtotime($row->CREATED_DATE))?> WIB</td>
																	<td style="text-align: center;"><img style="width: 20px;" alt="Y" src="<?php if($row->STATUS == 'A')$img = "true.png";else $img ="false.png"; echo $this->config->item('ext_img').$img;?>" /></td>
																	<td style="text-align: center;"><?php echo $row->PAGE_VIEW?></td>
																	<td>
																		<div class="btn-toolbar" style="margin: 0; padding: 0;">
																			<div class="btn-group">
																				<a href="<?php echo site_url('backoffice/dokumen/edit/'.$row->ID)?>" class='button button-basic button-small' rel="tooltip" title="Ubah"><i class="icon-edit"></i></a>
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