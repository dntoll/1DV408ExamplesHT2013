<?php

namespace view;


class HTMLPage {

	/**
	 * @param  String $title 
	 * @param  String $body  
	 * @return String HTML
	 */
	public function getPage($title, $body) {
		return '<!DOCTYPE HTML SYSTEM>
<html>
  <head>
    <title>' . $title . '</title>
    <meta http-equiv=\'content-type\' content=\'text/html; charset=utf8\'>
  </head>
  <body>
  	' . $body . '
  </body>
</html>';
	}
}