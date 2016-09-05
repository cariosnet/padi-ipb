<ul class="list_style">
    <?php
    if($dataList->num_rows == 0)echo '<li>Tidak ada data pada kriteria ini</li>';
    foreach ($dataList->result() as $data){
        echo '<li>';
        echo '<div class="title"><i class="fa fa-angle-right"></i> <a href="'.site_url('bank_data/detail/'.$data->ID.'/'.$data->ALIAS).'">'.$data->CAT_NAME.' NOMOR '.$data->NOMOR.' TAHUN '.$data->TAHUN.'</a></div>';
        echo '<div class="subtitle" ><a style="color: #000000; padding-left: 14px; font-size: 12px;" href="'.site_url('bank_data/detail/'.$data->ID.'/'.$data->ALIAS).'">'.$data->TITLE.'</a></div>';
        echo '<div class="subtitle"></div>';
        echo '</li>';
    }
    ?>
</ul>
