<div class="flickr-feed">
	<ul>
		<?php 
			
			// Get all image attachments
			// $args = array(
			//     'post_type' => 'attachment',
			//     'numberposts' => null,
			//     'post_status' => null,
			//     'posts_per_page' => 30,
			//     'post_parent' => null, // $post->ID
			//     'exclude' => get_post_thumbnail_id()

			// );
			// $attachments = get_posts($args);
			// if ($attachments) {
			//     foreach ($attachments as $attachment) {
			//         echo '<li>';
			//         the_attachment_link($attachment->ID, false);
			//         echo '</li>';
			//     }
			// }



			// Setup array for storing objects
			$my_attachment_objects = array();

			// Arguments for custom WP_Query loop
			$my_cpts_args = array(
			    'post_type' => 'gallery',
			    'gallery_category' => 'social',
			    'posts_per_page'  => 10
			);

			// Make the new instance of the WP_Query class
			$my_cpts = new WP_Query( $my_cpts_args );

			// And Loop!
			if( $my_cpts->have_posts() ) : while( $my_cpts->have_posts() ) : $my_cpts->the_post();

			    // arguments for get_posts
			    $attachment_args = array(
			        'post_type' => 'attachment',
				    'post_parent' => $post->ID,
				    'posts_per_page'  => 3
			    );
			    // get the posts
			    $this_posts_attachments = get_posts( $attachment_args );
			    // append those posts onto the array
			    if ($this_posts_attachments) {
				    foreach ($this_posts_attachments as $attachment) {
				        echo '<li><a href="';
				        the_permalink();
				        echo '">';
				        echo wp_get_attachment_image($attachment->ID, 'social-gallery');
				        echo '</a></li>';
				    }
				}

			endwhile; endif; wp_reset_postdata();
		?>
	</ul>
</div>