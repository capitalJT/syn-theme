<?php
    $quotation = get_sub_field('quotation');
    $quote_author = get_sub_field('quote_author');
    $quote_cite = get_sub_field('quote_cite');

    $quote_author_image = get_sub_field('quote_author_image');
    $quote_author_image_url = $quote_author_image['url'];
    $quote_author_image_alt = $quote_author_image['alt'];

    // Thumbnail size attributes.
    $quote_author_image_size = 'thumbnail'; // (thumbnail, medium, large, or custom size)
    $quote_author_image_thumb = $quote_author_image['sizes'][ $quote_author_image_size ];
?>

<div class="module-quote p-y-md">
    <div class="synack-container">
        <div class="row">
            <div class="span12">
                <blockquote class="text-align-center p-x-lg">
                    <div class="b-quote m-b-sm">
                        <?php echo $quotation; ?>
                    </div>

                    <?php if ($quote_author_image): ?>
                        <div class="d-block">
                            <img class="quote-author-img rounded-circle d-block m-x-auto m-b-sm" src="<?php echo esc_url($quote_author_image_thumb); ?>" alt="<?php echo esc_attr($quote_author_image_alt); ?>" />
                        </div>
                    <?php endif;?>

                    <footer class="h5 text-uppercase">
                        <?php echo $quote_author; ?><br>
                        <cite><?php echo $quote_cite; ?></cite>
                    </footer>
                </blockquote>
            </div>
        </div>

    </div>
</div>

