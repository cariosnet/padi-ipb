<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo $this->config->item('layout_front') ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('layout_front') ?>css/full-width-pics.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo base_url('home')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo base_url('home/budidaya')?>">Budidaya</a>
                </li>
                <li>
                    <a href="<?php echo base_url('home/news')?>">News</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stok</a>
                    <ul class="dropdown-menu">
                        <li data-toggle="modal" data-target="#myModal"><a href="#">Stok Bulanan</a></li>
                        <li data-toggle="modal" data-target="#myModal"><a href="#">Stok Per UK/UPT</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Varietas</a>
                    <ul class="dropdown-menu">
                        <li data-toggle="modal" data-target="#myModal"><a href="#">Daftar Varietas</a></li>
                        <li data-toggle="modal" data-target="#myModal"><a href="#">Rekap Varietas</a></li>
                    </ul>
                </li>
                <li data-toggle="modal" data-target="#myModal">
                    <a href="#" role="button" aria-haspopup="true" aria-expanded="false">Peluang Bisnis</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Peta Sebaran</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('home/upbs')?>">UPBS</a></li>
                        <li data-toggle="modal" data-target="#myModal"><a href="#">Hortikultura</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">UPBS Unit Lain</a>
                    <ul class="dropdown-menu">
                        <li data-toggle="modal" data-target="#myModal"><a href="#">UPBS BB Padi</a></li>
                        <li data-toggle="modal" data-target="#myModal"><a href="#">UPBS Balitkabi</a></li>
                        <li data-toggle="modal" data-target="#myModal"><a href="#">UPBS Balit Sereal</a></li>
                        <li data-toggle="modal" data-target="#myModal"><a href="#">UPBS Puslitbanghorti</a></li>
                    </ul>
                </li>
                <li data-toggle="modal" data-target="#myModal">
                    <a href="#">Kalender Tanam</a>
                </li>
                <li>
                    <a href="<?php echo base_url('home/penangkaran')?>">Penangkaran</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Oops.. Maaf :(</h4>
            </div>
            <div class="modal-body">
                Fitur ini sedang dalam proses pembangunan
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--button type="button" class="btn btn-success">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<header class="image-bg-fluid-height<?php if($this->uri->segment(2)==null) echo '-home';?>">
    <img class="img-responsive img-center" src="<?php echo $this->config->item('layout_front') ?>img/logo.png" alt="logo">
    <?php if($this->uri->segment(2)==null) { ?>
        <p class="banner-text">Sistem Informasi IPB 3S</p>
    <?php }?>
</header>

<?php echo $this->load->view($content, $contentData);?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="footer-link text-center">
                    <a href="#">Home</a> |
                    <a href="#">Produksi</a> |
                    <a href="#">Distribusi</a> |
                    <a href="#">Stok</a> |
                    <a href="#">Varietas</a> |
                    <a href="#">Rekapitulasi</a> |
                    <a href="#">Daftar UK/UPT</a> |
                    <a href="<?php echo base_url('home/upbs')?>">Peta Sebaran</a>
                </p>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <p class="text-center">Copyright &copy; Your Website</p>
    </div>
</footer>
<script src="<?php echo $this->config->item('layout_front') ?>js/jquery.js"></script>
<script src="<?php echo $this->config->item('layout_front') ?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('layout_front') ?>js/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $("#image-slider").owlCarousel({
            navigation: true,
            slideSpeed: 400,
            paginationSpeed: 400,
            items: 3,
            itemsTablet: [768, 2],
            itemsMobile: [479, 1]
        });

    });
</script>
</body>

</html>



