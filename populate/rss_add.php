<?

//check for duplicate
mysql_select_db('344827_iceDEV', $db);
$query_dupeLink = "SELECT * FROM post_index WHERE url = '$url'";
$result_dupeLink = mysql_query($query_dupeLink);
$dupe = mysql_fetch_array($result_dupeLink);

//echo ''.$twitter_feedID.'<br>';

if ($dupe) {
	echo '<p>Duplicate: <a href="' .$url. '" target="_blank">' .$content. '</a> ['.$date.']</p>';
	}

elseif (!$dupe) {
	
	$result_count++;
	
	//add new entry to DB
	mysql_select_db('344827_iceDEV', $db);
	$insert_new = 'INSERT INTO post_index (source_id, content, url, pull_date, image_url, approval) 
		VALUES ("'.$source_id.'", "'.$content.'", "'.$url.'", "'.$date.'", "'.$image.'", "0")';
	//echo $insert_new;
	$inserted_new = mysql_query($insert_new);

	if ($inserted_new) {
		echo '<p>Everything is perfect: <a href="' .$url. '" target="_blank">' .$content. '</a> ['.$date.']</p>'; 
		/*/check to make sure it all worked.
		if ($check_insert) echo 
		else echo '<p>Content not saved: <a href="' .$url. '" target="_blank">' .$content. '</a> ['.$date.']</p>';*/
		sleep(1);
		}

	elseif (!$inserted_new) {
		echo '<p>Nothing was saved: <a href="' .$url. '" target="_blank">' .$content. '</a> ['.$date.']</p>';
		}
	}
?>