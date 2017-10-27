<?php
function print_log($text, $log_level)
{
	if($log_level != "DEBUG")
	{
		if(strpos($text, $log_level))
		{
			exec("echo '".date(DATE_RFC2822)." ".$text."' >> /usr/local/scripts/ticket_notif/service.log");
		}
	}
	else
	{
		exec("echo '".date(DATE_RFC2822)." ".$text."' >> /usr/local/scripts/ticket_notif/service.log");
	}
}
function getLastID()
{
	return exec("cat /usr/local/scripts/ticket_notif/lastID");
}
function setLastID($id)
{
	exec("echo '".$id."' > /usr/local/scripts/ticket_notif/lastID");
}
include("/usr/local/scripts/ticket_notif/config.php");
print_log("[INFO] Cron job started.", $log_level);
$conn = new mysqli($servername, $username, $password, $dbname );
if ($conn->connect_error) {
    print_log("[ERR] Connection Failure.");
} 
print_log("[INFO] Connection Established.", $log_level);
$mantis_user_id = $conn->query("SELECT id FROM mantis_user_table WHERE username='".$mantis_user."'");
$tmp = $mantis_user_id->fetch_assoc();
$mantis_user_id = $tmp["id"];
if($res=$conn->query("SELECT id , summary FROM mantis_bug_table WHERE handler_id='' AND project_id IN(SELECT project_id FROM mantis_project_user_list_table WHERE user_id=".$mantis_user_id.") AND status = 10 ORDER BY id"))
{
	print_log("[INFO] Data has been extracted correctly.", $log_level);
	$lastID=getLastID();
	$i=0;
	while($row = $res->fetch_assoc())
	{
		$lastID=getLastID();
		if($row['id']>$lastID)
		{
			print_log(exec('sh /usr/local/scripts/ticket_notif/notify.sh "'.$row['summary'].'"'), $log_level);
			$i++;
		}
		$id_out=$row['id'];
	}
	print_log("[INFO] Last Extracted ID is: ".$id_out , $log_level);
	if($i==0)
		print_log("[INFO] No new ticket has been detected. Next check will be performed in 3 minutes.", $log_level);
	setLastID($id_out);
	if(getLastID()==$id_out)
	{
		print_log("[INFO] LastID file has been set correctly.", $log_level);
	}
	else
	{
		print_log("[ERR] LastID file has not been written correctly.", $log_level);
	}
}
else
{
	print_log("[ERR] Extraction failure", $log_level);
}
$conn->close();
print_log("[INFO] Connection Closed.", $log_level);
print_log("[INFO] Cronjob Ended", $log_level);
?>
