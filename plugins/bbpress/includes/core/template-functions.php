<?php

/**
 * bbPress Template Functions
 *
 * This file contains functions necessary to mirror the WordPress core template
 * loading process. Many of those functions are not filterable, and even then
 * would not be robust enough to predict where bbPress templates might exist.
 *
 * @package bbPress
 * @subpackage TemplateFunctions
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Adds bbPress theme support to any active WordPress theme
 *
 * @since 2.0.0 bbPress (r3032)
 *
 * @param string $slug
 * @param string $name Optional. Default null
 */
function bbp_get_template_part( $slug, $name = null ) {

	// Execute code for this part
	do_action( 'get_template_part_' . $slug, $slug, $name );

	// Setup possible parts
	$templates = array();
	if ( isset( $name ) ) {
		$templates[] = $slug . '-' . $name . '.php';
	}
	$templates[] = $slug . '.php';

	// Allow template parst to be filtered
	$templates = apply_filters( 'bbp_get_template_part', $templates, $slug, $name );

	// Return the part that is found
	return bbp_locate_template( $templates, true, false );
}

/**
 * Retrieve the name of the highest priority template file that exists.
 *
 * Searches in the child theme before parent theme so that themes which
 * inherit from a parent theme can just overload one file. If the template is
 * not found in either of those, it looks in the theme-compat folder last.
 *
 * @since 2.1.0 bbPress (r3618)
 *
 * @param string|array $template_names Template file(s) to search for, in order.
 * @param bool $load If true the template file will be loaded if it is found.
 * @param bool $require_once Whether to require_once or require. Default true.
 *                            Has no effect if $load is false.
 * @return string The template filename if one is located.
 */
function bbp_locate_template( $template_names, $load = false, $require_once = true ) {

	// No file found yet
	$located            = false;
	$template_locations = bbp_get_template_stack();

	// Try to find a template file
	foreach ( (array) $template_names as $template_name ) {

		// Continue if template is empty
		if ( empty( $template_name ) ) {
			continue;
		}

		// Trim off any slashes from the template name
		$template_name  = ltrim( $template_name, '/' );

		// Loop through template stack
		foreach ( (array) $template_locations as $template_location ) {

			// Continue if $template_location is empty
			if ( empty( $template_location ) ) {
				continue;
			}

			// Check child theme first
			if ( file_exists( trailingslashit( $template_location ) . $template_name ) ) {
				$located = trailingslashit( $template_location ) . $template_name;
				break 2;
			}
		}
	}

	/**
	 * This action exists only to follow the standard bbPress coding convention,
	 * and should not be used to short-circuit any part of the template locator.
	 *
	 * If you want to override a specific template part, please either filter
	 * 'bbp_get_template_part' or add a new location to the template stack.
	 */
	do_action( 'bbp_locate_template', $located, $template_name, $template_names, $template_locations, $load, $require_once );

	// Maybe load the template if one was located
	if ( ( defined( 'WP_USE_THEMES' ) && WP_USE_THEMES ) && ( true === $load ) && ! empty( $located ) ) {
		load_template( $located, $require_once );
	}

	return $located;
}

/**
 * Locate an enqueueable file on the server. Used before being enqueued.
 *
 * If SCRIPT_DEBUG is set and the file includes a .min suffix, this function
 * will automatically attempt to locate a non-minified version of that file.
 *
 * If SCRIPT_DEBUG is not set and the file exclude a .min suffix, this function
 * will automatically attempt to locate a minified version of that file.
 *
 * See: https://bbpress.trac.wordpress.org/ticket/3218
 *
 * @since 2.6.0
 *
 * @param string $file
 *
 * @return boolean
 */
