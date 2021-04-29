<?php
/**
 * Template Part for events
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

//if we don't have a limit set, then default to 3
$eventLimit = (get_sub_field('maximum_events'))
    ? get_sub_field('maximum_events')
    : 3;

$args = array(
   'post_type'   => 'synack-events',
   'post_status' => 'publish',
   'posts_per_page' => $eventLimit,
   'meta_key'       => 'event_start_date',
   'orderby'        => 'meta_value_num',
   'order'          => 'ASC',
   'meta_query'        => array(
           'relation' => 'OR',
           array(
               'key'        =>  'event_start_date',
               'compare'    =>  '>=',
               'value'      =>  current_time('Ymd'),
           ),
           array(
               'relation' => 'AND',
               array(
                   'key'     => 'event_end_date',
                   'value'   => current_time('Ymd'),
                   'type'    => 'NUMERIC',
                   'compare' => '>='
               ),
               array(
                   'key'     => 'event_start_date',
                   'value'   => current_time('Ymd'),
                   'type'    => 'NUMERIC',
                   'compare' => '<='
               )
           )
   ),
   'tax_query' => array(
       array(
           'taxonomy'         => 'featured-event',
           'field'            => 'id',
           'terms'            => get_sub_field('event_category')
       )
   ),
);

$query = new WP_Query( $args );
if($query->have_posts()) { ?>

    <div class="wrapper">
        <div class="grid">
            <div class="grid-col mix-grid-col_10to8 mix-grid-col_prefix1of10Lg mix-grid-col_suffix1of10Lg">
                <div class="box">
                    <div class="vR vR_x2">
                        <div class="headingMarquee">
                            <?php if(get_sub_field('section_title')){ ?>
                                <div class="headingMarquee-hd"><?php echo get_sub_field('section_title');?></div>
                            <?php } ?>
                            <?php if(get_sub_field('subtext')){ ?>
                                <div class="headingMarquee-bd">
                                    <?php echo get_sub_field('subtext');?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <ul class="listV listV_divided mix-listV_spaceLg ">
                        <?php while($query->have_posts()){
                            $query->the_post();
                            $meta = new SYNMeta(get_the_ID());?>
                            <li itemscope itemtype="http://schema.org/Event">
                                <div class="mediaFixed">

                                    <?php if($meta->getMeta('event_start_date')){
                                            $startDate = DateTime::createFromFormat('Ymd', $meta->getMeta('event_start_date')); ?>
                                        <div class="mediaFixed-md">
                                            <div class="date" itemprop="startDate" content="<?php echo $startDate->format('c'); ?>">
                                                <div class="date-hd-blue">
                                                    <?php echo $startDate->format('d'); ?>
                                                </div>
                                                <div class="date-meta">
                                                    <?php echo $startDate->format('M'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>

                                    <div class="mediaFixed-bd">
                                        <h3 class="hdg hdg_2" itemprop="name"><?php the_title();?></h3>
                                        <div class="wysiwyg wysiwyg_lite" itemprop="description">
                                            <?php the_content();?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php }
                        wp_reset_postdata(); ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
<?php }
