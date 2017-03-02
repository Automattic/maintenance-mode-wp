<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); // allow for remote-login on mapped domains ?>
</head>
<body>
	<h1><?php esc_html_e( 'Howdy!', 'maintenance-mode' ); ?></h1>
	<p><?php esc_html_e( 'We\'re just freshening things up a bit; back in a few!', 'maintenance-mode' ); ?></p>
	<?php wp_footer(); ?>
</body>
</html>