function bbp_locate_enqueueable( $file = '' ) {

	// Bail if no file to locate
	if ( empty( $file ) ) {
		return false;
	}

	// Add file to files array
	$files = array( $file );

	// Get the file variant (minified or not, but opposite of $file)
	$file_is_min  = ( false !== strpos( $file, '.min' ) );
	$file_variant = ( false === $file_is_min )
		? str_replace( array( '.css', '.js' ), array( '.min.css', '.min.js' ), $file )
		: str_replace( '.min', '', $file );

	// Are we debugging?
	$script_debug = bbp_doing_script_debug();

	// Debugging, so prefer unminified files
	if ( true === $script_debug ) {
		if ( true === $file_is_min ) {
			array_unshift( $files, $file_variant );
		} else {
			array_push( $files, $file_variant );
		}

	// Not debugging, so prefer minified files
	} elseif ( false === $script_debug ) {
		if ( true === $file_is_min ) {
			array_push( $files, $file_variant );
		} else {
			array_unshift( $files, $file_variant );
		}
	}

	// Return first found file location in the stack
	return bbp_locate_template( $files, false, false );
}

/**
 * Convert an enqueueable file path to a URL
 *
 * @since 2.6.0
 * @param string $file
 *
 * @return string
 */
function bbp_urlize_enqueueable( $file = '' ) {

	// Get DIR and URL
	$content_dir = constant( 'WP_CONTENT_DIR' );
	$content_url = content_url();

	// IIS (Windows) here
	// Replace back slashes with forward slash
	if ( false !== strpos( $file, '\\' ) ) {
		$file        = str_replace( '\\', '/', $file        );
		$content_dir = str_replace( '\\', '/', $content_dir );
	}

	// Return path to file relative to site URL
	return str_replace( $content_dir, $content_url, $file );
}

/**
 * Enqueue a script from the highest priority location in the template stack.
 *
 * Registers the style if file provided (does NOT overwrite) and enqueues.
 *
 * @since 2.5.0 bbPress (r5180)
 *
 * @param string      $handle Name of the stylesheet.
 * @param string|bool $file   Relative path to stylesheet. Example: '/css/mystyle.css'.
 * @param array       $deps   An array of registered style handles this stylesheet depends on. Default empty array.
 * @param string|bool $ver    String specifying the stylesheet version number, if it has one. This parameter is used
 *                            to ensure that the correct version is sent to the client regardless of caching, and so
 *                            should be included if a version number is available and makes sense for the stylesheet.
 * @param string      $media  Optional. The media for which this stylesheet has been defined.
 *                            Default 'all'. Accepts 'all', 'aural', 'braille', 'handheld', 'projection', 'print',
 *                            'screen', 'tty', or 'tv'.
 *
 * @return mixed The style filename if one is located. False if not.
 */
function bbp_enqueue_style( $handle = '', $file = '', $deps = array(), $ver = false, $media = 'all' ) {

	// Attempt to locate an enqueueable
	$located = bbp_locate_enqueueable( $file );

	// Enqueue if located
	if ( ! empty( $located ) ) {

		// Make sure there is always a version
		if ( empty( $ver ) ) {
			$ver = bbp_get_asset_version();
		}

		// Make path to file relative to site URL
		$located = bbp_urlize_enqueueable( $located );

		// Register the style
		wp_register_style( $handle, $located, $deps, $ver, $media );

		// Enqueue the style
		wp_enqueue_style( $handle );
	}

	return $located;
}

/**
 * Enqueue a script from the highest priority location in the template stack.
 *
 * Registers the style if file provided (does NOT overwrite) and enqueues.
 *
 * @since 2.5.0 bbPress (r5180)
 *
 * @param string      $handle    Name of the script.
 * @param string|bool $file      Relative path to the script. Example: '/js/myscript.js'.
 * @param array       $deps      An array of registered handles this script depends on. Default empty array.
 * @param string|bool $ver       Optional. String specifying the script version number, if it has one. This parameter
 *                               is used to ensure that the correct version is sent to the client regardless of caching,
 *                               and so should be included if a version number is available and makes sense for the script.
 * @param bool        $in_footer Optional. Whether to enqueue the script before </head> or before </body>.
 *                               Default 'false'. Accepts 'false' or 'true'.
 *
 * @return mixed The script filename if one is located. False if not.
 */
