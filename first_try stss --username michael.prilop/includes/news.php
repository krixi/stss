<script type="text/javascript" src="/javascripts/verify.js"></script>
<script type="text/javascript">
var selectedType = "none";
var selectedId = -1;
</script>
<?php


// Default to showing 5 entries
$numEntries = 5;
// If they request a new number, display that many and update session variable.
if (isset($_REQUEST['numEntries']) && $_REQUEST['numEntries'] != '') {
	$numEntries = $_REQUEST['numEntries'];
	$_SESSION['newsEntriesShown'] = $_REQUEST['numEntries'];
} else if (isset($_SESSION['newsEntriesShown'])) {
	// If they're navigating here from previously in the session save their preference.
	$numEntries = $_SESSION['newsEntriesShown'];
}

$allow_edit = false;
if (isset($_REQUEST['req'])) {
	switch($_REQUEST['req']){
		case "modify":
		if ($_SESSION['login'] == true && $_SESSION['admin'] == true) {
			$allow_edit = true;
		}
		break;
		default:
		break;
	}
}

// used to print 1 row of news from the databse.
function printTableRow ($row, $allow_edit) {
	printf("<td>\n");
	printNewsCell("newstitle", $row['id'], $row['title'], "title", $allow_edit);
	printNewsCell("newscontent", $row['id'], $row['content'], "content", $allow_edit);
	printNewsCell("newsdate", $row['id'], sprintf("Created on %s by %s\n", $row['date'], $row['username']), "date", false);
	printf("</td>\n");
}

function printNewsCell($name, $id, $string, $selected, $allow_edit) {
	printf("<div id=\"%s_%d\" class=\"news_%s\" onclick=\"selectedId = %d; selectedType = '%s';\">%s</div>\n", 
		$name, $id, $selected, $id, $selected, $string);
	if ($allow_edit) {
		jsEditInPlace($name, $id);
	}
}

// Function to print out the copy/paste javascript
function jsEditInPlace($name, $id) {
	printf("<script type=\"text/javascript\">\n");
	printf("	new Ajax.InPlaceEditor($('%s_%d'), '/phpscripts/editNews.php', {\n", $name, $id);
	printf("	callback: function (form, value) { return 'id='+selectedId+'&type='+selectedType+'&value='+escape(value) }\n");
	printf("	});\n");
	printf("</script>\n");
}


//start table
printf("<table id=\"news\" class=\"news\">\n");
require $_SERVER['DOCUMENT_ROOT']."includes/db.inc";

$db_handle =  new mysqli($db_host, $db_user, $db_pass, 'users');

if (mysqli_connect_errno()) {	
	trigger_error("Connection failed: ".mysqli_connect_error(), E_USER_ERROR);
	showFooter();
	exit;
}


// Formats the date to display as: 3 Jun 2008, at 03:44:15 PM
$sql_query = "SELECT title, content, date_format(dateCreated, '%e %b %Y, at %r') as date, username, news.id as id FROM news, accounts WHERE accounts.id = creatorId ORDER BY dateCreated DESC LIMIT ".$numEntries;

if ($result = $db_handle->query($sql_query)) {

	$row_count = 0;
	$class1 = "news_alternate1";
	$class2 = "news_alternate2";
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {

		$thisClass = ($row_count % 2 == 0) ? $class1 : $class2;
		
		printf("<tr class=\"".$thisClass."\">\n");
		printTableRow($row, $allow_edit);		
		printf("</tr>\n");		
	
		//increment row color
		$row_count++;
	}
	

	
} else {
	trigger_error("Invalid query.", E_USER_ERROR);
}
$db_handle->close();
printf("</table>\n");


// Output the HTML form to change number of entries per page...
// Choose using the $numEntries variable which option is selected.
?>
<form action="index.php" name="changeNumEntries" method="post">
<span class="display_txt">Show
<select name="numEntries" class="submit">
<option value="5" <?php if ($numEntries == 5) echo "selected=\"true\""; ?>>5</option>
<option value="10"<?php if ($numEntries == 10) echo "selected=\"true\""; ?>>10</option>
<option value="25"<?php if ($numEntries == 25) echo "selected=\"true\""; ?>>25</option>
</select>
entries per page
<input class="submit" type="submit" value="Go" />
</span>
</form>
