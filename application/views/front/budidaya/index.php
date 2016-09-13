<section class="content">
    <div class="container">
        <dl>
            <?php
            foreach ($contentData['budidaya']->result() as $budi) {
            ?>
            <dt><?php echo $budi->NEWS_TITLE?></dt>
            <dd>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam incidunt itaque mollitia eligendi, doloribus commodi a culpa ratione aspernatur!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae rerum molestiae laboriosam nobis odit.</p>
            </dd>
            <?php } ?>
            
        </dl>
    </div>
</section>