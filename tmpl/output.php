<pre><code>&lt;?php

add_action( 'init', 'my_register_post_types' );

function my_register_post_types() {

	$args = array(

		'description'         => __( 'This is a description for my post type.', 'example-textdomain' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'can_export'          => true,
		'delete_with_user'    => false,
		'hierarchical'        => false,
		'has_archive'         => '{{ data.type_plural }}',
		'query_var'           => '{{ data.type_singular }}',
		'capability_type'     => '{{ data.type_singular }}',
		'map_meta_cap'        => true,

		'capabilities' => array(

			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_{{ data.type_singular }}',
			'read_post'              => 'read_{{ data.type_singular }}',
			'delete_post'            => 'delete_{{ data.type_singular }}',

			// primitive/meta caps
			'create_posts'           => 'create_{{ data.type_plural }}',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_{{ data.type_plural }}',
			'edit_others_posts'      => 'edit_others_{{ data.type_plural }}',
			'publish_posts'          => 'publish_{{ data.type_plural }}',
			'read_private_posts'     => 'read_private_{{ data.type_plural }}',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'delete_{{ data.type_plural }}',
			'delete_private_posts'   => 'delete_private_{{ data.type_plural }}',
			'delete_published_posts' => 'delete_published_{{ data.type_plural }}',
			'delete_others_posts'    => 'delete_others_{{ data.type_plural }}',
			'edit_private_posts'     => 'edit_private_{{ data.type_plural }}',
			'edit_published_posts'   => 'edit_{{ data.type_plural }}'
		),

		'rewrite' => array(
			'slug'       => '{{ data.type_singular }}',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
			'ep_mask'    => EP_PERMALINK,
		),

		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'trackbacks',
			'custom-fields',
			'revisions',
			'page-attributes',
			'post-formats',
		),

		'labels' => array(
			'name'                  => __( 'Posts',                   'example-textdomain' ),
			'singular_name'         => __( 'Post',                    'example-textdomain' ),
			'menu_name'             => __( 'Posts',                   'example-textdomain' ),
			'name_admin_bar'        => __( 'Posts',                   'example-textdomain' ),
			'add_new'               => __( 'Add New',                 'example-textdomain' ),
			'add_new_item'          => __( 'Add New Post',            'example-textdomain' ),
			'edit_item'             => __( 'Edit Post',               'example-textdomain' ),
			'new_item'              => __( 'New Post',                'example-textdomain' ),
			'view_item'             => __( 'View Post',               'example-textdomain' ),
			'search_items'          => __( 'Search Posts',            'example-textdomain' ),
			'not_found'             => __( 'No posts found',          'example-textdomain' ),
			'not_found_in_trash'    => __( 'No posts found in trash', 'example-textdomain' ),
			'all_items'             => __( 'All Posts',               'example-textdomain' ),
			'featured_image'        => __( 'Featured Image',          'example-textdomain' ),
			'set_featured_image'    => __( 'Set featured image',      'example-textdomain' ),
			'remove_featured_image' => __( 'Remove featured image',   'example-textdomain' ),
			'use_featured_image'    => __( 'Use as featred image',    'example-textdomain' ),
			'insert_into_item'      => __( 'Insert into post',        'example-textdomain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this post',   'example-textdomain' ),
			'views'                 => __( 'Filter posts list',       'example-textdomain' ),
			'pagination'            => __( 'Posts list navigation',   'example-textdomain' ),
			'list'                  => __( 'Posts list',              'example-textdomain' ),

			// Labels for hierarchical post types only.
			'parent_item'        => __( 'Parent Post',                'example-textdomain' ),
			'parent_item_colon'  => __( 'Parent Post:',               'example-textdomain' ),
		)
	);

	// Register the post type.
	register_post_type( '{{ data.type_singular }}', $args );
}</code></pre>