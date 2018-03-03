<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-9" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="post-side-info">
                <div class="avatar">
                    <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author->gravatar(64);?></a>
                </div>
                <div class="panel">
                    <div class="author-name item"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></div>
                    <div class="time item"><?php echo time2Units(time() - $this->created) ?>前</div>
                    <a class="comments item" itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><svg style="width:15px;height:15px" viewBox="0 0 24 24">
    <path fill="#000000" d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7C5,5.89 5.9,5 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.9 12.75,23 12.5,23V23H12M13,17V20.08L16.08,17H21V7H7V17H13M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15Z" />
</svg><span>&nbsp;<?php $this->commentsNum(_t('暂无评论'), _t('一条评论'), _t('%d 条评论')); ?></span></a>
                </div>
            </div>
        <?php if ($this->fields->previewImage && $this->fields->previewImage!==""): ?>
            <a href="<?php $this->permalink() ?>"><div class="cover">
                <div class="cover-image" style="background-image:url(<?php $this->fields->previewImage(); ?>)"></div>
                <div class="title"><?php $this->title(); ?></div>
            </div></a>
            <?php else: ?>
            <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
            <?php endif; ?>
        <ul class="post-meta">
            <li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
            <li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
            <li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
        </ul>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <p itemprop="keywords" class="tags"><?php _e('标签: '); ?><?php $this->tags(', ', true, 'none'); ?></p>
    </article>

    <?php $this->need('comments.php'); ?>

    <ul class="post-near">
        <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
        <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
    </ul>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
