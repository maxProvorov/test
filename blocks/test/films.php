<?php
/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

?> 
<div class="wrap">
<?php 

$selected_movies = get_field( 'выберите_фильм');
$movie_id_array = [];

foreach($selected_movies as $selected_movie) {
    $movie_id_array[] = $selected_movie -> ID;
}

$args = array(
    'posts_per_page' => -1,
    'post_type' => 'films',
    'post__in'  => $movie_id_array,
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$id             = get_the_ID();
        $title             = get_field( 'заголовок', $id );
        $desc           = get_field( 'описание', $id );
        $image            = get_field( 'постер_к_фильму', $id );
        $year            = get_field( 'год_выпуска', $id );
        $country       = get_field( 'страна', $id );
        //$genres       = get_field( 'жанр', $id );
       // $genres       = get_sub_field( 'выберите_жанр', $id );
        
		?>
		
	    <div class="card">
	        <a href = "<?php echo  get_permalink($id) ?>">
                <div>
                    <div class="image">
                        <?php echo wp_get_attachment_image( $image, 'thumbnail' ); ?>
                    </div>
                    <span class="title"><?php echo esc_html( $title ); ?><br></span>
                    <span class="year"><?php echo esc_html( $year ); ?></span>
                    <div class="genres">
                    <?php
                        while( have_rows('жанр', $id) ) : the_row();
                            $sub_values = get_sub_field('выберите_жанр');
                            foreach($sub_values as $sub_value) {
                             ?><span class="genre"><?php   echo $sub_value->name;?> </span><?php
                            }
                        endwhile;
                        
                    ?>
                    </div>
                    <span class="desc"><?php echo esc_html(mb_strimwidth($desc, 0, 90, "...")); ?></span>
                </div>
            </a>
        </div>
		<?php
	}
}
else {
	
}
wp_reset_postdata();
?>
</div>
