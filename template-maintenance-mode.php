<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); // allow for remote-login on mapped domains ?>
</head>
<body class="maintenance-mode">
	<svg class="maintenance-mode-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 94 120"><g fill="none"><path d="M80.1 20.1L34.5 67.1 34.5 67.1 40.6 73 19.7 94.5C19.7 94.5 14 97.9 5.7 90 -2.5 82 0.8 76.2 0.8 76.2L21.6 54.7 28 60.8 73.4 14.1C72.5 10.4 74.8 7.2 74.8 7.2L85.4 1.7 91.9 8 86.5 18.4C86.5 18.4 83.6 20.6 80.1 20.1L80.1 20.1ZM28.8 69L32.6 72.6 16.8 88.8 13 85.2 28.8 69 28.8 69ZM21.6 62.6L25.4 66.3 9.7 82.5 5.9 78.8 21.6 62.6 21.6 62.6Z"/><path d="M36.3 48.9L29.5 41.9 25.7 43.2 10.5 36.2 3.9 20.7 6.5 14.3 6.5 14.3 21.7 30 35 17.2 20.4 2.1 24.9 0.5 40.1 7.5 46.7 23 43.8 30.1 43.8 30.1 49.1 35.6 36.3 48.9ZM46 58.9L77.4 91.4C80.9 95.1 86.8 95.2 90.5 91.7 94.1 88.1 94.2 82.3 90.7 78.6L58.8 45.6 46 58.9ZM84.7 87.2C86.1 85.9 86.1 83.6 84.6 82.1 83.2 80.6 80.9 80.5 79.5 81.8 78.1 83.2 78.2 85.5 79.6 86.9 81.1 88.4 83.3 88.6 84.7 87.2Z"/></g></svg>
	<h1><?php esc_html_e( 'Sorry, we\'re down for&nbsp;maintenance.', 'maintenance-mode' ); ?></h1>
	<p><?php esc_html_e( 'We\'ll be back up shortly.', 'maintenance-mode' ); ?></p>
	<?php wp_footer(); ?>
</body>
</html>
