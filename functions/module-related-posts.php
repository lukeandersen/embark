<!-- Related Posts -->
<div class="related-posts">
	<h3 class="pink">You may also enjoy:</h3>
	<?
		$backup = $post;
		$tags = wp_get_post_tags($post->ID);
		$tagIDs = array();
		if ($tags) {
		$tagcount = count($tags);
		for ($i = 0; $i < $tagcount; $i++) {$tagIDs[$i] = $tags[$i]->term_id;}
		$args=array( 'tag__in' => $tagIDs,'post__not_in' => array($post->ID), 'showposts'=>3, 'caller_get_posts'=>1);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() )
			{
				while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<a href="<?php the_permalink() ?>" class="related-item" rel="bookmark" title="<?php the_title(); ?>">
		        	<span class="related-inner">
			        	<?php the_post_thumbnail('medium'); ?>
			        	<span class="related-inner">
			        		<span class="related-title"><?php the_title(); ?></span>
			        		<span class="related-link">Click Here</span>
			        	</span>
		        	</span>
		        </a>
				<?   endwhile;
				}
			}
		else { ?>
		<h4>No related posts found!</h4>
		<?php }

		$post = $backup;
		wp_reset_query();
	?>
</div>