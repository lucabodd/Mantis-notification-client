# Mantis-notification-client
Mantis Notification Client for linux PCs display new tickets notification via libnotify.

# How to install
open a shell and typ the following commands
 mkdir /usr/local/scripts/ticket_notif <br> 
 cd /usr/local/scripts/ticket_notif <br> 
 git clone <br>


type crontab -e and add on the bottom of the file the following line:<br>
<code>
 */3 * * * * /usr/bin/php /usr/local/scripts/ticket_notif/main.php
</code>

