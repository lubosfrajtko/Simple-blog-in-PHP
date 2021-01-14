<?php

	//	Asset
	// return absolute path 

	function asset( $path, $base = BASE_URL.'/assets/')
	{
		$path = trim( $path, '/');
		return $base.$path;
	}
   
	// Segment
	// split path on segments
	// return array segments

	function get_segments()
	{
		$current_url = 'http' .
			( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 's://' : '://' ) .
			$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
		$path = str_replace( BASE_URL, '', $current_url );
		$path = trim(parse_url( $path, PHP_URL_PATH ), '/');

		$segments = explode( '/', $path );
		return $segments;
	}

	function segment( $index )
	{
	
		$segments = get_segments();

		return isset( $segments[ $index-1 ] ) ? $segments[ $index-1 ] : false;
	}


	/**
	 * Show 404
	 *
	 * Sends 404 not found header
	 * And shows 404 HTML page
	 *
	 * @return void
	 */
	function show_404()
	{
		header("HTTP/1.0 404 Not Found");
		include_once "404.php";
		die();
    }
	
	/**
	 * Redirect
	 *
	 * @param $page
	 * @param int $status_code
	 */
	function redirect( $page, $status_code = 302 )
	{
		if ( $page == 'back' )
		{
			$location = $_SERVER['HTTP_REFERER'];
		}
		else
		{
			$page = ltrim($page, '/');
			$location = BASE_URL . "/$page";
		}

		header("Location: $location", true, $status_code);
		die();
	}