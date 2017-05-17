<?php if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer">
				<?php get_sidebar( 'footer' ); ?>


		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>

			<div id="uwo-footer">
				<div id="footer-top">
					<span>
						The University of Wisconsin Oshkosh — Where Excellence and Opportunity Meet.
					</span>
				</div> <!-- #footer-top -->
				<div id="footer-body">
					<div class="row" data-equalizer>
						<div id="footer-column-1" class="large-3 medium-6 small-12">
							<p class="footer-column-header"> Location </p>
							<div>
								<a href="https://maps.google.com/maps?q=University+of+Wisconsin+Oshkosh+800+Algoma+Blvd.+Oshkosh,+WI+54901&amp;um=1&amp;ie=UTF-8&amp;hl=en&amp;sa=N&amp;tab=wl" target="_blank">
									<img src="<?php echo esc_attr(get_stylesheet_directory_uri() . '/images/footer/wismap-color.png') ?>" class="wismap pull-left desaturate">
								</a>
								<address id="footer-address" class="link-list">
									<a href="https://maps.google.com/maps?q=University+of+Wisconsin+Oshkosh+800+Algoma+Blvd.+Oshkosh,+WI+54901&amp;um=1&amp;ie=UTF-8&amp;hl=en&amp;sa=N&amp;tab=wl" target="_blank">
										<ul>
											<li> University of Wisconsin Oshkosh </li>
											<li class="street-address"> 800 Algoma Blvd. </li>
											<li>
												<span class="locality">Oshkosh</span>,
												<span class="region">WI</span>
												<span class="postal-code">54901</span>
											</li>
											<li> <a href="tel:9204241234">(920) 424-1234</a> </li>
										</ul>
									</a>
								</address> <!-- #address -->
							</div>
						</div> <!-- #footer-column-1 -->
						<div id="footer-column-2" class="large-3 medium-6 small-12">
							<p id="column-2-header" class="footer-column-header"> Quick Links </p>
							<div>
								<div id="mobile-emergency">
									<p>
										<a href="http://www.uwosh.edu/go/mobile">
											<i class="fa fa-mobile desaturate" aria-hidden="true"></i>
											Download UW Oshkosh's Mobile App
										</a>
									</p>
									<p>
										<a href="http://emergency.uwosh.edu">
											<i class="fa fa-exclamation-triangle desaturate" aria-hidden="true"></i>
											Emergency and Safety Information
										</a>
									</p>
								</div>
							</div>
						</div> <!-- #footer-column-2 -->
						<div id="footer-column-3" class="large-3 medium-6 small-12">
							<p class="footer-column-header"> Resources </p>
							<div id="sitemap" class="link-list">
								<ul class="list-block">
									<li>
										<a href="http://www.uwosh.edu/resources/accessibility">Accessibility</a></li>
									<li>
										<a href="http://www.uwosh.edu/career/">Career Services</a></li>
									<li>
										<a href="http://uwosh.edu/go/directions" target="_blank">Get Directions</a></li>
									<li>
										<a href="http://www.uwosh.edu/foundation/why-give/support-uw-oshkosh/online-giving">Give to UW Oshkosh</a></li>
									<li>
										<a href="http://www.uwosh.edu/imc/media-relations/newsroom">Media Relations</a></li>
									<li>
										<a href="http://www.uwosh.edu/hr/employment/">Work at UW Oshkosh</a></li>
								</ul>
							</div>
						</div> <!-- #footer-column-3 -->
						<div id="footer-column-4" class="large-3 medium-6 small-12">
							<a href="http://www.ncahlc.org/?option=com_directory&amp;Action=ShowBasic&amp;instid=2030" target="_blank">
								<img src="<?php echo esc_attr(get_stylesheet_directory_uri() . '/images/footer/hlc.png') ?>" id="footer-accredited" class="inline" alt="Higher Learning Commission">
							</a>
							<a href="http://www.wisconsin.edu/" target="_blank">
								<img src="<?php echo esc_attr(get_stylesheet_directory_uri() . '/images/footer/uw-system.png') ?>" id="footer-uw-logo" class="inline" alt="UW System">
							</a>
						</div> <!-- #footer-column-4 -->
					</div>
				</div> <!-- #footer-body -->
				<div id="footer-bottom">
					<div id="footer-copy">
						<span>&copy;<?php echo date("Y") ?> UW Board of Regents </span>
					</div>
					<div id="footer-social">
						<a href="https://www.facebook.com/uwoshkosh" target="_blank" class="footerFacebook"><i class="fa fa-facebook fa-2x desaturate" aria-hidden="true" alt="Facebook logo"></i></a>
						<a href="https://twitter.com/uwoshkosh" target="_blank" class="footerTwitter"><i class="fa fa-twitter fa-2x desaturate" aria-hidden="true" alt="Twitter logo"></i></a>
						<a href="http://instagram.com/uwoshkosh" target="_blank" class="footerInstagram"><i class="fa fa-instagram fa-2x desaturate" aria-hidden="true" alt="Instagram logo"></i></a>
						<a href="http://www.youtube.com/uwosh" target="_blank" class="footerYouTube"><i class="fa fa-youtube-play fa-2x desaturate" aria-hidden="true" alt="YouTube logo"></i></a>
						<a href="http://www.linkedin.com/edu/school?id=19693" target="_blank" class="footerLinkedIn"><i class="fa fa-linkedin fa-2x desaturate" aria-hidden="true" alt="LinkedIn logo"></i></a>
						<a href="http://www.pinterest.com/uwoshkosh/" target="_blank" class="footerPinterest"><i class="fa fa-pinterest-p fa-2x desaturate" aria-hidden="true" alt="Pinterest logo"></i></a>
						<a href="http://www.flickr.com/photos/uwoshkosh/sets/" target="_blank" class="footerFlickr"><i class="fa fa-flickr fa-2x desaturate" aria-hidden="true" alt="Flickr logo"></i></a>
					</div>
			</div><!-- #footer-bottom -->
		</div> <!-- #footer -->
		</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>

</body>
</html>
