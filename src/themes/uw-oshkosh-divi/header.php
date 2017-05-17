<?php if ( ! isset( $_SESSION ) ) session_start(); ?>
<!DOCTYPE html>
<!--
,   `,  ,    ,  `, ,    `: ,,,,,  ,,,`   `++.  , .,,,,,`,,    ,
#   ,'  ##   +` .+ #,   #, #::::  #.,## `#``#  # .::#::` #   #,
#   ,'  ##,  #` .+ `#   #  #      #   # ';     #    #    ,# ,#    +### ###.
#   ,'  # #  #` .+  #  ,+  #      #  ,# `#.    #    #     #,#     #  +.#
#   ,'  # ,# #` .+  '; #   #####  ###'   .##+  #    #      #,    ,;  ,;###
#   ,'  #  #,#` .+   # #   #      # ;+      #  #    #      #      #  # #
#   #.  #   #+` .+   #',   #      #  #`     #  #    #      #      `##. #
,#+#+   #   .#` .+   .#    #####  #  `# '#+#+  #    #      #


;    ;,   `; ,;   :##;     '##;     '##;     ;,    ::   ;##:   ;  `;     ;`
#    ##   ++ :#  +#.,#.  .#+.,##  `##..##    ##    +'  ##.:#`  #  .##    #.
#;  :+#   #` :#  #       #,       #,    :#   #+#   +'  #       #  .##'   #.
.#  #.#.  #  :#  #:     '#       ;#      #:  # #,  +'  #.      #  .# #   #.
#  # ,# :#  :#  ,##;   #'       #'      ++  # `#  +'  '##:    #  .# ;#  #.
#..#  # #,  :#    ;##` #'       #+      ++  #  +# +'    '##   #  .#  #' #.
;+#:  # #   :#      #+ ;#       :#      #,  #   #:++      #;  #  .#   # #.
##   '+#   :#  `   #+  #,    :  #;    '#   #    #''  `   #;  #  .#   :##.
##    #'   :#  ##:+#    ##:;##   ##::##    #    '#' `#+:##   #  .#    ##.
,,    ,    .,   '#'      :++.     :++,     ,     ,,   '#;    ,  `,     ,`


`:+#######################+';:,.`                                     .',
;######+';:,,....,,:;'+#########################++';:,,..`````.,,:'+###+,
.#+:`                                 `.,:;'++######################':.
.

`.          .`                              ``         ``
+#####:     #####.  +#     '#   #'    ##   .######     '#####   #      #.
##,   '#+   ##   #   +#     '#   #'   ##   ,##   `##   `#:  ::   #      #.
+#      :#`  #,       +#     '#   #'  ##    #+      ##  +#        #      #.
#+       ##  #+       +#     '#   #' ##    ;#       .#  ;#        #      #.
#`       +#  +##:     +#+++++##   #+##     ##        #,  ##+`     #++++++#.
#        '#   ,####   +########   #'##     ##        #:   ####`   ########.
#.       ##      +#'  +#     '#   #' ##    ##        #.     .##   #      #.
##       #+       ##  +#     '#   #'  ##   .#       '#       `#   #      #.
.#;     ##   `    ##  +#     '#   #'  `##   ##     `#'   `   ,#   #      #.
'##,.;##`  .##,.##   +#     '#   #'   .##   ##'.,###   ##'.'##   #      #.
####+     .####    ##     '#   #+    ,##   ;####.     +###'    #      #.

