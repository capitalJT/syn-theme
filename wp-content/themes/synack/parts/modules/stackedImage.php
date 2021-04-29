<?php
/**
 * Template Part for standard Image Gallery
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
$color = (get_sub_field('icon_and_button_color'))
            ? get_sub_field('icon_and_button_color')
            : '';
$btnClass = ($color == 'red')
            ? 'btn_red'
            : 'btn_primary';
?>
<div class="wrapper">
    <div class="box">

    	<?php if(get_sub_field('section_title')){ ?>
    	    <div class="vR vR_x2">
    	        <div class="heading">
    	            <h2 class="heading-bd">
    	                <?php echo get_sub_field('section_title'); ?>
    	            </h2>
    	            <div class="heading-ft">
    	                <div class="ruler ruler_center">
    	                    <div class="ruler-icon">
    	                        <span class="icon icon_ruler <?php if($color == 'red') echo 'mix-icon_ruler-red';?>">
    	                            <svg class="icon-inner">
    	                                <use xlink:href="#icon-ruler"></use>
    	                            </svg>
    	                        </span><!-- /.icon -->
    	                    </div><!-- /.ruler-icon -->
    	                </div><!-- /.ruler -->
    	            </div><!--/.heading-ft -->
    	        </div><!-- /.heading -->
    	    </div><!-- /.vR -->
    	<?php }

    	if(get_sub_field('column_count') == 5){
    	    if(get_sub_field('images')){ ?>
    	        <ul class="blocks blocks_md mix-blocks_median mix-blocks_2to4to5">
    	             <?php $imgs = get_sub_field('images');
    	             foreach($imgs as $img){ ?>
    		             <li><img src="<?php echo $img['sizes']['uncroppedThumbnail'];?>" alt="<?php echo $img['alt'];?>"></li>
    	             <?php } ?>
    	        </ul>
    	    <?php }
    	}else {
    		if ( get_sub_field( 'images' ) ) { ?>
				<ul class="listGrid">
					<?php $imgs = get_sub_field( 'images' );
					foreach ( $imgs as $img ) { ?>
						<li class="listGrid-item">
							<img src="<?php echo $img['sizes']['uncroppedThumbnail']; ?>" alt="<?php echo $img['alt']; ?>">
						</li>
					<?php } ?>
				</ul>
    		<?php }
    	} ?>
    </div><!-- /.box -->
</div><!-- /.wrapper -->
