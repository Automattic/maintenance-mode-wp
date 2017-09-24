<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); // allow for remote-login on mapped domains ?>
</head>
<body class="maintenance-mode">
	<h1><?php esc_html_e( 'Sorry, we\'re down for&nbsp;maintenance.', 'maintenance-mode' ); ?></h1>
	<p><?php esc_html_e( 'We\'ll be back up shortly.', 'maintenance-mode' ); ?></p>
	<?php wp_footer(); ?>
</body>
</html>
