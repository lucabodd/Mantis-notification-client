# Mantis-notification-client
Mantis Notification Client for linux PCs display new tickets notification via libnotify.

# How to install
open a shell and typ the following commands
 <br> mkdir /usr/local/scripts/
 <br> cd /usr/local/scripts/
 <br> git clone  https://github.com/lucabodd/Mantis-notification-client.git 
 <br> mv mv Mantis-notification-client/ ticket_notif
 
 


type crontab -e and add on the bottom of the file the following line:<br>
<code>
 */3 * * * * /usr/bin/php /usr/local/scripts/ticket_notif/main.php
</code>

