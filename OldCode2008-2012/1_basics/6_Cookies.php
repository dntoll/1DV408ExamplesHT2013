<?php
   
   
   /**
    * Cookies saves a small amount of data in the web-browser
    * 
    * When a HTTP-Request arrives to the server it contains the cookies previously stored.
    * From PHP we can access the uploaded cookies by the super-global $_COOKIE[] array
    */
  
  var_dump($_COOKIE);
  
  
  /**
   * To save data on the client in  a cookie we modify the HTTP-Response message by set_cookie
   * 
   * http://php.net/manual/en/function.setcookie.php
   */ 
   $cookieName = "CookieName";
   $expiresAt = time() + 5; //expires in five seconds from now
   $newCookieValue = "cookieValue $expiresAt";
  
   setcookie($cookieName, $newCookieValue, $expiresAt);
   //$_COOKIE[$cookieName] = $newCookieValue; //för att få automatiska tester att fungera...
   
   /**
    * Not that the $_COOKIE array does not contain anything from a setcookie call
    * only things sent from client
    */
   if (isset($_COOKIE[$cookieName]) == false) {
   		echo "no cookies at the current location";
   } else {
   		echo "A cookie was found with value: $_COOKIE[$cookieName], 
   		<br/>the new value of the cookie was set to $newCookieValue";
   }
   
   
   //echo "<h2>Intentional Warning message:</h2>";
   
   /**
    * Note a cookie cannot be set after the header has been sent
    * A cookie is sent in the header of the HTTP-Response
    * 
    * ( or it can if output buffering is on, normally off on web-hosts ) 
    */
   //ob_end_flush(); // make sure we send stuff to the client
   //session_start(); 
   
   
   
