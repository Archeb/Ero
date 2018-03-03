<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-mb-12 col-3 kit-hidden-tb" id="secondary" role="complementary">
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title"><svg style="width:16px;height:16px" viewBox="0 0 24 24">
    <path fill="white" d="M20,4C21.11,4 22,4.89 22,6V18C22,19.11 21.11,20 20,20H4C2.89,20 2,19.11 2,18V6C2,4.89 2.89,4 4,4H20M8.5,15V9H7.25V12.5L4.75,9H3.5V15H4.75V11.5L7.3,15H8.5M13.5,10.26V9H9.5V15H13.5V13.75H11V12.64H13.5V11.38H11V10.26H13.5M20.5,14V9H19.25V13.5H18.13V10H16.88V13.5H15.75V9H14.5V14A1,1 0 0,0 15.5,15H19.5A1,1 0 0,0 20.5,14Z" />
</svg><span><?php _e('最新资源'); ?></span></h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Archive@myCustomCategory', 'type=category', 'mid=1')
            ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
        </ul>
    </section>
    <?php endif; ?>
    
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title"><svg style="width:16px;height:16px" viewBox="0 0 24 24">
    <path fill="white" d="M21.41,11.58L12.41,2.58C12.05,2.22 11.55,2 11,2H4A2,2 0 0,0 2,4V11C2,11.55 2.22,12.05 2.59,12.42L11.59,21.42C11.95,21.78 12.45,22 13,22C13.55,22 14.05,21.78 14.41,21.41L21.41,14.41C21.78,14.05 22,13.55 22,13C22,12.45 21.77,11.94 21.41,11.58M5.5,7A1.5,1.5 0 0,1 4,5.5A1.5,1.5 0 0,1 5.5,4A1.5,1.5 0 0,1 7,5.5A1.5,1.5 0 0,1 5.5,7M17.27,15.27L13,19.54L8.73,15.27C8.28,14.81 8,14.19 8,13.5A2.5,2.5 0 0,1 10.5,11C11.19,11 11.82,11.28 12.27,11.74L13,12.46L13.73,11.73C14.18,11.28 14.81,11 15.5,11A2.5,2.5 0 0,1 18,13.5C18,14.19 17.72,14.82 17.27,15.27Z" />
</svg><span><?php _e('分类'); ?></span></h3>
        <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
	</section>
    <?php endif; ?>
    
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title"><svg style="width:16px;height:16px" viewBox="0 0 24 24">
    <path fill="white" d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7A2,2 0 0,1 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.89 12.76,23 12.5,23H12M13,17V20.08L16.08,17H21V7H7V17H13M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15M9,9H19V11H9V9M9,13H17V15H9V13Z" />
</svg><span><?php _e('最近回复'); ?></span></h3>
        <ul class="widget-list">
        <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
        <?php while($comments->next()): ?>
            <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
        <?php endwhile; ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title"><svg style="width:16px;height:16px" viewBox="0 0 24 24">
    <path fill="white" d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" />
</svg><span><?php _e('归档'); ?></span></h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
            ->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
        </ul>
	</section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
	<section class="widget">
		<h3 class="widget-title"><svg style="width:16px;height:16px" viewBox="0 0 24 24">
    <path fill="white" d="M16.23,18L12,15.45L7.77,18L8.89,13.19L5.16,9.96L10.08,9.54L12,5L13.92,9.53L18.84,9.95L15.11,13.18L16.23,18M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
</svg><span><?php _e('其它'); ?></span></h3>
        <ul class="widget-list">
            <?php if($this->user->hasLogin()): ?>
				<li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                <li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
            <?php else: ?>
                <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
            <?php endif; ?>
            <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
            <li><a href="http://9bie.org">⑨BIE</a></li>
            <li><a href="https://qwq.moe">Archeb</a></li>
        </ul>
	</section>
    <?php endif; ?>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowApply', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title"><svg style="width:16px;height:16px" viewBox="0 0 24 24">
    <path fill="white" d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" />
</svg><span><?php _e('应用'); ?></span></h3>
        <ul class="widget-list">
<br>
            <?php $this->widget('Widget_Archive@myCustomCategory', 'type=category', 'mid=3')->to($categoryPosts);?>
            <?php  while($categoryPosts->next()):?>
                    <?php if ($categoryPosts->fields->applyicon && $categoryPosts->fields->applyicon!=="" && $categoryPosts->fields->applyname && $categoryPosts->fields->applyicon!=="" ): ?>
                        <li><div class="row appcenterf">
                        <div class="col-3 appcenter">
                            <img src='<?php $categoryPosts->fields->applyicon(); ?>' width="100%" height="100%"/>
                        </div>
                        <div class="col-6 appstylebody appcenter">
                            <?php $categoryPosts->fields->applyname(); ?>
                        </div>
                        <div class="col-3 appcenter"><a href="<?php $categoryPosts->permalink();?>">详情</a></div></div></li><br>
                        <?php else: ?>
                    <?php endif; ?>
            <?php endwhile;?>
        </ul>
	</section>
    <?php endif; ?>

</div><!-- end #sidebar -->
