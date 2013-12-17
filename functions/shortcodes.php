<?php

/* ---------------------------------------------------------------------- */
/*	Columns
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	One half
	/* -------------------------------------------------- */

	function hg_framework_one_half_sc( $atts, $content = null ) {

		return '<div class="one-half">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_half', 'hg_framework_one_half_sc');

	/* -------------------------------------------------- */
	/*	One half last
	/* -------------------------------------------------- */

	function hg_framework_one_half_last_sc( $atts, $content = null ) {

		return '<div class="one-half last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_half_last', 'hg_framework_one_half_last_sc');

	/* -------------------------------------------------- */
	/*	One third
	/* -------------------------------------------------- */

	function hg_framework_one_third_sc( $atts, $content = null ) {

		return '<div class="one-third">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_third', 'hg_framework_one_third_sc');

	/* -------------------------------------------------- */
	/*	One third last
	/* -------------------------------------------------- */

	function hg_framework_one_third_last_sc( $atts, $content = null ) {

		return '<div class="one-third last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_third_last', 'hg_framework_one_third_last_sc');

	/* -------------------------------------------------- */
	/*	One fourth
	/* -------------------------------------------------- */

	function hg_framework_one_fourth_sc( $atts, $content = null ) {

		return '<div class="one-fourth">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_fourth', 'hg_framework_one_fourth_sc');

	/* -------------------------------------------------- */
	/*	One fourth last
	/* -------------------------------------------------- */

	function hg_framework_one_fourth_last_sc( $atts, $content = null ) {

		return '<div class="one-fourth last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_fourth_last', 'hg_framework_one_fourth_last_sc');

	/* -------------------------------------------------- */
	/*	Two third
	/* -------------------------------------------------- */

	function hg_framework_two_third_sc( $atts, $content = null ) {

		return '<div class="two-third">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('two_third', 'hg_framework_two_third_sc');

	/* -------------------------------------------------- */
	/*	Two third last
	/* -------------------------------------------------- */

	function hg_framework_two_third_last_sc( $atts, $content = null ) {

		return '<div class="two-third last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('two_third_last', 'hg_framework_two_third_last_sc');

	/* -------------------------------------------------- */
	/*	Three fourth
	/* -------------------------------------------------- */

	function hg_framework_three_four_sc( $atts, $content = null ) {

		return '<div class="three-fourth">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('three_fourth', 'hg_framework_three_four_sc');

	/* -------------------------------------------------- */
	/*	Three fourth last
	/* -------------------------------------------------- */

	function hg_framework_three_fourth_last_sc( $atts, $content = null ) {

		return '<div class="three-fourth last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('three_fourth_last', 'hg_framework_three_fourth_last_sc');
	
	
	/* -------------------------------------------------- */
	/*	Divider
	/* -------------------------------------------------- */

	function hg_framework_divider_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style' => ''
		), $atts ) );

		return '<hr class="' . esc_attr( $style ) . '" />';
	
	}
	add_shortcode('divider', 'hg_framework_divider_sc');


	/* -------------------------------------------------- */
	/*	Clean <p>/<br> after shortcodes
	/* -------------------------------------------------- */
	
	function webtreats_formatter($content) {
		$new_content = '';
	
		/* Matches the contents and the open and closing tags */
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
		/* Matches just the contents */
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
		/* Divide content into pieces */
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
		/* Loop over pieces */
		foreach ($pieces as $piece) {
			/* Look for presence of the shortcode */
			if (preg_match($pattern_contents, $piece, $matches)) {
	
				/* Append to content (no formatting) */
				$new_content .= $matches[1];
			} else {
	
				/* Format and append to content */
				$new_content .= wptexturize(wpautop($piece));
			}
		}
	
		return $new_content;
	}
	
	// Remove the 2 main auto-formatters
	remove_filter('the_content', 'wpautop');
	remove_filter('the_content', 'wptexturize');
	
	// Before displaying for viewing, apply this function
	add_filter('the_content', 'webtreats_formatter', 99);
	add_filter('widget_text', 'webtreats_formatter', 99);
	
	/* -------------------------------------------------- */
	/* Buttons
	/* -------------------------------------------------- */

	// Default
	function hg_framework_button_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'url'   => ''
		), $atts ) );

		$output = '<a class="btn" href="">';

		$output .= $content;

		$output .= '</a>';

		return $output;
	
	}
	add_shortcode('button', 'hg_framework_button_sc');
	
	// Option
	function hg_framework_button_black_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'url'   => ''
		), $atts ) );

		$output = '<a class="btn black-btn" href="">';

		$output .= $content;

		$output .= '</a>';

		return $output;
	
	}
	add_shortcode('button_black', 'hg_framework_button_black_sc');
	
	/* -------------------------------------------------- */
	/*	Content Tabs
	/* -------------------------------------------------- */

	// Tabs container
	function hg_framework_content_tabgroup_sc( $atts, $content = null ) {

		if( !$GLOBALS['tabs_groups'] )
			$GLOBALS['tabs_groups'] = 0;
			
		$GLOBALS['tabs_groups']++;

		$GLOBALS['tab_count'] = 0;

		$tabs_count = 1;

		do_shortcode( $content );

		if( is_array( $GLOBALS['tabs'] ) ) {

			foreach( $GLOBALS['tabs'] as $tab ) {

				$tabs[] = '<li><a href="#tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count . '">' . $tab['title'] . '</a></li>';
				$panes[] = '<div id="tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count++ . '" class="tab-content">' . do_shortcode( $tab['content'] ) . '</div>';

			}

			$return = "\n". '<ul class="tab-nav">' . implode( "\n", $tabs ) . '</ul>' . "\n" . '<div class="tabs-container">' . implode( "\n", $panes ) . '</div>' . "\n";
		}

		return $return;

	}
	add_shortcode('tabgroup', 'hg_framework_content_tabgroup_sc');

	// Single tab
	function hg_framework_content_tab_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title' => ''
		), $atts) );

		$i = $GLOBALS['tab_count'];

		$GLOBALS['tabs'][$i] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );

		$GLOBALS['tab_count']++;

	}
	add_shortcode('tab', 'hg_framework_content_tab_sc');