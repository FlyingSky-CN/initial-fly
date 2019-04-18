<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="main">
<?php if (!empty($this->options->Breadcrumbs) && in_array('Postshow', $this->options->Breadcrumbs)): ?>
<div class="breadcrumbs">
<a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo; <?php $this->category(); ?> &raquo; <?php if (!empty($this->options->Breadcrumbs) && in_array('Text', $this->options->Breadcrumbs)): ?>正文<?php else: $this->title(); endif; ?>
</div>
<?php endif; ?>
<article class="post<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>">
<h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
<ul class="post-meta">
<li><?php $this->date(); ?></li>
<li><?php $this->category(','); ?></li>
<li><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('暂无评论', '%d 条评论'); ?></a></li>
<li><?php Postviews($this); ?></li>
</ul>
<div class="post-content">
<?php if ($this->options->TimeNotice): ?>
<?php 
$time=time() - $this->modified;
$lock=$this->options->TimeNoticeLock;
$lock=$lock*24*60*60;
if ($time>=$lock) {
?>
<script defer>
<?php if ($_GET['_pjax']) { ?>
notie('此文章最后修订于 <?php echo date('Y年m月d日' , $this->modified);?>，其中的信息可能已经有所发展或是发生改变。', {type:'warning', autoHide:true, timeout: 5000,width:200});
<?php } else { ?>
window.onload=function (){
    notie('此文章最后修订于 <?php echo date('Y年m月d日' , $this->modified);?>，其中的信息可能已经有所发展或是发生改变。', {type:'warning', autoHide:true, timeout: 5000,width:200});
}
<?php } ?>
</script>
<?php } ?>
<?php endif; ?>
<?php $this->content(); ?>
</div>
<?php
// linceses
$linceses = $this->fields->linceses;
if ($linceses && $linceses != 'NONE') {
    $linceseslist = array(
        'BY' => '署名 4.0 国际 (CC BY 4.0)',
        'BY-SA' => '署名-相同方式共享 4.0 国际 (CC BY-SA 4.0)',
        'BY-ND' => '署名-禁止演绎 4.0 国际 (CC BY-ND 4.0)',
        'BY-NC' => '署名-非商业性使用 4.0 国际 (CC BY-NC 4.0)',
        'BY-NC-SA' => '署名-非商业性使用-相同方式共享 4.0 国际 (CC BY-NC-SA 4.0)',
        'BY-NC-ND' => '署名-非商业性使用-禁止演绎 4.0 国际 (CC BY-NC-ND 4.0)');
    $lincesestext = $linceseslist[$linceses];
?>
<div class="copyright">本篇文章采用 <a rel="noopener" href="https://creativecommons.org/licenses/<?=strtolower($linceses)?>/4.0/deed.zh" target="_blank" class="external"><?=$lincesestext?></a> 许可协议进行许可。
</div>
<?php
} else {
?>
<div class="copyright">本篇文章未指定许可协议。
</div>
<?php }; ?>
</article>
<?php if ($this->options->WeChat || $this->options->Alipay): ?>
<p class="rewards">打赏: <?php if ($this->options->WeChat): ?>
<a><img src="<?php $this->options->WeChat(); ?>" alt="微信收款二维码" />微信</a><?php endif; if ($this->options->WeChat && $this->options->Alipay): ?>, <?php endif; if ($this->options->Alipay): ?>
<a><img src="<?php $this->options->Alipay(); ?>" alt="支付宝收款二维码" />支付宝</a><?php endif; ?>
</p>
<?php endif; ?>
<p class="tags" style="margin-bottom: 0px;">标签: <?php $this->tags(', ', true, 'none'); ?></p>
<?php $this->need('comments.php'); ?>
<ul class="post-near">
<li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
<li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
</ul>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>