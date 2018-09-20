<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package uwm2016
 */
# Redirect 404 not found pages over to www.uwosh.edu
# where either the content will exist or the www.uwosh.edu 404
# page will be displayed
$uri = $_SERVER['REQUEST_URI'];
wp_redirect('http://www.uwosh.edu' . $uri, 301);
exit();
?>