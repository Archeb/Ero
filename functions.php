<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $announcement = new Typecho_Widget_Helper_Form_Element_Text('announcement', NULL, NULL, _t('公告'), _t('在这里填入首页显示的公告'));
    $form->addInput($announcement);
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项'),
    'ShowApply' => _t('显示应用')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther','ShowApply'), _t('侧边栏显示'));
    
    $form->addInput($sidebarBlock->multiMode());
}


function themeFields($layout) {
    ?>
    <style>
    #custom-field input{
        width:100%;
    }
    </style>
    <?php
    $previewImage = new Typecho_Widget_Helper_Form_Element_Text('previewImage', NULL, NULL, "文章封面图", "在此填入一个图片地址以显示文章封面图，留空不显示");
    $layout->addItem($previewImage);
    //⑨BIE的魔改
    $applyicon = new Typecho_Widget_Helper_Form_Element_Text('applyicon', NULL, NULL, "应用图标", "在此填入一个图片地址以在第二栏显示。");
    $layout->addItem($applyicon);
    $applyname = new Typecho_Widget_Helper_Form_Element_Text('applyname', NULL, NULL, "应用标题", "在此填入一串文本地址以在第二栏显示显示应用的名称。");
    $layout->addItem($applyname);
    //魔改结束
    if($_SERVER['SCRIPT_NAME']=="/admin/write-page.php"){
        $icon = new Typecho_Widget_Helper_Form_Element_Text('icon', NULL, NULL, "图标", "在此填入MDI图标类名，将会显示在导航栏中。<a href=\"https://cdn.materialdesignicons.com/2.0.46/\">类名参考</a>");
    $layout->addItem($icon);
    }
}


function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
 
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div class="a-comment">
        <div class="comment-element" id="<?php $comments->theId(); ?>">
            <div class="comment-container">
                <div class="comment-author-avatar">
                    <a target="_blank" href="<?php echo $comments->url; ?>"><?php $comments->gravatar('55', ''); ?></a>
                </div>
                <div class="comment-author-info">
                    <div class="comment-meta">
                        <span class="comment-author-name"><?php echo $comments->author(); ?></span>
                        <a class="comment-time"><?php echo $comments->date('Y-m-d H:i'); ?></a>
                    </div>
                    <div class="comment-content">
                        <?php $comments->content(); ?>
                    </div>
                </div>
            </div>
        </div>
        <a class="comment-reply" onclick="TypechoComment.reply('<?php $comments->theId(); ?>', <?php echo explode("-",$comments->theId)[1]; ?>);"><svg style="width:50px;height:22px" viewBox="0 0 24 24">
    <path fill="#666" d="M10,9V5L3,12L10,19V14.9C15,14.9 18.5,16.5 21,20C20,15 17,10 10,9Z" />
</svg></a> 
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php }

function time2Units($time) 
{ 
   $year   = floor($time / 60 / 60 / 24 / 365); 
   $time  -= $year * 60 * 60 * 24 * 365; 
   $month  = floor($time / 60 / 60 / 24 / 30); 
   $time  -= $month * 60 * 60 * 24 * 30; 
   $week   = floor($time / 60 / 60 / 24 / 7); 
   $time  -= $week * 60 * 60 * 24 * 7; 
   $day    = floor($time / 60 / 60 / 24); 
   $time  -= $day * 60 * 60 * 24; 
   $hour   = floor($time / 60 / 60); 
   $time  -= $hour * 60 * 60; 
   $minute = floor($time / 60); 
   $time  -= $minute * 60; 
   $second = $time; 
   $elapse = ''; 
   $unitArr = array('年'  =>'year', '个月'=>'month',  '周'=>'week', '天'=>'day', 
                    '小时'=>'hour', '分钟'=>'minute', '秒'=>'second' 
                    ); 
   foreach ( $unitArr as $cn => $u ) 
   { 
       if ( $$u > 0 ) 
       { 
           $elapse = $$u . $cn; 
           break; 
       } 
   } 
   return $elapse; 
}