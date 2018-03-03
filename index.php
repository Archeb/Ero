<?php
/**
 * Ero 是一套基于 Typecho 默认皮肤修改的萌系双栏主题
 * 
 * @package Ero
 * @author Archeb
 * @version 1.1
 * @link https://qwq.moe
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<?php if ($this->options->announcement): ?>
<div class="announcement"><svg style="width:22px;height:22px" viewBox="0 0 24 24">
    <path fill="#fff" d="M10,4A4,4 0 0,1 14,8A4,4 0 0,1 10,12A4,4 0 0,1 6,8A4,4 0 0,1 10,4M10,14C14.42,14 18,15.79 18,18V20H2V18C2,15.79 5.58,14 10,14M20,12V7H22V12H20M20,16V14H22V16H20Z" />
</svg><span>&nbsp;&nbsp;<?php $this->options->announcement() ?></span></div>
<?php endif; ?>
<div class="col-mb-12 col-9" id="main" role="main">
	<?php while($this->next()): ?>
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
            <h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
            <?php endif; ?>
			
			<ul class="post-meta">
				<li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
				<li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
				<li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
				<li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a></li>
			</ul>
            <div class="post-content" itemprop="articleBody">
    			<?php $this->content('- 阅读剩余部分 -'); ?>
            </div>
        </article>
	<?php endwhile; ?>

    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
