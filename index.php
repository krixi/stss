<?php


require_once('config.php');
require_once('includes/auth.php');

session_start();


//check if module and event is set properly
if (isset($_GET['module'])) {
    $module = $_GET['module'];
    if (isset($_GET['event'])) {
        $event = $_GET['event'];
    }
    else {
        $event = 'welcome';
    }

  //set language to users choice or default
  if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
  }
  else {
    $language = LANGUAGE_DEFAULT;
  }


    $eventFile = BASE_PATH.'/modules/'.$module.'/'.$event.'.model.php';
    
    //select View based on event and language settings
    $viewFile = BASE_PATH.'/views/'.$language.'/'.$module.'/'.$event.'.view.php';
       
      
          
     
     //including model and view functions
     if (file_exists($eventFile)) {
          include($eventFile);
          
       if (file_exists($viewFile)) {
          include($viewFile);
          
                  //check if authenticated
                  if (authenticate()) {
                    
                    //let the model do the work
                    $result = work();
                    
                    //display the results
                    display($result);
                    
                  }
                  else {
                      die("You do not have access to the requested page!");
                  }
          }
          else {
            die("Could not find: $viewFile");
          }
      }
      else {
          die("Could not find: $eventFile");        
      }
  }
  else {
      die("A valid module was not specified");
  }

?>
