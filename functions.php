<?php
/**
 * Functions.php file for GV Exchange Child Theme
 *
 * Assumes parent is gv-project-theme.
 * This code will run before the functions.php in that theme.
 */

if (isset($gv) AND is_object($gv)) :

	/**
	 * Disable automatic plugin activation from parent theme. We need this theme to work in MU
	 */
	define('GV_NO_DEFAULT_PLUGINS', TRUE);

	/**
	 * Define GV_LINGUA as false to override the TRUE definition in the projects theme 
	 */
	if (!defined('GV_LINGUA'))
		define('GV_LINGUA',  FALSE);
	
	/**
	 * Register Lenguas 2015 microgrants questions
	 * 
	 * Should only apply to posts in lenguas-2015 category, so it should be fine to leave it here indefinitely
	 */
	
	/**
	 * Define an image to show in the header.
	 * Project theme generic has none, so it will use site title
	 */
//	$gv->settings['header_img'] = get_stylesheet_directory_uri() . '/RisingVoices-microgrants-amazonia-600.png';	
	


		/**
		 * Register "public taxonomies" for gv_taxonomies system to display automatically on posts
		 */
		// Unregister defaults as they aren't useful for this site
//		gv_unregister_public_taxonomy('category');
//		gv_unregister_public_taxonomy('post_tag');	
		
		/**
		 * "Regions" taxonomy based on parentless members of gv_geo
		 */
//		gv_register_public_taxonomy('gv_geo', array(
//			'subtaxonomy_slug' => 'region',
//			'parent' => 'none',
//			'labels' => array(
//				'name' => _lingua('regions'), 
//				'singular_name' => 'Region',
//			),
//		));
		
		/**
		 * "Countries" taxonomy based on parentless members of gv_geo
		 */
//		gv_register_public_taxonomy('gv_geo', array(
//			'subtaxonomy_slug' => 'country',
//			'grandparent' => 'none',
//			'labels' => array(
//				'name' => _lingua('countries'), 
//				'singular_name' => 'country',
//			),			
//		));

	
	/**
	 * Filter the apple touch icon to be a customized logo
	 * 
	 * @param string $icon Default icon
	 * @return string desired icon
	 */
//	function gvadvocacy_theme_gv_apple_touch_icon($icon) {
//		return gv_get_dir('theme_images') ."gv-advocacy-apple-touch-icon-precomposed-300.png";
//	}
//	add_filter('gv_apple_touch_icon', 'gvadvocacy_theme_gv_apple_touch_icon');

	/**
	 * Filter the og:image (facebook/g+) default icon to be an RV logo
	 * 
	 * @param string $icon Default icon
	 * @return string desired icon
	 */
	function gvexchange_theme_gv_og_image_default($icon) {
		return gv_get_dir('theme_images') ."gv-exchange-logo-fb-1200x631.png";
	}
	add_filter('gv_og_image_default', 'gvexchange_theme_gv_og_image_default');
	
	/**
	 * Filter ALL CASES OF og:image (facebook/g+) icon to be an RV logo
	 * 
	 * @param string $icon Default icon
	 * @return string desired icon
	 */
//	function gvadvocacy_theme_gv_og_image($icon) {
//		return gv_get_dir('theme_images') ."rv-logo-square-600.png";
//	}
//	add_filter('gv_og_image', 'gvadvocacy_theme_gv_og_image');
	
	/**
	 * Filter gv_post_archive_hide_dates to hide them on hoempage
	 * @param type $limit
	 * @param type $args
	 * @return int
	 */
	function ex_gv_post_archive_hide_dates($hide_dates) {
		if (is_home() AND !is_paged())
			return true;
		
		return $hide_dates;
	}
	add_filter('gv_post_archive_hide_dates', 'ex_gv_post_archive_hide_dates', 10);
	
	/**
	 * Define the hierarchical structure of the taxonomy by its parents
	 */
