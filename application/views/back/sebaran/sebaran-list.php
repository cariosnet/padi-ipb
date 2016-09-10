			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-wilayah").addClass('active open');
		        });

		    	function deleteRow(id){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/sebaran/delete/'?>"+id;
				}
		    </script>
		    <style>
		    	table.my-custom tr td{
		    		vertical-align: top;
		    	}
		    </style>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Daftar Institution</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/sebaran')?>">Sebaran</a><span class="divider">/</span></li>
						<li class='active'>Daftar Sebaran</li>
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
                                    <span>Daftar Institution</span>
                                </div>
                                <div class="box-body box-body-nopadding">
                                    <div class="highlight-toolbar">
                                        <div class="pull-left"><div class="btn-toolbar">
                                            <div class="btn-group">
                                                <a href="<?php echo site_url('backoffice/sebaran/create')?>" class="button button-basic" rel="tooltip" title="Tambah Menu"><i class="icon-plus"></i> Tambah Institution</a>
                                            </div>
                                        </div></div>
                                    </div>
                                    <table class="table table-nomargin table-bordered dataTable table-striped table-hover my-custom">
                                        <thead>
                                            <tr>
                                                <th width="20px">No.</th>
                                                <th>Persebaran Wilayah</th>
                                                <th width="200px">Benih</th>
                                                <th width="20px">BS</th>
                                                <th width="20px">FS</th>
                                                <th width="20px">SS</th>
                                                <th width="20px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($listWilayah->result() as $row):
                                        ?>
                                            <tr style="text-align: center;">
                                                <td  style="text-align: center;"><?php echo $no++;?>.</td>
                                                <td ><b><?php echo $row->NAME?></b></td>
                                                <td style="text-align: center;">-</td>
                                                <td style="text-align: center;">-</td>
                                                <td style="text-align: center;">-</td>
                                                <td style="text-align: center;">-</td>
                                                <td>
                                                    -
                                                </td>
                                            </tr>

                                            <?php foreach ($this->X_Sebaran_Model->getListSebaranByWilayah($row->ID)->result() as $child):?>
                                            <tr style="text-align: center;">
                                                <td style="text-align: center;"><?php echo $no++;?>.</td>
                                                <td style="padding-left: 40px;"><?php echo $child->name?></td>
                                                <td style="text-align: center;"><?php echo $child->barang?></td>
                                                <td style="text-align: center;"><?php echo $child->bs?></td>
                                                <td style="text-align: center;"><?php echo $child->fs?></td>
                                                <td style="text-align: center;"><?php echo $child->ss?></td>
                                                <td>
                                                    <div class="btn-toolbar" style="margin: 0; padding: 0;">
                                                        <div class="btn-group">
                                                            <a href="<?php echo site_url('backoffice/sebaran/edit/'.$child->id)?>" class='button button-basic button-small' rel="tooltip" title="Ubah"><i class="icon-edit"></i></a>
                                                            <a href="javascript:void(0);" class='button button-basic button-small' rel="tooltip" title="Hapus" onclick="confirmPopUp('deleteRow(<?php echo $child->id?>)', 'Peringatan..', 'Anda yakin ingin dihapus ??', 'Ya', 'Tidak');"><i class="icon-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
			</div>