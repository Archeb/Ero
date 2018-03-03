<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.</p>
    <p>主题 <a href="https://ero.ink">Ero</a> 由 <a href="https://qwq.moe/">Archeb</a> 基于Typecho默认主题修改而成</p>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>
