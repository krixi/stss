<?php
include BASE_PATH."/views/common.php";

function display($result) {
  showHeader(EVENTS);

  echo "<h2>{$result[0]['name']}</h2>";
  echo "<ul>Time and Date: {$result[0]['date']}</ul>
           <ul>Available Seats:";
              foreach ($result as $row) {
                echo "<ul>Category: {$row['category']} - {$row['amount']} Seats - Price: {$row['price']} euro</ul>";
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
  echo "<a href = \"index.php?module=buy&action=event_detail&eventID={$row['eventID']}\">Buy Tickets</a>\n";
  showFooter();
}

?>