function bbp_enqueue_script( $handle = '', $file = '', $deps = array(), $ver = false, $in_footer = false ) {

	// Attempt to locate an enqueueable
	$located = bbp_locate_enqueueable( $file );

	// Enqueue if located
	if ( ! empty( $located ) ) {

		// Make sure there is always a version
		if ( empty( $ver ) ) {
			$ver = bbp_get_asset_version();
		}

		// Make path to file relative to site URL
		$located = bbp_urlize_enqueueable( $located );

		// Register the style
		wp_register_script( $handle, $located, $deps, $ver, $in_footer );

		// Enqueue the style
		wp_enqueue_script( $handle );
	}

	return $located;
}

/**
 * This is really cool. This function registers a new template stack location,
 * using WordPress's built in filters API.
 *
 * This allows for templates to live in places beyond just the parent/child
 * relationship, to allow for custom template locations. Used in conjunction
 * with bbp_locate_template(), this allows for easy template overrides.
 *
 * @since 2.2.0 bbPress (r4323)
 *
 * @param string $location_callback Callback function that returns the
 * @param int $priority
 */
function bbp_register_template_stack( $location_callback = '', $priority = 10 ) {

	// Bail if no location, or function/method is not callable
	if ( empty( $location_callback ) || ! is_callable( $location_callback ) ) {
		return false;
	}

	// Add location callback to template stack
	return add_filter( 'bbp_template_stack', $location_callback, (int) $priority );
}

/**
 * Deregisters a previously registered template stack location.
 *
 * @since 2.3.0 bbPress (r4652)
 *
 * @param string $location_callback Callback function that returns the
 * @param int $priority
 * @return bool Whether stack was removed
 */
function bbp_deregister_template_stack( $location_callback = '', $priority = 10 ) {

	// Bail if no location, or function/method is not callable
	if ( empty( $location_callback ) || ! is_callable( $location_callback ) ) {
		return false;
	}

	// Remove location callback to template stack
	return remove_filter( 'bbp_template_stack', $location_callback, (int) $priority );
}

/**
 * Call the functions added to the 'bbp_template_stack' filter hook, and return
 * an array of the template locations.
 *
 * @since 2.2.0 bbPress (r4323)
 * @since 2.6.0 bbPress (r5944) Added support for `WP_Hook`
 *
 * @global array $wp_filter Stores all of the filters
 * @global array $merged_filters Merges the filter hooks using this function.
 * @global array $wp_current_filter stores the list of current filters with the current one last
 *
 * @return array The filtered value after all hooked functions are applied to it.
 */
function bbp_get_template_stack() {
	global $wp_filter, $merged_filters, $wp_current_filter;

	// Setup some default variables
	$tag  = 'bbp_template_stack';
	$args = $stack = array();

	// Add 'bbp_template_stack' to the current filter array
	$wp_current_filter[] = $tag;

	// Bail if no stack setup
	if ( empty( $wp_filter[ $tag ] ) ) {
		return array();
	}

	// Check if WP_Hook class exists, see #WP17817
	if ( class_exists( 'WP_Hook' ) ) {
		$filter = $wp_filter[ $tag ]->callbacks;
	} else {
		$filter = &$wp_filter[ $tag ];

		// Sort
		if ( ! isset( $merged_filters[ $tag ] ) ) {
			ksort( $filter );
			$merged_filters[ $tag ] = true;
		}
	}

	// Ensure we're always at the beginning of the filter array
	reset( $filter );

	// Loop through 'bbp_template_stack' filters, and call callback functions
	do {
		foreach ( (array) current( $filter ) as $the_ ) {
			if ( ! is_null( $the_['function'] ) ) {
				$args[1] = $stack;
				$stack[] = call_user_func_array( $the_['function'], array_slice( $args, 1, (int) $the_['accepted_args'] ) );
			}
		}
	} while ( next( $filter ) !== false );

	// Remove 'bbp_template_stack' from the current filter array
	array_pop( $wp_current_filter );

	// Remove empties and duplicates
	$stack = array_unique( array_filter( $stack ) );

	// Filter & return
	return (array) apply_filters( 'bbp_get_template_stack', $stack ) ;
}

