<?php
//TODO: nicer welcome page
//TODO: all db-errors should only display generic error if DEBUG=false
//TODO: set error-reporting level to 0 by config.php?
//TODO: url-rewrite?


/*
 * KNOWN VULNERABILITIES
- not using ssl to secure traffic -> sniffing network traffic allows to read sessionID and highjack session
- set session.use_only_cookies to make it more secure (sessionID is not transferred in url anymore)
- carts are only stored in session -> users may parallel add more tickets to cart than available
	(but is cought before purchasing)
- does not validate (e.g. using loads of ä ü ö in the german part :D
- Framework: passing results from model to view only in a very loosely defined way (per array)
- pdfs which are generated fill up filesystem ... autodelete necessary

USER WEAKNESSES
- auto-login after joining
- list a login button unter event_details if not logged in -> user is irritated
- login is text (mousbutton changes)
- layout of loginfield is irritating (swap username, pwdfield)


ENHANCEMENTS
- using random salts to make it more difficult to bruteforce passwords from the hash (e.g. using rainbowtables) 
- creates pdf of bill
- admin can add events
- switch languages
- FRAMEWORK
-- security (can't forget authentication)
-- modularisation
-- ease collaborate work
- DATABASE
- normalised Database layout
- encapsuling buisiness logic in database (via views)
- using db-user with restricted rights -> counter sql-injection 
- using sql injection protection by binding or real_escape_string
- using google analytics :)



Google Analytics
account: simple.tickets.sales.site@gmail.com
pwd: stssstss

 */

?>