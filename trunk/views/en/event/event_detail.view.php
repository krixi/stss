<?php
function display($result) {
  showHeader(EVENTS);

  echo "<h1>{$result[0]['name']}</h1>";
  echo "<h2>Time and Date: {$result[0]['date']}</h2>";
  echo "Available Seats:<br>"; 
           echo "<ul>";
              foreach ($result as $row) {
                echo "<li>Category: {$row['category']} - {$row['amount']} Seats, {$row['available']} available - Price: {$row['price']} &euro;</li>";
              }
  echo "  </ul>";

  echo "Description: <br>\n";
  if ($row['description']=='') {
    echo "Sorry, no further Information available";
  }
  else {
    echo $row['description'];
  }
  
  echo "<br>";
  echo "<a href = \"index.php?module=buy&action=buy_tickets&eventID={$row['eventID']}\">Buy Tickets</a>\n";
  showFooter();
}

?>