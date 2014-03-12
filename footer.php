  </div>
  <footer class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'embark_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'embark' ); ?>" rel="nofollow"><?php printf( __( 'Proudly powered by %s', 'embark' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'embark' ), '<a href="http://github.com/lawebdesign/embark">Embark</a>', '<a href="http://lawebdesign.com.au/" rel="nofollow">Luke Andersen</a>' ); ?>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
