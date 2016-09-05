<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $pageTitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?php echo $this->config->item('layout_v3') ?>images/logo.png" type="image/x-icon" />
    <?php
        if(isset($meta_desc))echo "<meta name='description' content='".quotes_to_entities($meta_desc)."' />";else echo "<meta name='description' content='".quotes_to_entities($this->bogcamp->getSetting(3))."' />";
        if(isset($meta_key))echo "<meta name='keywords' content='".$meta_key."' />";else echo "<meta name='keywords' content='".$this->bogcamp->getSetting(4)."' />";
    ?>

    <!-- Facebook SDK, Open Graph Configurations -->
    <?php
        $fb_admins = array();
        $fb_admins = explode(",", $this->bogcamp->getSetting(8));

        for($i = 0; $i < count($fb_admins); $i++){
            echo '<meta property="fb:admins" content="'.$fb_admins[$i].'" />';
        }
        unset($i)
    ?>
    <meta property="fb:app_id" content="<?php echo $this->bogcamp->getSetting(7);?>" />

    <meta property="og:type"   content="article" />
    <meta property="og:url"    content="<?php echo $this->bogcamp->getFullUrlRequest();?>" />
    <meta property="og:title"  content="<?php echo $pageTitle?>" />
    <?php
    if(isset($meta_desc))echo "<meta property='og:description' content='".quotes_to_entities($meta_desc)."' />";else echo "<meta property='og:description' content='".quotes_to_entities($this->bogcamp->getSetting(3))."' />";
    if(isset($og_image))echo "<meta property='og:image' content='".$og_image."' />";else echo "<meta property='og:image' content='".$this->config->item('ext_img')."icon/200x200.png' />";
    ?>

    <meta name="alexaVerifyID" content="l1Tx8_LUvMgaxSyJNJ3Q6OHpkyY" />

    <!-- Le styles -->
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>css/style.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>js/html5shiv.js">
    <![endif]-->

    <link href="<?php echo $this->config->item('layout_korpri');?>css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:700,700italic,800,300,300italic,400italic,400,600,600italic' rel='stylesheet' type='text/css'>
    <!--Custom-Theme-files-->
    <link href="<?php echo $this->config->item('layout_korpri');?>css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_korpri');?>css/lightbox.css" type="text/css" media="all" />
    <script src="<?php echo $this->config->item('layout_korpri');?>js/modernizr.custom.js"></script>

    <script src="<?php echo $this->config->item('layout_korpri');?>js/jquery.min.js"> </script>
    <!--/script-->
    <script type="text/javascript" src="<?php echo $this->config->item('layout_korpri');?>js/move-top.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item('layout_korpri');?>js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
            });
        });
    </script>

    <!-- Fav and touch icons -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url() ?>" style="width: 450px;">
                <img src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif" width="60px" height="50px" style="float:left; padding-right:10px;">
                Sekretariat Dewan Pengurus KORPRI Provinsi DKI Jakarta
            </a>
        </div>
        <div id="navbar" class="navbar-collapse page-scroll collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo ($this->uri->segment(1) == '') ? 'active' : '' ?>">
                    <a class="page-scroll" href="<?php echo ($this->uri->segment(1) != '') ? site_url() : '#page-top' ?>">Beranda<br>
                        <div style="font-size:9px; margin-top:-5px;">utama</div>
                    </a>
                </li>
                <?php foreach($this->X_Pages_Model->getListNavigation(null) as $row){ ?>
                    <?php if($row['child_count'] > 0){ ?>

                        <li id="<?php echo $row['ALIAS'] ?>" class="dropdown <?php echo ($this->uri->segment(1) == 'pages')?>">
                            <?php if($row['TYPE'] == 1){?>
                                <a href='<?php echo site_url('pages/'.$row['ALIAS'])?>' <?php echo ($row['child_count'] > 0) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '' ?>>
                                    Tentang
                                    <br><div style="font-size:9px; margin-top:-5px; padding-bottom:5px;"><?php echo $row['TITLE'];?></div>
                                </a>
                            <?php }else{?>
                                <a href='<?php echo base_url($row['REF_URL']);?>' <?php echo ($row['child_count'] > 0) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '' ?>>
                                    
                                    <div><?php echo $row['TITLE'];?></div>
                                </a>
                            <?php }?>

                            <?php if($row['child_count'] > 0){?>
                                <ul class="dropdown-menu">
                                    <?php foreach($row['child']->result() as $ch){ ?>
                                        <li>
                                            <?php if($ch->TYPE == 1){?>
                                                <a href='<?php echo site_url('pages/'.$ch->ALIAS)?>'><?php echo $ch->TITLE;?></a>
                                            <?php }else{?>
                                                <a href='<?php echo base_url($ch->REF_URL);?>'><?php echo $ch->TITLE;?></a>
                                            <?php }?>
                                        </li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                        </li>
                    <?php } }?>
                <li><a class="page-scroll" href="<?php echo site_url('news/news_list'); ?>">Berita<br><div style="font-size:9px; margin-top:-5px; padding-bottom:5px;">Utama</div></a></li>
                <li><a class="page-scroll" href="<?php echo site_url('foto'); ?>">Galeri<br><div style="font-size:9px; margin-top:-5px;">foto</div></a></li>
            
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="col-md-3 top-nav">
    <!--<div class="logo">
        <a href="index.html"> <h4 style="color: #fff">Kategori Artikel</h4></a>
    </div>-->
    <div class="top-menu">
        <span class="menu"> </span>

        <ul class="cl-effect-16">
            <?php foreach($this->X_News_Category_Model->getListCatTypeAll(1)->result() as $keycat => $cats) {?>
                <li><a href="<?php echo site_url('berita/'.$cats->CAT_ALIAS); ?>" data-hover="<?php echo $cats->CAT_NAME; ?>"><?php echo $cats->CAT_NAME; ?></a></li>



            <?php } ?>
        </ul>
        <!-- script-for-nav -->
        <script>
            $( "span.menu" ).click(function() {
                $( ".top-menu ul" ).slideToggle(300, function() {
                    // Animation complete.
                });
            });
        </script>
        <!-- script-for-nav -->
        <ul class="side-icons">
            <li><a class="fb" href="#"></a></li>
            <li><a class="twitt" href="#"></a></li>
            <li><a class="goog" href="#"></a></li>
            <li><a class="drib" href="#"></a></li>
        </ul>
    </div>
</div>

<?php echo $this->load->view($content, $contentData);?>
<?php
//echo "aaaa" ;print $this->uri->segment(1);  exit;
if ($this->uri->segment(1) != 'foto') { ?>
<div class="banner-right-text">
    <h3 class="tittle">Selayang Pandang Gubernur</h3>
    <!--/general-news-->
    <div class="general-news">
        <div class="general-inner">
            <div class="general-text">
                <a href="single.html"><img src="<?php echo $this->config->item('img_path')?>images/gub.jpg" class="img-responsive" alt=""></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>On Jun 25 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>56 </a><a class="span_link" href="single.html"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
            </div>
            <h3 class="tittle media">Bidang Terkait</h3>
            <div class="edit-pics">
                <div class="editor-pics">
                    <div class="col-md-3 item-pic">
                        <img src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif" class="img-responsive" alt="">
                    </div>
                    <div class="col-md-9 item-details">
                        <h5 class="inner two"><a href="<?php echo base_url() ?>news/read/198/bidang-kerjasama.html">Bidang Hukum</a></h5>
                        <!-- <div class="td-post-date two"><i class="glyphicon glyphicon-time"></i>Feb 22, 2015 <a href="#"><i class="glyphicon glyphicon-comment"></i>0 </a></div>-->
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="editor-pics">
                    <div class="col-md-3 item-pic">
                        <img src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif" class="img-responsive" alt="">

                    </div>
                    <div class="col-md-9 item-details">
                        <h5 class="inner two"><a href="<?php echo base_url() ?>news/read/198/bidang-kerjasama.html"">Bidang Kerjasama</a></h5>
                        <!--<div class="td-post-date two"><i class="glyphicon glyphicon-time"></i>Feb 22, 2015 <a href="#"><i class="glyphicon glyphicon-comment"></i>0 </a></div>-->
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="editor-pics">
                    <div class="col-md-3 item-pic">
                        <img src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif" class="img-responsive" alt="">

                    </div>
                    <div class="col-md-9 item-details">
                        <h5 class="inner two"><a href="<?php echo base_url() ?>news/read/199/bidang-mental-dan-rohani.html">Bidang Mental dan Rohani</a></h5>
                        <!--<div class="td-post-date two"><i class="glyphicon glyphicon-time"></i>Feb 22, 2015 <a href="#"><i class="glyphicon glyphicon-comment"></i>0 </a></div>-->
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="editor-pics">
                    <div class="col-md-3 item-pic">
                        <img src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif" class="img-responsive" alt="">

                    </div>
                    <div class="col-md-9 item-details">
                        <h5 class="inner two"><a href="<?php echo base_url() ?>news/read/200/bidang-sosial-dan-wirausaha.html">Bidang Sosial dan Wirausaha</a></h5>
                        <!--<div class="td-post-date two"><i class="glyphicon glyphicon-time"></i>Feb 22, 2015 <a href="#"><i class="glyphicon glyphicon-comment"></i>0 </a></div>-->
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
    <!--//general-news-->
    <!--/news-->
    <!--/news-->
</div>
<div class="clearfix"> </div>
<?php } ?>

<a href="#0" class="cd-top">Back to Top</a>

<!--footer-->
<div class="footer">
    <div class="footer-top">
        <div class="col-md-4 footer-grid">
            <h4>Website SKPD</h4>
            <ul class="bottom">
                <?php foreach($this->link_model->getAll()->result() as $link){?>
                    <a href='<?php echo $link->ref_url;?>'>
                        <li><?php echo $link->nama;?></li>
                    </a>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-4 footer-grid">
            <h4>Kontak Kami</h4>
            <ul class="bottom">
                <li><i class="glyphicon glyphicon-home"></i>Telepon / Fax: (021) 34830445 </li>
                <li><i class="glyphicon glyphicon-envelope"></i><a href="mailto:info@example.com">korpri@jakarta.go.id</a></li>
            </ul>
        </div>
        <div class="col-md-4 footer-grid">
            <h4>Address Location</h4>
            <ul class="bottom">
                <li><i class="glyphicon glyphicon-map-marker"></i>Jl. Kebon Sirih No. 18 Blok H Lantai 19<br>
                    Jakarta, Indonesia.</li>
                <!-- <li><i class="glyphicon glyphicon-earphone"></i>Telepon / Fax: (021) 34830445 </li> -->
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<div class="copy">
    <p>&copy; 2016 Sekretariat KORPRI DKI Jakarta </p>
</div>
<div class="clearfix"> </div>
</div>
<div class="clearfix"> </div>
</div>

<!--------Contact-------->

<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-dropdown.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>


</body></html>