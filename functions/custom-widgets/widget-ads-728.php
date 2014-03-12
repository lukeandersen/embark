<?php
// Ads Widget 

class AdWidget_728 extends WP_Widget {

	function AdWidget_728() {
		$widget_ops = array('description' => 'Use this widget to add Ad as a widget.' );
		parent::WP_Widget(false, __('Embark - 728px Ad', 'embark'),$widget_ops);      
	}

	function widget($args, $instance) {  
		// $title = $instance['title'];
		$adcode = $instance['adcode'];
		$image = $instance['image'];
		$href = $instance['href'];
		$alt = $instance['alt'];

        echo '<span class="ad">Advertisment</span>';

		// if($title != '')
		// 	echo '<h1 class="widget-title">'.$title.'</h1>';

		if($adcode != ''){
		?>
		
		<?php echo $adcode; ?>
		
		<?php } else { ?>
			<aside class="widget full advert">
				<a href="<?php echo $href; ?>"><img class="ad728 rad" src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" /></a>
            </aside>
		<?php
		}
		
		echo '';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {    
	
		$defaults = array('title' => '', 'adcode' => '', 'image' => '', 'href' => '', 'alt' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
			    
		// $title = esc_attr($instance['title']);
		$adcode = esc_attr($instance['adcode']);
		$image = esc_attr($instance['image']);
		$href = esc_attr($instance['href']);
		$alt = esc_attr($instance['alt']);
		?>
        <!-- <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','embark'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p> -->
		<p>
            <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Ad Code:','embark'); ?></label>
            <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
        </p>
        <p><strong>or</strong></p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','embark'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','embark'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo $href; ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','embark'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <?php
	}
} 

register_widget('AdWidget_728');
?>