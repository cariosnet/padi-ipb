<div class="col-md-9 main">
<div class="gallery-section">
    <h3 class="tittle">Gallery <i class="glyphicon glyphicon-fullscreen"></i></h3>
    <div class="categorie-grids cs-style-1">
        <?php foreach ($list_poto as $potokey => $poto) { ?>
            <div class="col-md-4 cate-grid grid">
                <figure>
                    <?php if ( $poto['EMBED'] != "") {?>
                    <img src="<?php echo $this->config->item('img_path');?>potogal/<?php echo
$poto['EMBED']; ?>" alt="">
                    <?php }else{ ?>
                    <img src="<?php echo $poto['HTML']; ?>" alt="">
                    <?php } ?>
                    <figcaption>
                        <h3><?php echo $poto['TITLE']; ?></h3>
                        <span>Album : <?php echo $poto['TITLE_KAT'] ?> </span>
                        <?php if ( $poto['EMBED'] != "") {?>
                        <a class="example-image-link" href="<?php echo $this->config->item('img_path');?>potogal/<?php echo $poto['EMBED']; ?>" data-lightbox="example-1" data-title="<?php echo $poto['TITLE'] ?>">VIEW</a>
                        <?php }else{ ?>
                            <a class="example-image-link" href="<?php echo $poto['HTML']; ?>" data-lightbox="example-1" data-title="<?php echo $poto['TITLE'] ?>">VIEW</a>
                        <?php } ?>
                    </figcaption>
                </figure>
            </div>
        <?php } ?>

        <script src="<?php echo $this->config->item('layout_korpri');?>js/lightbox.js"></script>
        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"> </div>