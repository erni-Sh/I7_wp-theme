<?php

function mythem_enqueue_style() {
  wp_enqueue_style( 'main_css', get_template_directory_uri() . '/css/styles.min.css');
  // wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');  
};

function my_scripts(){
  // wp_deregister_script( 'jquery' );
  wp_enqueue_script('main_js' , get_template_directory_uri() . '/js/custom.js', array(), '', true);
  // wp_enqueue_script('imbaChat' , 'https://api.imbachat.com/imbachat/v1/6024/widget', array(), '', true);
};

add_action( 'wp_enqueue_scripts', 'mythem_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'my_scripts' );

add_theme_support( 'post-thumbnails' ); 
// setlocale(LC_ALL, "ru_RU" ); не корректно работает
// ---------------------------------------------------------------

// Включение SVG https://wp-kama.ru/id_13214/kak-zagruzit-svg.html
// add plugin safe SVG

// # Добавляет SVG в список разрешенных для загрузки файлов.
// add_filter( 'upload_mimes', 'svg_upload_allow' );
// function svg_upload_allow( $mimes ) {
//   $mimes['svg']  = 'image/svg+xml';
//   return $mimes;
// };

// # Исправление MIME типа для SVG файлов.
// add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
// function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){
//   // WP 5.1 +
//   if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
// 	$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
//   else
// 	$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

//   // mime тип был обнулен, поправим его
//   // а также проверим право пользователя
//   if( $dosvg ){
// 	// разрешим
// 	if( current_user_can('manage_options') ){
// 	  $data['ext']  = 'svg';
// 	  $data['type'] = 'image/svg+xml';
// 	}
// 	// запретим
// 	else {
// 	  $data['ext'] = $type_and_ext['type'] = false;
// 	}
//   }
//   return $data;
// }

// --------------------------------------------------------------



// получение самой родительской категории
if ( ! function_exists( 'get_top_term' ) ) {
  function get_top_term( $taxonomy, $post_id = 0 ) {
	if( isset($post_id->ID) ) $post_id = $post_id->ID;
	if( ! $post_id )          $post_id = get_the_ID();

	$terms = get_the_terms( $post_id, $taxonomy );

	if( ! $terms || is_wp_error($terms) ) return $terms;

	// только первый
	$term = array_shift( $terms );

	// найдем ТОП
	$parent_id = $term->parent;
	while( $parent_id ){
	  $term = get_term_by( 'id', $parent_id, $term->taxonomy );
	  $parent_id = $term->parent;
	}

	return $term;
  }
}

// Изменение длины отрывка статьи
add_filter( 'excerpt_length', function(){
	return 11;
} );
add_filter('excerpt_more', function($more) {
	return ' ...';
});

// для пустой цены выводить "цена по запросу"

/* ---------- оторажение доллара и рубля ----- */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {

  switch( $currency ) {
	case 'USD': $currency_symbol = '$'; break;
	case 'RUB': $currency_symbol = 'руб.'; break;
  }
  return $currency_symbol;
  
}

// Подгрузка постов
if ( ! function_exists( 'get_max_pages_on_category' ) ) {
  function get_max_pages_on_category($category, $post_on_page, $tag = null) {
	$wp_query = new WP_Query( array(
	  'cat'=> $category,
	  'tag' => $tag,
	));
	$countcat = $wp_query->found_posts;

	return ceil($countcat / $post_on_page);
  }
}

add_action('wp_ajax_get_new_cards', 'get_new_cards');
add_action('wp_ajax_nopriv_get_new_cards', 'get_new_cards');
// ПОДГРУЗКА ПОСТОВ И ТОВАРОВ AJAX

if ( ! function_exists( 'get_new_cards' ) ) {
  function get_new_cards($category = null, $tag = null, $s = null) {

	if (isset($_POST["paged"])) {
	  $paged = $_POST["paged"];
	  $category = $_POST["category"];
	  $s = $_POST["search"]; 
	  $tag = $_POST["tag"];
	  $styles = "style='display: none'";
	} else {
	  $paged = 1;
	};

	if(is_numeric($category)) :
		// $order = 'DESC';

	  // Категория записей
	  if ($category == 1) {
			$template = 'elements/template_about-us-news';
			$post_on_page = 4;
			// $order = 'ASC';
	  };
		  
	  $hi_term = get_ancestors( $category, 'category' );
	  if ($hi_term[0] == 32) {
			$template = 'elements/template_support-inside-card';
			$post_on_page = 3;
	  };

	  $arg = array(
			'category'=> $category,
			's' => $s,
			// 'orderby' => 'term_order',
			'numberposts' => $post_on_page,
			'paged' => $paged,
			'tag' => $tag,
	  );
	  
	else :
	  // Категория товара
	  $template = 'elements/template_product_card';

	  $arg = array(
			'product_cat' => $category,
			'post_type' => 'product', 
			'posts_per_page' => 10,
			'paged' => $paged,
			'orderby' => 'ID', 
			'order' => 'ASC',
			's' => $s,
			'relevanssi' => true,
			// 'type_aws'=> 'true'
	  );
	endif;

	global $wp_query;
	global $post;

	$posts = get_posts($arg);

	if ($posts) :

	  echo "<div class='paged' data-page=" . $paged . " " . $styles . "><div class='row'>";
	  foreach ($posts as $post) :
		setup_postdata($post);

		set_query_var( 'post', $post );
		get_template_part($template);
		  
	  endforeach;
	  echo "</div></div>";
	  
	endif;

  }
}

add_action('wp_ajax_ajaxSearch', 'ajaxSearch');
add_action('wp_ajax_nopriv_ajaxSearch', 'ajaxSearch');
if ( ! function_exists( 'ajaxSearch' ) ) {
	function ajaxSearch() {
		if (isset($_POST["s"])) {
		  $s = $_POST["s"];
		};

	  $arg = array(
			'product_cat' => 55,
			'post_type' => 'product', 
			'posts_per_page' => 7,
			'orderby' => 'ID', 
			'order' => 'ASC',
			's' => '"' . $s . '"',
			'relevanssi' => true,
	  );
		
		global $wp_query;
		global $post;

		$posts = get_posts($arg);
		if ($posts) :

		  foreach ($posts as $post) :
			setup_postdata($post);
			$link = get_the_permalink();
			// $title = $post->post_title;

			$title = get_post_meta( $post->ID, '_sku', true);

			$keys = $s;
			// explode(" ",$s);  
			// $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search_expt">\0</strong>', $title);  
			$title = str_replace($keys, '<strong class="search_expt">' . $keys . '</strong>', $title);
			// echo implode('|', $keys);
			echo '<li><a href="' . $link . '">' . $title . '</a></li>';
			  
		  endforeach;		  
		endif;

	}
};

add_action('wp_ajax_render_brand_r_content', 'render_brand_r_content');
add_action('wp_ajax_nopriv_render_brand_r_content', 'render_brand_r_content');
if ( ! function_exists( 'render_brand_r_content' ) ) {
	function render_brand_r_content($brand_slug = null) {

		if (isset($_POST["category"])) {
		  $brand_slug = $_POST["category"];
		};
		// echo $brand_slug;
		// if($brand_slug) :
			$product_cat_1lev = get_terms('product_cat', 'parent=55&orderby=ID&hide_empty=0');
			if($product_cat_1lev) :
			foreach ($product_cat_1lev as $cat_1lev) :

			echo "<div class='row products-2-lev'>";
			get_new_WC_cards($cat_1lev->term_id, 'product_23lev_card', $brand_slug);
			echo "</div>";

			endforeach;
			endif;
		// endif;
	}
};

// Показ карточек категорий
add_action('wp_ajax_get_new_WC_cards', 'get_new_WC_cards');
add_action('wp_ajax_nopriv_get_new_WC_cards', 'get_new_WC_cards');
if ( ! function_exists( 'get_new_WC_cards' ) ) {
  function get_new_WC_cards($category = null, $template = null, $brand_slug = null) {
		$need_render = true;

		$cards = get_terms( array(
		  'taxonomy' => 'product_cat',
		  'parent' => $category,
		  'orderby' => 'term_order',
		  'hide_empty' => 0
		));

		if($cards) :
		  foreach ($cards as $card_data) :

			//- Проверка на принадлежность бренду этой категории товаров
		  if($brand_slug) {
		  	$need_render = false;

				$posts = get_posts(array(
					'product_cat' => $card_data->slug,
					'post_type' => 'product', 
					'posts_per_page' => 500, // должно быть -1
				));

				foreach ($posts as $post) :		
					$has_this_brand = has_term($brand_slug, 'product_cat', $post->ID);
					if($has_this_brand) break;
				endforeach;

		  	if($has_this_brand) $need_render = true;
		  }

		  if($need_render) {
		  	set_query_var( 'card_data', $card_data );
				get_template_part('elements/template_' . $template);
		  }

		  endforeach;
		endif;
  }
};

// Оптимизировать все это дело?))
add_action('wp_ajax_showSolutionInsideCard', 'showSolutionInsideCard');
add_action('wp_ajax_nopriv_showSolutionInsideCard', 'showSolutionInsideCard');
if ( ! function_exists( 'showSolutionInsideCard' ) ) {
	function showSolutionInsideCard($solution_cat = null, $product_cat = null) {
		// if(!$solution_cat) break;
		if(!$product_cat) $product_cat = 55;
		if (isset($_POST["category"])) {
		  $solution_cat = $_POST["category"];

		  // $styles = "style='display: none'";
		};

		// рекусрсия по всем категориям
		$cards = get_terms( array(
		  'taxonomy' => 'product_cat',
		  'parent' => $product_cat,
		  'orderby' => 'term_order',
		  'hide_empty' => 0
		));

		if($cards) :
		  foreach ($cards as $card_data) :
				// Стоит ли галочка у текущей категории Продуктов
				$isVisible = get_field('is-visible-on-solutions', "product_cat_" . $card_data->term_id);

				if($isVisible) :

					// global $wp_query;
					// global $post;
					//- Проверка на принадлежность Решения 2-му уровню категорий Продукции
				 	$posts = get_posts(array(
						'product_cat' => $card_data->slug,
						'post_type' => 'product',
						'posts_per_page' => 2000, // должно быть -1. По Ajax не работает
				 	));

				 	if(!$posts) break;
					//- если есть хотя бы один товар
					foreach ($posts as $post) :
						// print_r($post->post_title);
						// echo '<br>';
						$has_this_solution = has_term( $solution_cat, 'product_cat', $post);
						if($has_this_solution) break;
				 	endforeach;

					if($has_this_solution):
						set_query_var( 'card_data', $card_data );
						set_query_var( 'solution_cat', $solution_cat );						
						get_template_part('elements/template_solution_inside_card');
					endif;
					// break; // если отобразили верхний уровень - вниз не идем
				else :
					// если не нашли - спускаем на уровень ниже
					showSolutionInsideCard($solution_cat, $card_data->term_id);

				endif;

		  endforeach;
		endif;
	};
};

// Повтор логики с showSolutionInsideCard- оптимизировать
function showSolutionInsideCardList($solution_cat = null, $product_cat = null) {
	$cards = get_terms( array(
	  'taxonomy' => 'product_cat',
	  'parent' => $product_cat,
	  'orderby' => 'term_order',
	  'hide_empty' => 0
	));

	if($cards) :
	  foreach ($cards as $card_data) :
			// echo $card_data->name . '<br>';
			// Стоит ли галочка у текущей категории Продуктов
			$isVisible = get_field('is-visible-on-solutions', "product_cat_" . $card_data->term_id);
			if($isVisible) :

			 	$posts = get_posts(array(
					'product_cat' => $card_data->slug,
					'post_type' => 'product', 
					'posts_per_page' => -1,
			 	));

				//- если есть хотя бы один товар
				foreach ($posts as $post) :
					$has_this_solution = has_term( $solution_cat, 'product_cat', $post);
					if($has_this_solution) break;
			 	endforeach;

				if($has_this_solution): ?>
					<li>
						<a href='<?php echo "/products#" . $card_data->slug; ?>'> <?php echo $card_data->name; ?></a>
					</li>

				<?php endif;

			endif;

		showSolutionInsideCardList($solution_cat, $card_data->term_id);

	  endforeach;
	endif;
}



// Вывод меню dropDown
if ( ! function_exists( 'renderMenuDropDown' ) ) {
  function renderMenuDropDown($page="Продукция", $category=null) {
	set_query_var( 'card_data', $page );
	set_query_var( 'card_data', $category );
	get_template_part('elements/template_menu-dropdown');
  }
}

// ОТПРАВКА ПИСЬМА
add_action('wp_ajax_send_mail', 'send_mail');
add_action('wp_ajax_nopriv_send_mail', 'send_mail');
if ( ! function_exists( 'send_mail' ) ) {
  function send_mail() {
	function cleanupentries($entry) {
		$entry = trim($entry);
		$entry = stripslashes($entry);
		$entry = htmlspecialchars($entry);

		return $entry;
	}

	$to = "info@iseven.ru";
	// $to = "ernest22@mail.ru";
	$f_name = cleanupentries($_POST["name"]);
	$f_email = cleanupentries($_POST["email"]);

	$from = "iseven@iseven.ru";
	$subject = " {$f_name}"; //cleanupentries($_POST["subject"]);
	$f_message = cleanupentries($_POST["message"]);
	/* $headers = "From: $from"; */
	$headers = "From: " . $from . "\r\n" .
	"Reply-To: " . $f_email . "\r\n" .
	"X-Mailer: PHP/" . phpversion();

	$from_ip = $_SERVER['REMOTE_ADDR'];
	$from_browser = $_SERVER['HTTP_USER_AGENT'];

	$semi_rand = md5(time());
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

	$n_message = "Это сообщение было создано " . date('d.m.Y') . 
	"\nИмя: " . $f_name . 
	"\nE-Mail: " . $f_email . 
	"\n\nТекст сообщения: \n-------------------------\n\n" . $f_message . "\n\n-------------------------" .
	"\nTechnical Details:\n" . $from_ip . "\n" . $from_browser;

	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed; charset=utf-8;\n" . " boundary=\"{$mime_boundary}\"";
	$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Transfer-Encoding: 7bit\n\n" . $n_message . "\n\n";
	$message .= "--{$mime_boundary}\n";
	
	// $subject = iconv('utf-8', 'windows-1251', $subject);
	// $message = iconv('utf-8', 'windows-1251', $message);


	$sented = 'Сообщение успешно отправлено!';
	$notsent = 'сервер не может отправить сообщение...';

	$needfile = '';

	$ok = mail($to, $subject, $message, $headers);
	if ($ok) {
		echo $sented;
	} else {
		echo $notsent;
	}
	wp_die('');
  }
}


// AJAX ADD TO CART
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
function woocommerce_ajax_add_to_cart() {
  $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
  $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
  $variation_id = absint($_POST['variation_id']);
  $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
  $product_status = get_post_status($product_id);

  if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

	do_action('woocommerce_ajax_added_to_cart', $product_id);

	if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
		echo wc_add_to_cart_message(array($product_id => $quantity), true);
	};

	// WC_AJAX :: get_refreshed_fragments();
	$product_name = wc_get_product($product_id)->get_title();

	$data = array(
	  'message' => '<a href="/cart">"' . $product_name . '" в корзине!</a>',
	  'cart_count' => WC()->cart->get_cart_contents_count(),
	);

  } else {
	$data = array(
	  'error' => true,
	  'message' => 'что-то пошло не так, попробуйте еще раз',
	);
  }
  echo wp_send_json($data);
  wp_die();
}