-->
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?></title>
	<?php elegant_description(); ?>
	<?php elegant_keywords(); ?>
	<?php elegant_canonical(); ?>

	<?php do_action( 'et_head_meta' ); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( $template_directory_uri . '/js/html5.js"' ); ?>" type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript">
	document.documentElement.className = 'js';
	</script>

	<!-- Google Analytics Code -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-6634319-1', 'auto');
	ga('send', 'pageview');

	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page-container">
		<?php
		if ( is_page_template( 'page-template-blank.php' ) ) {
			return;
		}

		$et_secondary_nav_items = et_divi_get_top_nav_items();

		$et_phone_number = $et_secondary_nav_items->phone_number;

		$et_email = $et_secondary_nav_items->email;

		$et_contact_info_defined = $et_secondary_nav_items->contact_info_defined;

		$show_header_social_icons = $et_secondary_nav_items->show_header_social_icons;

		$et_secondary_nav = $et_secondary_nav_items->secondary_nav;

		$primary_nav_class = 'et_nav_text_color_' . et_get_option( 'primary_nav_text_color', 'dark' );

		$secondary_nav_class = 'et_nav_text_color_' . et_get_option( 'secondary_nav_text_color', 'light' );

		$et_top_info_defined = $et_secondary_nav_items->top_info_defined;
		?>

		<?php if ( $et_top_info_defined ) : ?>
			<div id="top-header" class="<?php echo esc_attr( $secondary_nav_class ); ?>">
				<div class="container clearfix">

					<?php if ( $et_contact_info_defined ) : ?>

						<div id="et-info">
							<?php if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) : ?>
								<span id="et-info-phone"><?php echo esc_html( $et_phone_number ); ?></span>
							<?php endif; ?>

							<?php if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) : ?>
								<a href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>"><span id="et-info-email"><?php echo esc_html( $et_email ); ?></span></a>
							<?php endif; ?>

							<?php
							if ( true === $show_header_social_icons ) {
								get_template_part( 'includes/social_icons', 'header' );
							} ?>
						</div> <!-- #et-info -->

					<?php endif; // true === $et_contact_info_defined ?>

					<div id="et-secondary-menu">
						<?php
						if ( ! $et_contact_info_defined && true === $show_header_social_icons ) {
							get_template_part( 'includes/social_icons', 'header' );
						} else if ( $et_contact_info_defined && true === $show_header_social_icons ) {
							ob_start();

							get_template_part( 'includes/social_icons', 'header' );

							$duplicate_social_icons = ob_get_contents();

							ob_end_clean();

							printf(
								'<div class="et_duplicate_social_icons">
								%1$s
								</div>',
								$duplicate_social_icons
							);
						}

						if ( '' !== $et_secondary_nav ) {
							echo $et_secondary_nav;
						}

						et_show_cart_total();
						?>
					</div> <!-- #et-secondary-menu -->

				</div> <!-- .container -->
			</div> <!-- #top-header -->
		<?php endif; // true ==== $et_top_info_defined ?>

		<header id="main-header" class="<?php echo esc_attr( $primary_nav_class ); ?>">
			<div class="container clearfix">
				<?php
				$logo = get_stylesheet_directory_uri() . '/images/wordmark.png';
				?>
				<div class="image-title-wrapper">
					<a href="http://www.uwosh.edu">
						<img src="<?php echo esc_attr( $logo ); ?>" alt="University of Wisconsin Oshkosh wordmark" id="logo" />
					</a>
					<div class="site-title">
						<h1>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>
							</a>
						</h1>
					</div>
				</div>


				<div id="et-top-navigation">
					<nav id="top-menu-nav">
						<?php
						$menuClass = 'nav';
						if ( 'on' == et_get_option( 'divi_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
						$primaryNav = '';

						$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => 'top-menu', 'echo' => false ) );

						if ( '' == $primaryNav ) :

							?>
							<ul id="top-menu" class="<?php echo esc_attr( $menuClass ); ?>">
								<?php if ( 'on' == et_get_option( 'divi_home_link' ) ) { ?>
									<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'Divi' ); ?></a></li>
									<?php }; ?>

									<?php show_page_menu( $menuClass, false, false ); ?>
									<?php show_categories_menu( $menuClass, false ); ?>
								</ul>
								<?php
								else :
									echo( $primaryNav );
								endif;
								?>
							</nav>

							<?php
							if ( ! $et_top_info_defined ) {
								et_show_cart_total( array(
									'no_text' => true,
								) );
							}
							?>

							<?php if ( false !== et_get_option( 'show_search_icon', true ) ) : ?>
								<div id="et_top_search">
									<span id="et_search_icon"></span>
									<!-- Initializing Google Custom Search -->
									<?php
									//connect to database
									global $wpdb;
									$prefix= $wpdb->prefix;
									$gcs_table = $prefix . "gcs_address";
									//Check to see if table has been created
									if ($wpdb->get_var("SHOW TABLES LIKE '$gcs_table'")==$gcs_table)
									{
										$count_query = "select count(*) from $gcs_table";
										$num = $wpdb->get_var($count_query);
										if ($num>0)
										{
											//check to see if there is data in the table
											$maxId= $wpdb->get_var("SELECT Max(id) FROM $gcs_table  ");
											$gcs_code= $wpdb->get_var("SELECT address_code FROM $gcs_table WHERE id= $maxId ");
											// puts the GCS code on the page
											echo stripslashes($gcs_code);
										}
									}
									?>
								</div>
							<?php endif; // true === et_get_option( 'show_search_icon', false ) ?>

							<?php do_action( 'et_header_top' ); ?>
						</div> <!-- #et-top-navigation -->
					</div> <!-- .container -->
				</header> <!-- #main-header -->

				<div id="et-main-area">
