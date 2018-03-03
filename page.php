<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-9" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        
        <?php if ($this->fields->previewImage && $this->fields->previewImage!==""): ?>
            <a href="<?php $this->permalink() ?>"><div class="cover">
                <div class="cover-image" style="background-image:url(<?php $this->fields->previewImage(); ?>)"></div>
                <div class="title"><?php $this->title(); ?></div>
            </div></a>
            <?php else: ?>
            <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
            <?php endif; ?>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
