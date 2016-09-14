<section class="content">
    <article class="article">
        <div class="article-header">
            <div class="category">Category</div>
            <h1 class="headline">
                <?php echo $news[0]->NEWS_TITLE;?>
            </h1>
            <div class="meta">
                <span class="author">by <span class="author-name"><?php echo $news[0]->WRITER;?></span></span>
                <span class="pub-date">Posted <?php echo $news[0]->CREATED_DATE;?></span>
            </div>
        </div>
        <?php echo $news[0]->NEWS_CONTENT;?>
    </article>
</section>