/**
 * Get a template part in an output buffer, and return it
 *
 * @since 2.4.0 bbPress (r5043)
 *
 * @param string $slug
 * @param string $name
 * @return string
 */
function bbp_buffer_template_part( $slug, $name = null, $echo = true ) {
	ob_start();

	bbp_get_template_part( $slug, $name );

	// Get the output buffer contents
	$output = ob_get_clean();

	// Echo or return the output buffer contents
	if ( true === $echo ) {
		echo $output;
	} else {
		return $output;
	}
}

/**
 * Retrieve path to a template
 *
 * Used to quickly retrieve the path of a template without including the file
 * extension. It will also check the parent theme and theme-compat theme with
 * the use of {@link bbp_locate_template()}. Allows for more generic template
 * locations without the use of the other get_*_template() functions.
 *
 * @since 2.1.0 bbPress (r3629)
 *
 * @param string $type Filename without extension.
 * @param array $templates An optional list of template candidates
 * @return string Full path to file.
 */
function bbp_get_query_template( $type, $templates = array() ) {
	$type = preg_replace( '|[^a-z0-9-]+|', '', $type );

	// Fallback template
	if ( empty( $templates ) ) {
		$templates = array( "{$type}.php" );
	}

	// Filter possible templates
	$templates = apply_filters( "bbp_get_{$type}_template", $templates );

	// Stash the possible templates for this query, for later use
	bbp_set_theme_compat_templates( $templates );

	// Try to locate a template in the stack
	$template = bbp_locate_template( $templates );

	// Stash the located template for this query, for later use
	bbp_set_theme_compat_template( $template );

	// Filter & return
	return apply_filters( "bbp_{$type}_template", $template, $templates );
}

/**
 * Get the possible subdirectories to check for templates in
 *
 * @since 2.1.0 bbPress (r3738)
 *
 * @param array $templates Templates we are looking for
 * @return array Possible subdirectories to look in
 */
function bbp_get_template_locations( $templates = array() ) {
	$locations = array(
		'bbpress',
		'forums',
		''
	);

	// Filter & return
	return apply_filters( 'bbp_get_template_locations', $locations, $templates );
}

/**
 * Add template locations to template files being searched for
 *
 * @since 2.1.0 bbPress (r3738)
 *
 * @param array $stacks
 * @return array()
 */
function bbp_add_template_stack_locations( $stacks = array() ) {
	$retval = array();

	// Get alternate locations
	$locations = bbp_get_template_locations();

	// Loop through locations and stacks and combine
	foreach ( (array) $stacks as $stack ) {
		foreach ( (array) $locations as $custom_location ) {
			$retval[] = untrailingslashit( trailingslashit( $stack ) . $custom_location );
		}
	}

	// Filter & return
	return (array) apply_filters( 'bbp_add_template_stack_locations', array_unique( $retval ), $stacks );
}

/**
 * Add checks for bbPress conditions to parse_query action
 *
 * If it's a user page, WP_Query::bbp_is_single_user is set to true.
 *
 * If it's a user edit page, WP_Query::bbp_is_single_user_edit is set to true
 * and the the 'wp-admin/includes/user.php' file is included.
 *
 * In addition, on user/user edit pages, WP_Query::home is set to false & query
 * vars 'bbp_user_id' with the displayed user id is added.
 *
 * In 2.6.0, the 'author_name' variable is no longer set when viewing a single
 * user, because of is_author() weirdness. If this removal causes problems, it
 * may come back in a future release.
 *
 * If it's a forum edit, WP_Query::bbp_is_forum_edit is set to true
 * If it's a topic edit, WP_Query::bbp_is_topic_edit is set to true
 * If it's a reply edit, WP_Query::bbp_is_reply_edit is set to true.
 *
 * If it's a view page, WP_Query::bbp_is_view is set to true
 * If it's a search page, WP_Query::bbp_is_search is set to true
 *
 * @since 2.0.0 bbPress (r2688)
 *
 * @param WP_Query $posts_query
 */
