<?

//check for duplicate
mysql_select_db('344827_cidb', $db);
$query_dupeLink = "SELECT * FROM twitter_posts WHERE post_link = '$post_link'";
$result_dupeLink = mysql_query($query_dupeLink);
$dupe = mysql_fetch_array($result_dupeLink);

//echo ''.$twitter_feedID.'<br>';

if ($dupe) {
	echo '<p>Duplicate: <a href="' .$post_link. '" target="_blank">' .$post_title. '</a> ['.$post_date.']</p>';
	}

elseif (!$dupe) {
	
	$result_count++;
	
	//add new entry to DB
	mysql_select_db('344827_cidb', $db);
	$insert_new = 'INSERT INTO twitter_posts (feed_id, post_date, post_link, post_title, post_content, post_author) 
		VALUES ("'.$twitter_feedID.'", "'.$post_date.'", "'.$post_link.'", "'.$post_title.'", "'.$post_content.'", "'.$post_author.'")';
	$inserted_new = mysql_query($insert_new);

	if ($inserted_new) {

		//check to make sure it all worked.
		if (inserted_content) echo '<p>Everything is perfect: <a href="' .$post_link. '" target="_blank">' .$post_title. '</a> ['.$post_date.']</p>'; 
		else echo '<p>Content not saved: <a href="' .$post_link. '" target="_blank">' .$post_title. '</a> ['.$post_date.']</p>';
		
		}

	elseif (!$inserted_new) {
		echo '<p>Nothing was saved: <a href="' .$post_link. '" target="_blank">' .$post_title. '</a> ['.$post_date.']</p>';
		}
	}
?>