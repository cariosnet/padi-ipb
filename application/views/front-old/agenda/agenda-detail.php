<div style="margin-top:150px;"></div>
<div id="full-pic">
    <div class="shadow-box">
        <a id="about"></a><h2 style="font-size:32px; font-weight:200;"><a href="javascript:void(0);"><?php echo $pages->TITLE;?></a></h2>
    </div>
</div>
<br>

<div class="container marketing">

    <div class="featurette">
        <img class="featurette-image pull-right" src="<?php echo $this->config->item('layout_v3') ?>images/artikel.png">
        <table>
            <tr>
                <td style="width: 80px;">Hari</td>
                <td>: <?php echo $this->bogcamp->getDayName($pages->DATE); ?></td>
            </tr>
            <tr>
                <td style="width: 80px;">Tanggal</td>
                <td>: <?php echo date('d', strtotime($pages->DATE)).' '.$this->bogcamp->getMonthName($pages->DATE).date(' Y', strtotime($pages->DATE)); ?></td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>: <?php echo date('H:i:s', strtotime($pages->DATE)); ?> WIB</td>
            </tr>
        </table>
        <p><?php echo $pages->DESC;?></p>
        <?php if($pages->FILE != ""){?>
            <div style="text-align: center; margin-bottom: 20px;">
                <a href="<?php echo $this->config->item('file_path').$pages->FILE ?>">Download Attachment</a>
            </div>
        <?php }?>
    </div>

</div>

<hr class="featurette-divider">