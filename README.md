# Mantis-notification-client
Mantis Notification Client for linux PCs

#How to install
mkdir /usr/local/scripts/ticket_notif
cd /usr/local/scripts/ticket_notif
git clone [url]

type crontab -e and add on the bottom of the file the following line
[*/3 * * * * /usr/bin/php /usr/local/scripts/ticket_notif/main.php]
