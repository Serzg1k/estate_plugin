<?php

function estate_posts_where( $where ) {

    $where = str_replace("meta_key = 'real_estate_roms_$", "meta_key LIKE 'real_estate_roms_%", $where);

    return $where;
}

function estate_pagenavi( $the_query = false, $pagination_number = false ) {

    if ($the_query) {
        $wp_query = $the_query;
    } else {
        global $wp_query;
    }

    if (!$pagination_number) {
        $pagination_number = 1;
    }

    $big = 999999999;

    $args = array(
        'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'mid_size' => 6,
        'end_size' => 0,
        'prev_next'    => true,
        'prev_text'    => __('<'),
        'next_text'    => __('>'),
        'current' => $pagination_number,
        'total'   => $wp_query->max_num_pages,

    );

    $result = paginate_links( $args );

    if ($result) {
        return $result;
    }
}

add_filter('posts_where', 'estate_posts_where');

add_action('wp_ajax_nopriv_estate_filter', 'estate_filter');
add_action('wp_ajax_estate_filter', 'estate_filter');

function estate_filter(){
    check_ajax_referer( 'estate-nonce', 'nonce' );
    $build_name = isset($_POST['build_name'])?$_POST['build_name']:false;
    $coordinates = isset($_POST['coordinates'])?$_POST['coordinates']:false;
    $floors = isset($_POST['floors'])?$_POST['floors']:false;
    $type = isset($_POST['type'])?$_POST['type']:false;
    $rooms = isset($_POST['rooms'])?$_POST['rooms']:false;
    $balcony = isset($_POST['balcony'])?$_POST['balcony']:false;
    $wc = isset($_POST['wc'])?$_POST['wc']:false;
    $paged = isset($_POST['paged'])?$_POST['paged']:1;

    $args = [
        'post_type' => 'real_estate',
        'posts_per_page' => 1,
        'paged' => $paged,
        'meta_query' => [
            'relation' => 'AND',
        ]
    ];
    $paginate_args = ['paged' => $paged];
    if($build_name){
        $args['meta_query'][] =   [
            'key'	 	=> 'real_estate_name',
            'value'	  	=> $build_name,
            'compare' 	=> '=',
        ];
        $paginate_args['real_estate_name'] = $build_name;
    }
    if($coordinates){
        $args['meta_query'][] =   [
            'key'	 	=> 'real_estate_coordinates',
            'value'	  	=> $coordinates,
            'compare' 	=> '=',
        ];
        $paginate_args['real_estate_coordinates'] = $coordinates;
    }
    if($floors){
        $args['meta_query'][] =   [
            'key'	 	=> 'real_estate_floors',
            'value'	  	=> $floors,
            'compare' 	=> '=',
        ];
        $paginate_args['real_estate_floors'] = $floors;
    }
    if($type){
        $args['meta_query'][] =   [
            'key'	 	=> 'real_type_of_building',
            'value'	  	=> $type,
            'compare' 	=> '=',
        ];
        $paginate_args['type'] = $type;
    }
    if($rooms){
        $args['meta_query'][] =   [
            'key'	 	=> 'real_estate_roms_$_count_rooms',
            'value'	  	=> $rooms,
            'compare' 	=> '=',
        ];
        $paginate_args['rooms'] = $rooms;
    }
    if($balcony){
        $args['meta_query'][] =   [
            'key'	 	=> 'real_estate_roms_$_balcony',
            'value'	  	=> $balcony,
            'compare' 	=> '=',
        ];
        $paginate_args['balcony'] = $balcony;
    }
    if($wc){
        $args['meta_query'][] =   [
            'key'	 	=> 'real_estate_roms_$_wc',
            'value'	  	=> $wc,
            'compare' 	=> '=',
        ];
        $paginate_args['wc'] = $wc;
    }
    ob_start();
    $query = new WP_Query($args);
    if($query->have_posts()){
        while ( $query->have_posts() ) {
            $query->the_post(); ?>
            <article>
                <a href="<?= get_the_permalink() ?>" class="title"><?= get_the_title() ?></a>
            </article>
        <?php } ?>
            <div class="estate-paginate" data-query='<?= json_encode($paginate_args)?>'><?= estate_pagenavi($query, $paged) ?></div>
<?php }
    $html = ob_get_clean();
    wp_send_json_success($html);

}