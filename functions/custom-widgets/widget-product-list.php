<?php
// Products Widget 

class Products extends WP_Widget {

	function Products() {
		$widget_ops = array('description' => 'Product list widget.' );
		parent::WP_Widget(false, __('Product list', 'embark'),$widget_ops);      
	}

	function widget($args, $instance) { 

		$image = $instance['image'];
		$image2 = $instance['image2'];
		$image3 = $instance['image3'];
		$href = $instance['href'];
		$href2 = $instance['href2'];
		$href3 = $instance['href3'];
		$desc = $instance['desc'];
		$desc2 = $instance['desc2'];
		$desc3 = $instance['desc3'];

		?>
		<aside class="widget products">
			<h1 class="widget-title">Title</h1>
			<h2 class="under-title">Sub title</h2>
			<ul>
				<li><a href="<?php echo $href; ?>" target="_blank"><img src="<?php echo $image; ?>" alt="product"><?php echo $desc; ?></a></li>
				<li><a href="<?php echo $href2; ?>" target="_blank"><img src="<?php echo $image2; ?>" alt="product"><?php echo $desc2; ?></a></li>
				<li><a href="<?php echo $href3; ?>" target="_blank"><img src="<?php echo $image3; ?>" alt="product"><?php echo $desc3; ?></a></li>
			</ul>
		</aside>

		<?php
	}

	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['image2'] = $new_instance['image2'];
		$instance['image3'] = strip_tags( $new_instance['image3'] );
		
		$instance['href'] = $new_instance['href'];
		$instance['href2'] = $new_instance['href2'];
		$instance['href3'] = $new_instance['href3'];

		$instance['desc'] = $new_instance['desc'];
		$instance['desc2'] = $new_instance['desc2'];
		$instance['desc3'] = $new_instance['desc3'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Example', 'themnific'), 'image' => '', 'image2' => '','image3' => '', 'href' => '', 'href2' => '', 'href3' => '', 'desc' => '', 'desc2' => '', 'desc3' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image URL', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'href' ); ?>"><?php _e('Target URL', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'href' ); ?>" name="<?php echo $this->get_field_name( 'href' ); ?>" value="<?php echo $instance['href']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo $instance['desc']; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'image2' ); ?>"><?php _e('Image 2 URL', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image2' ); ?>" name="<?php echo $this->get_field_name( 'image2' ); ?>" value="<?php echo $instance['image2']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'href2' ); ?>"><?php _e('Target 2 URL', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'href2' ); ?>" name="<?php echo $this->get_field_name( 'href2' ); ?>" value="<?php echo $instance['href2']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc2' ); ?>"><?php _e('Description 2', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc2' ); ?>" name="<?php echo $this->get_field_name( 'desc2' ); ?>" value="<?php echo $instance['desc2']; ?>"/>
		</p>   
        
		<p>
			<label for="<?php echo $this->get_field_id( 'image3' ); ?>"><?php _e('Image 3 URL', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'image3' ); ?>" name="<?php echo $this->get_field_name( 'image3' ); ?>" value="<?php echo $instance['image3']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'href3' ); ?>"><?php _e('Target 3 URL', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'href3' ); ?>" name="<?php echo $this->get_field_name( 'href3' ); ?>" value="<?php echo $instance['href3']; ?>"/>
		</p>  
		<p>
			<label for="<?php echo $this->get_field_id( 'desc3' ); ?>"><?php _e('Description 3', 'themnific'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc3' ); ?>" name="<?php echo $this->get_field_name( 'desc3' ); ?>" value="<?php echo $instance['desc3']; ?>"/>
		</p> 
        
        <?php
	}
} 

register_widget('Products');
?>