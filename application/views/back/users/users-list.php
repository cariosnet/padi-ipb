			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-adm").addClass('active open');
		    		$("#submenu-users-list").addClass('active');

		    		$('#newsTable').dataTable({
		    			oLanguage:{
			    			sSearch: "<span>Search:</span> ",
			    			sInfo: "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
			    			sLengthMenu: "<span>Show entries:</span> _MENU_",
			    			sLoadingRecords: "Please wait - loading...",
			    			sProcessing: "<div style='padding-top: 15px;'>Mohon Tunggu.. Sedang memproses data..</div>"
				    	},
		                bProcessing: true,
		                bServerSide: true,
		                sPaginationType: "full_numbers",
		                sAjaxSource: "<?php echo site_url('backoffice/users/ajax_users_listing') ?>",
		                aoColumns: [
		                    {bSortable: false, sClass: "center"},
		                    null,
		                    null,
		                    {bSortable: false },
		                    {bSortable: false },
		                    null,
		                    {bSortable: false },
		                    {bSortable: false }
		                ]
		            });
		        });

		    	function deleteRow(id){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/users/delete/'?>"+id;
				}
		    </script>
		    <style>
		    	table.my-custom tr td{
		    		vertical-align: top;
		    	}
		    </style>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Daftar Pengguna</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/users')?>">Administrasi</a><span class="divider">/</span></li>
						<li class='active'>Daftar Pengguna</li>
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
									<span>Daftar Pengguna</span>
								</div>
								<div class="box-body box-body-nopadding">
									<div class="highlight-toolbar">
										<div class="pull-left"><div class="btn-toolbar">
											<div class="btn-group">
												<a href="<?php echo site_url('backoffice/users/add')?>" class="button button-basic" rel="tooltip" title="Tambah Pengguna"><i class="icon-plus"></i> Tambah Pengguna</a>
											</div>
										</div></div>
									</div>
									<table class="table table-nomargin table-bordered table-striped table-hover my-custom" id="newsTable">
										<thead>
											<tr>
												<th width="20px">No.</th>
												<th>Nama Lengkap</th>
												<th width="150px">Username</th>
												<th width="150px">Email</th>
												<th width="100px">Telp.</th>
												<th width="80px">Role</th>
												<th width="30px">Status</th>
												<th width="70px">Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
			</div>