#!/bin/bash
/usr/bin/notify-send -i bug "New Ticket" "Summary: $1" 
echo "[INFO] Issue: $1 has been notified"
