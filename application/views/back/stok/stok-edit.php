<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#menu-stok").addClass('active open');
        $("#selectType").change(function(){
            if($(this).val() == 1){
                $(".linkInput").hide();
                $(".artikelInput").show();
            }else{
                $(".linkInput").show();
                $(".artikelInput").hide();
            }
        });
    });

    function cancel(){
        jQuery.facebox.close();
        window.location = "<?php echo base_url().'backoffice/stok'?>";
    }

    function setAlias(obj){
        var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
        $("#alias").val(text);
    }
</script>

<div class="page-header">
    <div class="pull-left">
        <h4><i class="icon-home"></i>Stok Baru</h4>
    </div>
    <div class="pull-right">
        <ul class="bread">
            <li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
            <li><a href="<?php echo site_url('backoffice/stok')?>">stok</a><span class="divider">/</span></li>
            <li class='active'>Tambah Sebaran</li>
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

    <form enctype="multipart/form-data" action="<?php echo site_url('backoffice/stok/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-edit"></i>
                        <span>Form Institusi Baru</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <div class="control-group">
                            <label for="textfield" class="control-label">Lembaga</label>
                            <div class="controls">
                                <input type="hidden" name="id" data-rule-required="true" value="<?php echo $stok->ID;?>" class="input-xlarge span6">
                                <select name="lembaga" class='chosen-select input-block-level'>
                                    <option value="-1">-- Pilih Lembaga --</option>
                                    <?php foreach ($lembaga->result() as $parent):?>
                                        <option <?php if($parent->ID == $stok->ID_INSTITUTION) echo 'selected';?> value="<?php echo $parent->ID?>"><?php echo $parent->INSTITUTION_NAME. " ". $parent->REGION?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Benih</label>
                            <div class="controls">
                                <select name="benih" class='chosen-select input-block-level'>
                                    <option value="-1">-- Pilih Benih --</option>
                                    <?php foreach ($benih->result() as $parent):?>
                                        <option <?php if($parent->ID == $stok->ID_BENIH) echo 'selected';?> value="<?php echo $parent->ID?>"><?php echo $parent->NAMA_BENIH?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Tanggal</label>
                            <div class="controls">
                                <input type="text" name="date" id="textfield" class="input-xlarge datepick"  value="<?php echo date("d-m-Y",strtotime($stok->DATE));?>" data-date-format="dd-mm-yyyy">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Jumlah Stok</label>
                            <div class="controls">
                                <input type="number" value="<?php echo $stok->JUMLAH;?>" name="jumlah" data-rule-required="true" class="input-xlarge span6">
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


