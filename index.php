<?php


  require_once('config.php');



  if (isset($_GET['module'])) {
      $module = $_GET['module'];
      if (isset($_GET['event'])) {
          $event = $_GET['event'];
      } else {
          $event = 'default';
      }



      $actionFile = FR_BASE_PATH.'/modules/'.$module.'/'.$event.'.model.php';
      
      //check language
      $lang = 'en'; //from session in future
      $viewFile = FR_BASE_PATH.'/views/'.$lang.'/'.$module.'/'.$event.'.view.php';
       
       if (file_exists($viewFile)) {
          include($viewFile);
          }
          else {die('view not found');}
     
     if (file_exists($actionFile)) {
          include($actionFile);

                  //check if authenticated
                  if (authenticate()) {
                      try {
                          //get results from event
                          
                          
                          display(result());

                       } catch (Exception $error) {
                          die($error->getMessage());
                      }
                  } else {
                      die("You do not have access to the requested page!");
                  }
      } else {
          die("Could not find: $actionFile");        
      }
  } else {
      die("A valid module was not specified");
  }

?>
