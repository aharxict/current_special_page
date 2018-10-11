<?php


class Special
{
    private $post_type = 'special';

    public function __construct()
    {
        add_action('init', array($this, 'register_special_type'));
	    add_filter( 'template_include', array($this, 'cs_show_frontend_template'), 99 );
	    add_filter( 'template_include', array($this, 'echo_cur_tplfile'), 99 );


//        add_action('add_meta_boxes', array($this, 'add_extra_fields_issues'), 1);
//        add_action('save_post_issue', array($this, 'save_extra_fields_issues'), 0);
//        add_action( 'admin_print_footer_scripts', array( $this, 'show_assets' ), 10, 999 );
    }
    public function register_special_type()
    {
        register_post_type($this->post_type, array(
            'label'  => null,
            'labels' => array(
                'name'               => 'All Specials', // основное название для типа записи
                'singular_name'      => 'Special', // название для одной записи этого типа
                'add_new'            => 'Add Special', // для добавления новой записи
                'add_new_item'       => 'Add new Special', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item'          => 'Edit Special', // для редактирования типа записи
                'new_item'           => 'New ', // текст новой записи
                'view_item'          => 'View Special', // для просмотра записи этого типа.
                'search_items'       => 'Search Specials', // для поиска по этим типам записи
                'not_found'          => 'Not found', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Not found in trash', // если не было найдено в корзине
                'parent_item_colon'  => '', // для родителей (у древовидных типов)
                'menu_name'          => 'Specials', // название меню
            ),
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => null, // зависит от public
            'exclude_from_search' => null, // зависит от public
            'show_ui'             => null, // зависит от public
            'show_in_menu'        => null, // показывать ли в меню адмнки
            'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
            'show_in_nav_menus'   => null, // зависит от public
            'show_in_rest'        => null, // добавить в REST API. C WP 4.7
            'rest_base'           => null, // $post_type. C WP 4.7
            'menu_position'       => 05,
            'menu_icon'           => 'dashicons-media-document',
            'capability_type'   => 'post',
            //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
            //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
            'hierarchical'        => false,
            'supports'            => array('title','thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies'          => array('section'),
            'has_archive'         => true,
            'rewrite' => array(
                'slug'       => 'sale'
            ),
            'query_var'           => true,
        ) );
    }
	public function cs_show_frontend_template( $template ) {
//		if( is_page($post_type)  ){
//			if ( $new_template = locate_template( array( dirname( __FILE__ ) . '/frontend/template.php' ) ) )
//				$template = $new_template ;
//		}
		// Post ID
		$post_id = get_the_ID();
//		echo '<span class="template-name" style=" color: green; position: fixed; top: 60%; left: 10%; z-index: 9999; font-weight: 900; background-color: #fff; ">'.
//		     wp_basename( $template ) . ' --- ' . get_post_type( $post_id ) . ' --- '
//		     .'</span>';

		// For all other CPT
		if ( get_post_type( $post_id ) != $this->post_type ) {

			return $template;
		} else {
			if (is_post_type_archive($this->post_type) ) {
			$cs_template = dirname( __FILE__ ) . '/frontend/archive-special.php';
			} else {
			$cs_template = dirname( __FILE__ ) . '/frontend/single-special.php';
			}
			//var_dump($cs_template);
			return $cs_template;
		}
	}


	public function echo_cur_tplfile( $template ){
		//echo '<span class="template-name" style=" color: red; position: fixed; top: 30%; left: 10%; z-index: 9999; font-weight: 900; background-color: #fff; ">'. wp_basename( $template ) .'</span>';
		return $template;
	}
}