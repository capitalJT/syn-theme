<?php
/**
 * Template Part for comments
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
$args = array(
    'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment *', 'noun' ) .
        '</label><textarea id="comment" data-validation-type="required" data-validation-message="This is a required field" name="comment" cols="45" rows="8" aria-required="true">' .
        '</textarea></p>',
    'fields' =>  array(

        'author' =>
            '<p class="comment-form-author"><label for="author">' . __( 'Name *', 'synack' ) . '</label> ' .
            '<input id="author" name="author" data-validation-type="required" data-validation-message="This is a required field" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30" aria-required="true" /></p>',

        'email' =>
            '<p class="comment-form-email"><label for="email">' . __( 'Email *', 'synack' ) . '</label> ' .
            '<input id="email" name="email" data-validation-type="required" data-validation-message="This is a required field" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30" aria-required="true" /></p>',

        'url' =>
            '<p class="comment-form-url"><label for="url">' . __( 'Website', 'synack' ) . '</label>' .
            '<input id="url" name="url"  type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
            '" size="30" /></p>',
    )
);

?>
<div class="wrapper mix-wrapper_contain">
    <div class="wrapper">
        <div id="comments" class="commentsWrapper">

            <?php if ( post_password_required() ) { ?>
                <p>This post is password protected. Enter the password to view any comments</p>
        </div>

            <?php
                    /* Stop the rest of comments.php from being processed,
                     * but don't kill the script entirely -- we still have
                     * to fully load the template.
                     */
                    return;
                } //End if password protected
            ?>


            <?php if ( have_comments() ) { ?>

                <ol>
                    <?php wp_list_comments( ); ?>
                </ol>

            <?php
                /* If there are no comments and comments are closed, let's leave a little note, shall we?
                 * But we don't want the note on pages or post types that do not support comments.
                 */
            }elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) {
            ?>

                <p>Comments are closed</p>

            <?php } ?>

            <div class="commentForm js-validationView">
                <?php comment_form($args); ?>
            </div>

        </div><!-- #comments -->
    </div>
</div>
