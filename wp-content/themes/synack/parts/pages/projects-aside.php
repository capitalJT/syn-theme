<?php
/**
 * Template Part for Projects Aside
 *
 * @since 1.0
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @package WordPress
 * @subpackage Synack
 */

$meta = new SYNMeta(get_the_ID());
$authors = $meta->getMeta('authors');
$addS = '';

if($authors){
    if(count($authors) > 1) $addS = 's'; ?>
    <div class="articleInfo-primary">
        <div class="articleInfo-primary-hdg">Author<?php echo $addS;?></div>
        <?php foreach($authors as $author) { ?>
            <div class="vR vR_x2">
                <?php echo get_avatar(get_the_author_meta('email', $author));?>
                <div class="articleInfo-primary-bd"><?php echo get_the_author_meta('display_name', $author);?></div>
                <a href="<?php echo esc_url( home_url() )  . '/' . SYNACK_PROJECT_AUTHOR_ROOT_URI . '/' . $author;?>" class="articleInfo-primary-link">All Articles</a>
            </div>
        <?php }?>
    </div>
<?php }