//	$gv->taxonomy_outline = array(
//		'countries' => 1,
//		'topics' => 1,
//		'special' => 1,
//		'type' => 1,
//	);

	/**
	 * Define Categories to be inserted into post data before returning content for translation during fetch
	 * @see gv_lingua::reply_to_ping()
	 */
//	$gv->lingua_site_categories[] = 'gv-advocacy';

	/**
	 * Set a custom site description using a lingua string. To be used in social media sharing etc.
	 */
//	$gv->site_description = "A project of Global Voices Online, we seek to build a global anti-censorship network of bloggers and online activists dedicated to protecting freedom of expression and free access to information online.";
		/**
	 * Geo Mashup maps options partial_overrides
	 */
	if (!isset($gv->option_overrides['partial_overrides'])) :
		$gv->option_overrides['partial_overrides'] = array();
	endif;
	if (!isset($gv->option_overrides['partial_overrides']['geo_mashup_options'])) :
		$gv->option_overrides['partial_overrides']['geo_mashup_options'] = array(
			'overall' => array(
				'copy_geodata' => true,
				'theme_stylesheet_with_maps' => false,
			),
			'global_map' => array(
				'width' => '100%',
				'height' => '480',
				'auto_info_open' => false, 
				'enable_scroll_wheel_zoom' => false,
				'zoom' => 2,
				'max_posts' => 50,
			),
			'single_map' => array(
				'width' => '100%',
				'height' => '480',
				'zoom' => 7,
				'enable_scroll_wheel_zoom' => false,
			),
			'context_map' => array(
				'width' => '100%',
				'height' => '480',
				'zoom' => 7,
				'enable_scroll_wheel_zoom' => false,
			),
		);
	endif;
	
	/**
	 * Sponsors definition to be used by gv_get_sponsors()
	 */
	$gv->sponsors = array(
		'omidyar' => array(
			"name" => "Omidyar Network",
			"slug" => "omidyar",
			'description' => 'Omidyar Network - Every person has the power to make a difference.',
			"url" => "http://www.omidyar.com/",
			'status' => 'featured',
			),
		'hivos' => array(
			"name" => "Hivos",
			"slug" => "hivos",
			"description" => 'Hivos, the Humanist Institute for Development Cooperation',
			"url" => "http://www.hivos.org/",
			"status" => 'featured',
			),		
		'knight' => array(
			"name" => "Knight Foundation",
			"slug" => "knight",
			"description" => 'John S. and James L. Knight Foundation',
			"url" => "http://www.knightfdn.org/",
			"status" => 'featured',
			),
		'fpu' => array(
			"name" => "Free Press Unlimited",
			"slug" => "fpu",
			"description" => 'Free Press Unlimited - People Deserve to Know',
			"url" => "http://www.freepressunlimited.org/",
			"status" => 'featured',
			),
		'osi' => array(
			"name" => "Open Society Institute",
			"slug" => "osi",
			"description" => 'Open Society Institute - Building vibrant and tolerant democracies.',
			"url" => "http://www.soros.org/",
			"status" => 'featured',
			),
		'heinrichboll' => array(
			"name" => "Heinrich Böll Stiftung",
			"slug" => "heinrichboll",
			"description" => 'Heinrich Böll Stiftung - Striving to promote democracy, civil society, equality and a healthy environment internationally.',
			"url" => "http://www.boell.org/",
			"status" => 'featured',
			),
	);
	
	/**
	 * Filter gv_post_archive_hide_dates to hide them on hoempage
	 * @param type $limit
	 * @param type $args
	 * @return int
	 */
//	function lenguas_gv_post_archive_hide_dates($hide_dates) {
//		if (is_home() AND !is_paged())
//			return true;
//		
//		return $hide_dates;
//	}
//	add_filter('gv_post_archive_hide_dates', 'lenguas_gv_post_archive_hide_dates', 10);
		
	
endif; // is_object($gv)

?>