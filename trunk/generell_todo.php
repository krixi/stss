<?php
//TODO: login with wrong password should not display "Invalid email" error
//TODO: nicer welcome page
//TODO: all db-errors should only display generic error if DEBUG=false
//TODO: set error-reporting level to 0 by config.php?
//TODO: setup google-analytics to track webusage
//TODO: url-rewrite?
//TODO: nicer tables -> numerical values align right etc.


/*
 * KNOWN VULNERABILITIES
- not using ssl to secure traffic -> sniffing network traffic allows to read sessionID and highjack session
- set session.use_only_cookies to make it more secure (sessionID is not transferred in url anymore)


ENHANCEMENTS
- using random salts to make it more difficult to bruteforce passwords from the hash (e.g. using rainbowtables) 
- creates pdf of bill


Google Analytics
account: simple.tickets.sales.site@gmail.com
pwd: stssstss

 */

?>