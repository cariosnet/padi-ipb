<section class="content">
    <div class="container">
        <dl>
            <?php
            foreach ($contentData['budidaya']->result() as $budi) {
            ?>
            <dt><?php echo $budi->NEWS_TITLE?></dt>
            <dd>
                <?php echo $budi->NEWS_CONTENT?>
            </dd>
            <?php } ?>
            
        </dl>
    </div>
</section>