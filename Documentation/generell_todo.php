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


ENHANCEMENTS
- using random salts to make it more difficult to bruteforce passwords from the hash (e.g. using rainbowtables) 
- creates pdf of bill
- admin can add events
- switch languages
- FRAMEWORK




Google Analytics
account: simple.tickets.sales.site@gmail.com
pwd: stssstss

 */

?>