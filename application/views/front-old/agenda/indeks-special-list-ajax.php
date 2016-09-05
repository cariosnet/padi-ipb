<ul class="list_style">
    <?php
    if($listData->num_rows == 0)echo '<li>Tidak ada data pada kriteria ini</li>';
    foreach ($listData->result() as $data){ ?>
        <li><a href="<?php echo site_url($type['url'].'/detail/'.$data->ID.'/'.$data->ALIAS)?>"><i class="fa fa-angle-right"></i> <?php echo $data->TITLE ?></a></li>
    <?php } ?>
</ul>

