<div style="margin-top:150px;"></div>
<div id="full-pic">
    <div class="shadow-box">
        <a id="about"></a><h2 style="font-size:32px; font-weight:200;"><a href="javascript:void(0);"><?php echo $pages->TITLE;?></a></h2>
    </div>
</div>
<br>

<div class="container marketing">

    <div class="featurette">
        <a href="<?php echo $this->config->item('file_path').$pages->FILE ?>"><img style="width: 100px;" class="featurette-image pull-right" src="<?php echo base_url()."media/images/download.jpg"?>"></a>

        <p><?php echo $pages->DESC;?></p>

        <div>
            <iframe src="http://docs.google.com/gview?url=<?php echo $this->config->item('file_path').$pages->FILE;?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
        </div>
    </div>

</div>

<hr class="featurette-divider">