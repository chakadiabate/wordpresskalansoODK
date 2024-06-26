<?php

if (! defined('ABSPATH') ) {
    exit; // Exit if accessed directly
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php if (! current_theme_supports('title-tag') ) : ?>
		<?php //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <title><?php echo wp_get_document_title(); ?></title>
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php
    do_action('elementor/page_templates/canvas/before_content');
	?>
    <?php //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php echo do_action('aepro_archive_data', get_the_content()); ?>
    <?php
    wp_footer();
    ?>
    </body>
</html>
