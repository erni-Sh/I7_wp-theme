<?php

if ( in_category(1)) {
	header("Location: /about-us#about_news");
	die();
}
// elseif ( in_category(55) ) {
// 	header("Location: /products");
// }
// elseif ( in_category(35)) {
// 	include (TEMPLATEPATH . '/category-cases.php');
// }
// elseif ( in_category(2)) {
// 	include (TEMPLATEPATH . '/category-events.php');
// }
// else {
	// include (TEMPLATEPATH . '/404.php');
// 	wp_redirect( home_url( '/404' ) );
// }

?>