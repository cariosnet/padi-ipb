<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/photo-gallery.js"></script>

<style>
    ul {
        padding:0 0 0 0;
        margin:0 0 0 0;
    }
    ul li {
        list-style:none;
        margin-bottom:25px;
    }
    ul li img {
        cursor: pointer;
    }
    .modal-body {
        padding:5px !important;
    }
    .modal-content {
        border-radius:0;
    }
    .modal-dialog img {
        text-align:center;
        margin:0 auto;
    }
    .controls{
        width:50px;
        display:block;
        font-size:11px;
        padding-top:8px;
        font-weight:bold;
    }
    .next {
        float:right;
        text-align:right;
    }
    /*override modal for demo only*/
    .modal-dialog {
        max-width:500px;
        padding-top: 90px;
    }
    @media screen and (min-width: 768px){
        .modal-dialog {
            width:500px;
            padding-top: 90px;
        }
    }
    @media screen and (max-width:1500px){
        #ads {
            display:none;
        }
    }
</style>

<div style="margin-top:150px;"></div>
<br>

<div class="container marketing">
    <ul class="row">
        <?php foreach ($list_poto as $keylist => $vallist)
        { ?>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="<?php echo $this->config->item('img_path');?>potogal/<?php echo $vallist['EMBED'];?>" title="<?php echo $vallist['TITLE'];?>">
            </li>
        <?php } ?>
    </ul>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Album</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listkat as $keycat => $valcat){ ?>
        <tr>
            <td><a href="<?php echo base_url().'foto/nextkat/'.$keycat ?>"><?php echo $valcat['TITLE_KAT'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<hr class="featurette-divider">