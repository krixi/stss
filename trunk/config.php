<?php

  /**
  * config.php
  *
  * configure all global constants here only
  *
  * @author Michael Prilop
  */

// Timeout in minutes
define("USER_TIMEOUT", 5);


  /**
  * LANGUAGE_DEFAULT
  *
  * Define default language
  *
  * @author Michael Prilop
  * @global string LANGUAGE_DEFAULT default language
  */

  define('LANGUAGE_DEFAULT','en');

  /**
  * BASE_PATH
  *
  * Dynamically figure out where in the filesystem we are located.
  *
  * @author Michael Prilop
  * @global string FR_BASE_PATH Absolute path to our framework
  */

  define('BASE_PATH',dirname(__FILE__));

  /**
  * FR_DSN
  *
  * This is a DSN formatted according to PEAR DB's specifications. 
  *
  * @author Joe Stump <joe@joestump.net>
  * @global string FR_DSN PEAR DB compatible DSN 
  * @link http://pear.php.net/package/DB
  */
  define('FR_DSN','mysql://root@localhost/framework');

  /**
  * FR_LOG_FILE
  * 
  * Path to centralized log file that can be accessed directly from our
  * application classes.
  *
  * @author Joe Stump <joe@joestump.net> 
  * @global string FR_LOG_FILE Path to log file
  * @link http://pear.php.net/package/Log
  */
  define('FR_LOG_FILE',FR_BASE_PATH.'/tmp/fr.log');

  /**
  * SMARTY_DIR
  *
  * @author Joe Stump <joe@joestump.net>
  * @global string SMARTY_DIR Path to Smarty install
  * @link http://smarty.php.net
  */
  define('SMARTY_DIR',FR_BASE_PATH.'/includes/Smarty/');

  /**
  * FR_TEMPLATE
  *
  * This defines our outer page template. You could, optionally, define this
  * based on cookie settings (to allow users to switch or choose layouts and
  * templates).
  *
  * @author Joe Stump <joe@joestump.net>
  * @global string FR_TEMPLATE Name of outer page template
  */
  define('FR_TEMPLATE','default');

?>
