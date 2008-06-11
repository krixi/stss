<?php

  /**
  * config.php
  *
  * @author Joe Stump <joe@joestump.net>
  * @copyright Joe Stump <joe@joestump.net> 
  * @license http://www.opensource.org/licenses/gpl-license.php
  * @package Framework
  * @filesource
  */

  /**
  * FR_BASE_PATH
  *
  * Dynamically figure out where in the filesystem we are located.
  *
  * @author Joe Stump <joe@joestump.net>
  * @global string FR_BASE_PATH Absolute path to our framework
  */
  
  //just in case its a windows system
  $base_path = str_replace('\\','/',dirname(__FILE__));
  define('FR_BASE_PATH',$base_path);

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
