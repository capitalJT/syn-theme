<?php
// Query posts of the same category
$related = new WP_Query(
	array(
		'category__in'   => wp_get_post_categories( $post->ID ),
		'posts_per_page' => 3,
		'post__not_in'   => array( $post->ID )
	)
);

if( $related->have_posts() ) { ?>
<div class="single-related contained">
	<h2 class="title">Related Articles</h2>
	<ul class="list">
		<?php
			while ( $related->have_posts() ) {
				$related->the_post();
				echo '<li>';
					echo '<a href="' . get_the_permalink() . '" class="related-link">';
						echo '<div class="image rsp-image-module responsive-image fit-cover">';
							echo '<div class="image-sizer" style="padding-bottom: 50%;">';
								echo the_post_thumbnail('medium');
							echo '</div>';
						echo '</div>';
						echo '<div class="text-wrap">';
							echo '<h3 class="post-title">' . get_the_title() . '</h3>';
							echo '<div class="bottom-section">';
								echo '<div class="author">' . get_the_author_meta( 'display_name', $author_id ) . '</div>';
								echo '<div class="date">' . get_the_date('d') . ' ' . get_the_date('F') . '</div>';
							echo '</div>';
						echo '</div>';
					echo '</a>';
				echo '</li>';
			}
			wp_reset_postdata();
		?>
	</ul>
</div>
<?php

}