function bbp_parse_query( $posts_query ) {

	// Bail if $posts_query is not the main loop
	if ( ! $posts_query->is_main_query() ) {
		return;
	}

	// Bail if filters are suppressed on this query
	if ( true === $posts_query->get( 'suppress_filters' ) ) {
		return;
	}

	// Bail if in admin
	if ( is_admin() ) {
		return;
	}

	// Get query variables (default to null if not set)
	$bbp_view  = $posts_query->get( bbp_get_view_rewrite_id(),   null );
	$bbp_user  = $posts_query->get( bbp_get_user_rewrite_id(),   null );
	$is_edit   = $posts_query->get( bbp_get_edit_rewrite_id(),   null );
	$is_search = $posts_query->get( bbp_get_search_rewrite_id(), null );

	// It is a user page - We'll also check if it is user edit
	if ( ! is_null( $bbp_user ) ) {

		/** Find User *********************************************************/

		// Setup the default user variable
		$the_user = false;

		// If using pretty permalinks, always use slug
		if ( get_option( 'permalink_structure' ) ) {
			$the_user = get_user_by( 'slug', $bbp_user );

		// If not using pretty permalinks, always use numeric ID
		} elseif ( is_numeric( $bbp_user ) ) {
			$the_user = get_user_by( 'id', $bbp_user );
		}

		// 404 and bail if user does not have a profile
		if ( empty( $the_user->ID ) || ! bbp_user_has_profile( $the_user->ID ) ) {
			$posts_query->bbp_is_404 = true;
			return;
		}

		/** User Exists *******************************************************/

		$is_favs        = $posts_query->get( bbp_get_user_favorites_rewrite_id()     );
		$is_subs        = $posts_query->get( bbp_get_user_subscriptions_rewrite_id() );
		$is_topics      = $posts_query->get( bbp_get_user_topics_rewrite_id()        );
		$is_replies     = $posts_query->get( bbp_get_user_replies_rewrite_id()       );
		$is_engagements = $posts_query->get( bbp_get_user_engagements_rewrite_id()   );

		// View or edit?
		if ( ! is_null( $is_edit ) ) {

			// We are editing a profile
			$posts_query->bbp_is_single_user_edit = true;

			// Load the core WordPress contact methods
			if ( ! function_exists( '_wp_get_user_contactmethods' ) ) {
				require_once ABSPATH . 'wp-includes/registration.php';
			}

			// Load the edit_user functions
			if ( ! function_exists( 'edit_user' ) ) {
				require_once ABSPATH . 'wp-admin/includes/user.php';
			}

			// Load the grant/revoke super admin functions
			if ( is_multisite() && ! function_exists( 'revoke_super_admin' ) ) {
				require_once ABSPATH . 'wp-admin/includes/ms.php';
			}

			// Editing a user
			$posts_query->bbp_is_edit = true;

		// User favorites
		} elseif ( ! empty( $is_favs ) ) {
			$posts_query->bbp_is_single_user_favs = true;

		// User subscriptions
		} elseif ( ! empty( $is_subs ) ) {
			$posts_query->bbp_is_single_user_subs = true;

		// User topics
		} elseif ( ! empty( $is_topics ) ) {
			$posts_query->bbp_is_single_user_topics = true;

		// User topics
		} elseif ( ! empty( $is_replies ) ) {
			$posts_query->bbp_is_single_user_replies = true;

		// User engagements
		} elseif ( ! empty( $is_engagements ) ) {
			$posts_query->bbp_is_single_user_engagements = true;

		// User profile
		} else {
			$posts_query->bbp_is_single_user_profile = true;
		}

		// Make sure 404 is not set
		$posts_query->is_404  = false;

		// Correct is_home variable
		$posts_query->is_home = false;

		// Looking at a single user
		$posts_query->bbp_is_single_user = true;

		// User found so don't 404 yet
		$posts_query->bbp_is_404 = false;

		// User is looking at their own profile
		if ( bbp_get_current_user_id() === $the_user->ID ) {
			$posts_query->bbp_is_single_user_home = true;
		}

		// Set bbp_user_id for future reference
		$posts_query->set( 'bbp_user_id', $the_user->ID );

		// Set the displayed user global to this user
		bbpress()->displayed_user = $the_user;

	// View Page
	} elseif ( ! is_null( $bbp_view ) ) {

		// Check if the view exists by checking if there are query args are set
		$view_args = bbp_get_view_query_args( $bbp_view );

		// Bail if view args are empty
		if ( empty( $view_args ) ) {
			$posts_query->bbp_is_404 = true;
			return;
		}

		// Correct is_home variable
		$posts_query->is_home     = false;

		// We are in a custom topic view
		$posts_query->bbp_is_view = true;

		// No 404 because views are all (currently) public
		$posts_query->bbp_is_404 = false;

	// Search Page
	} elseif ( ! is_null( $is_search ) ) {

		// Check if there are search query args set
		$search_terms = bbp_get_search_terms();
		if ( ! empty( $search_terms ) ) {
			$posts_query->bbp_search_terms = $search_terms;
		}

		// Correct is_home variable
		$posts_query->is_home = false;

		// We are in a search query
		$posts_query->bbp_is_search = true;

		// No 404 because search is always public
		$posts_query->bbp_is_404 = false;

	// Forum/Topic/Reply Edit Page
	} elseif ( ! is_null( $is_edit ) ) {

		// Get the post type from the main query loop
		$post_type = $posts_query->get( 'post_type' );

		// Check which post_type we are editing, if any
		if ( ! empty( $post_type ) ) {
			switch ( $post_type ) {

				// We are editing a forum
				case bbp_get_forum_post_type() :
					$posts_query->bbp_is_forum_edit  = true;
					$posts_query->bbp_is_edit        = true;
					$posts_query->bbp_is_404         = false;
					break;

				// We are editing a topic
				case bbp_get_topic_post_type() :
					$posts_query->bbp_is_topic_edit  = true;
					$posts_query->bbp_is_edit        = true;
					$posts_query->bbp_is_404         = false;
					break;

				// We are editing a reply
				case bbp_get_reply_post_type() :
					$posts_query->bbp_is_reply_edit  = true;
					$posts_query->bbp_is_edit        = true;
					$posts_query->bbp_is_404         = false;
					break;
			}

		// We are editing a topic tag
		} elseif ( bbp_is_topic_tag() ) {
			$posts_query->bbp_is_topic_tag_edit = true;
			$posts_query->bbp_is_edit           = true;
			$posts_query->bbp_is_404            = false;
		}

		// We save post revisions on our own
		remove_action( 'pre_post_update', 'wp_save_post_revision' );

	// Topic tag page
	} elseif ( bbp_is_topic_tag() ) {
		$posts_query->set( 'bbp_topic_tag',  get_query_var( 'term' )   );
		$posts_query->set( 'post_type',      bbp_get_topic_post_type() );
		$posts_query->set( 'posts_per_page', bbp_get_topics_per_page() );

	// Do topics on forums root
	} elseif ( is_post_type_archive( bbp_get_post_types( array( 'has_archive' => true ) ) ) && ( 'topics' === bbp_show_on_root() ) ) {
		$posts_query->bbp_show_topics_on_root = true;
	}
}