// AJAX ORDER

add_action('wp_ajax_ajax_order', 'submited_ajax_order_data');
add_action( 'wp_ajax_nopriv_ajax_order', 'submited_ajax_order_data' );
function submited_ajax_order_data() {
	if( isset($_POST['fields']) && ! empty($_POST['fields']) ) {

		$order    = new WC_Order();
		$cart     = WC()->cart;
		$checkout = WC()->checkout;
		$data     = [];

		// Loop through posted data array transmitted via jQuery
		foreach( $_POST['fields'] as $values ){
			// Set each key / value pairs in an array
			$data[$values['name']] = $values['value'];
		}

		$cart_hash          = md5( json_encode( wc_clean( $cart->get_cart_for_session() ) ) . $cart->total );
		$available_gateways = WC()->payment_gateways->get_available_payment_gateways();

		// Loop through the data array
		foreach ( $data as $key => $value ) {
			// Use WC_Order setter methods if they exist
			if ( is_callable( array( $order, "set_{$key}" ) ) ) {
				$order->{"set_{$key}"}( $value );

			// Store custom fields prefixed with wither shipping_ or billing_
			} elseif ( ( 0 === stripos( $key, 'billing_' ) || 0 === stripos( $key, 'shipping_' ) )
				&& ! in_array( $key, array( 'shipping_method', 'shipping_total', 'shipping_tax' ) ) ) {
				$order->update_meta_data( '_' . $key, $value );
			}
		}

		$order->set_created_via( 'checkout' );
		$order->set_cart_hash( $cart_hash );
		$order->set_customer_id( apply_filters( 'woocommerce_checkout_customer_id', isset($_POST['user_id']) ? $_POST['user_id'] : '' ) );
		$order->set_currency( get_woocommerce_currency() );
		$order->set_prices_include_tax( 'yes' === get_option( 'woocommerce_prices_include_tax' ) );
		$order->set_customer_ip_address( WC_Geolocation::get_ip_address() );
		$order->set_customer_user_agent( wc_get_user_agent() );
		$order->set_customer_note( isset( $data['order_comments'] ) ? $data['order_comments'] : '' );
		$order->set_payment_method( isset( $available_gateways[ $data['payment_method'] ] ) ? $available_gateways[ $data['payment_method'] ]  : $data['payment_method'] );
		$order->set_shipping_total( $cart->get_shipping_total() );
		$order->set_discount_total( $cart->get_discount_total() );
		$order->set_discount_tax( $cart->get_discount_tax() );
		$order->set_cart_tax( $cart->get_cart_contents_tax() + $cart->get_fee_tax() );
		$order->set_shipping_tax( $cart->get_shipping_tax() );
		$order->set_total( $cart->get_total( 'edit' ) );
		
		$order->set_status('on-hold');

		$checkout->create_order_line_items( $order, $cart );
		$checkout->create_order_fee_lines( $order, $cart );
		$checkout->create_order_shipping_lines( $order, WC()->session->get( 'chosen_shipping_methods' ), WC()->shipping->get_packages() );
		$checkout->create_order_tax_lines( $order, $cart );
		$checkout->create_order_coupon_lines( $order, $cart );

		/**
		 * Action hook to adjust order before save.
		 * @since 3.0.0
		 */
		do_action( 'woocommerce_checkout_create_order', $order, $data );

		// Save the order.
		$order_id = $order->save();

		do_action( 'woocommerce_checkout_update_order_meta', $order_id, $data );

		echo 'Ваш заказ №'.$order_id.' принят!';

		WC()->cart->empty_cart();
	}
	die();
}


// AJAX for SEARCH 
// add_filter( 'aws_js_seamless_selectors', 'my_aws_js_seamless_selectors' );
// function my_aws_js_seamless_selectors( $selectors ) {
//     $selectors[] = '.products-4-lev_search .aws-container';
//     return $selectors;
// }


?>