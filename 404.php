<?php get_header(); ?>

<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
				<article id="post-0" <?php post_class( 'et_pb_post not_found' ); ?>>
					<img class="angry-clash" src="<?php echo get_stylesheet_directory_uri() . "/images/mad-clash.jpg" ?>" alt="awkward seal">
					<h1>Uh oh...</h1>
					<p>
						You 
						<?php

						// Function to get the browser of the user agent
						function getBrowser() 
						{ 
							$u_agent = $_SERVER['HTTP_USER_AGENT']; 
							$bname = 'Unknown';
							$platform = 'Unknown';
							$version= "";

							//First get the platform?
							if (preg_match('/linux/i', $u_agent)) {
								$platform = 'Linux';
							}
							elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
								$platform = 'Mac';
							}
							elseif (preg_match('/windows|win32/i', $u_agent)) {
								$platform = 'Windows';
							}
							
							// Next get the name of the useragent yes seperately and for good reason
							if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
							{ 
								$bname = 'Internet Explorer'; 
								$ub = "MSIE"; 
							} 
							elseif(preg_match('/Firefox/i',$u_agent)) 
							{ 
								$bname = 'Mozilla Firefox'; 
								$ub = "Firefox"; 
							} 
							elseif(preg_match('/Chrome/i',$u_agent)) 
							{ 
								$bname = 'Google Chrome'; 
								$ub = "Chrome"; 
							} 
							elseif(preg_match('/Safari/i',$u_agent)) 
							{ 
								$bname = 'Apple Safari'; 
								$ub = "Safari"; 
							} 
							elseif(preg_match('/Opera/i',$u_agent)) 
							{ 
								$bname = 'Opera'; 
								$ub = "Opera"; 
							} 
							elseif(preg_match('/Netscape/i',$u_agent)) 
							{ 
								$bname = 'Netscape'; 
								$ub = "Netscape"; 
							} 
							
							// finally get the correct version number
							$known = array('Version', $ub, 'other');
							$pattern = '#(?<browser>' . join('|', $known) .
							')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
							if (!preg_match_all($pattern, $u_agent, $matches)) {
								// we have no matching number just continue
							}
							
							// see how many we have
							$i = count($matches['browser']);
							if ($i != 1) {
								//we will have two since we are not using 'other' argument yet
								//see if version is before or after the name
								if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
									$version= $matches['version'][0];
								}
								else {
									$version= $matches['version'][1];
								}
							}
							else {
								$version= $matches['version'][0];
							}
							
							// check if we have a number
							if ($version==null || $version=="") {$version="?";}
							
							return array(
								'userAgent' => $u_agent,
								'name'      => $bname,
								'version'   => $version,
								'platform'  => $platform,
								'pattern'    => $pattern
							);
						}

						function giveHost($host_with_subdomain) {
							$array = explode(".", $host_with_subdomain);
						
							return (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "").".".$array[count($array) - 1];
						}

						#some variables for the script to use
						#if you have some reason to change these, do.  but wordpress can handle it
						$website = get_bloginfo('url'); #gets your blog's url from wordpress
						$websitename = get_bloginfo('name'); #sets the blog's name, according to wordpress
						$referer_host = giveHost(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST));
						$link = $website . $_SERVER['REQUEST_URI'];
						$link_path = parse_url($link, PHP_URL_PATH);
						$link_path_extension = pathinfo($link_path, PATHINFO_EXTENSION);
						$link_query_string = parse_url($link, PHP_URL_QUERY);
						$unimportant_file_extensions = array("bmp", "gif", "img", "jpe", "jpeg", "jpg", "png", "tiff", "ico", "css", "js", "map");

						if (!isset($_SERVER['HTTP_REFERER'])) {
							#politely blames the user for all the problems they caused
							echo "tried going to "; #starts assembling an output paragraph
							$casemessage = "All is not lost!";
						} elseif (isset($_SERVER['HTTP_REFERER'])) {
							#this will help the user find what they want, and email me of a bad link
							echo "clicked a link to";
							
							// setup a message to be sent to me
							if( !in_array( strtolower( $link_path_extension ), $unimportant_file_extensions ) && 
								$referer_host == "uwosh.edu"  &&
								substr( $link_query_string , 0, 6) != "author" &&
								( $_SERVER['REQUEST_URI'] != "/wp-login.php" || $_SERVER['REQUEST_URI'] != "//wp-login.php" ) ){ // the bad link was a page, and from a uw-oshkosh site, and 404 page isn't an author attack, and the IP isn't receiving a 404 because it's blocked
									$user_agent = getBrowser();
									$browser_string = $user_agent['name'] . " " . $user_agent['version'] . " on " .$user_agent['platform'];
		
									$failure_message = "An invalid link was discovered on $websitename\n";
									$failure_message .= "Invalid link: " . $link . "\n";
									$failure_message .= "Referer: " . $_SERVER['HTTP_REFERER'] . "\n";
									$failure_message .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
									$failure_message .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
									$failure_message .= "User Browser: " . $browser_string . "\n\n";
									$failure_message .= "This was not caused by user error, it was caused by a bad link in the webpage. It is highly suggested that you fix this bad link.";
		
									mail("wordpressadmin@uwosh.edu", "Invalid Link Discovered On " . $websitename, $failure_message, "From: $websitename <noreply@$website>"); // email you about problem
									
									$casemessage = "An administrator has been emailed about this problem, too."; // set a friendly message
							} else{
								$casemessage = "We are sorry about that!"; // ¯\_(ツ)_/¯
							}
						}

						echo " " . $link; ?>. Unfortunately, this page doesn't exist. <?php echo $casemessage; ?>  You can click back 
						and try again or choose from the links below to help find what you are looking for. Or just <a href="<?php echo $website ?>">go home</a> and start over.
					</p>
					<br />
					<h3>Related Links</h3>
					<div>
					<?php
						$search_term = $_SERVER['REQUEST_URI'];
						$search_term = urldecode($search_term);
						$search_term = preg_replace('/\\.[^.\\s]{3,4}$/', '', $search_term); // removing the file extension
						$search_term = str_replace('/', ' ', $search_term); // replacing the slashes with spaces
						$search_term = str_replace('-', ' ', $search_term); // replacing the dashes with spaces
						
						// Performing the query
						$query = new WP_Query( array( 's' => $search_term ) );
						
						// Looping over posts
						if ( $query->have_posts() ) {
							echo '<ul>';
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php
							}
							echo '</ul>';
							/* Restore original Post Data */
							wp_reset_postdata();
						} else {
							// no posts found
							echo "No relevant posts were found.";
						}
					?>
					</div>
				</article> <!-- .et_pb_post -->
			</div> <!-- #left-area -->
			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>