<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Twitter Widget - Populate</title>

<link href="/css/display.css" rel="stylesheet" type="text/css">

</head>

<body>
<?

$type = $_POST['type'];
$feed = $_POST['feed'];

?>

<form action="?" method="post" accept-charset="utf-8">
	<p>
		Feed: <input type="text" name="feed" value="<?= $feed ?>">
	</p>
	<p>
		Type: <input type="text" name="type" value="<?= $type ?>"> - 1a/1b=blog, 2=twitter, 3=flickr, 4=youtube, 5=delicious
	</p>
	<p>
		<input type="submit" value="Test">
	</p>
</form>

<?
//BLOG
if ($type == '1a' || $type == '1b') :
	//GRAB RSS FEEDS
	require_once 'rss_fetch.php';
	$rss = fetch_rss($feed);

	echo '<h2>Site: Blog - '.$feed. '</h2>';

	$result_count  = 0;
	
	foreach ($rss->items as $item) :

		// grab each element - RSS 2.0
		$content = addslashes($item[title]); // title of post
		
		$feed = addslashes($item[link]); // link to post via feed
		$guid = $item[guid]; // post url
		
		//determine which post url to use
		if ($type == '1a') $url = $feed;
		elseif ($type == '1b') $url = $guid;
	 	else $url = $feed;
	
		//test the url for structure
		$url_test = substr_count($url , 'http://');
		if ($url_test == 0) {
			//if it's just a permalink, add the blog url to the permalink
			$clean_blogUrl = rtrim($blog_url, '/');
			$url = $clean_blogUrl .'/'. $url;
			}	
	
		//grab each type of feed date
		if ($item['pubdate']) {//RSS2
			$date = $item['pubdate'];
			}

		if ($item['dc']['date']) { //RSS1
		 	$date = $item['dc']['date']; 
			}
	
		if ($item['updated']) { //ATOM
			$date = $item['updated']; 
			}
		
		//if there is no date, add this to the db
		if (!$pubdate) $pubdate = 'No Date :(';
		$pubdate = addslashes($pubdate);	

		echo $count. '. <br>
			date: ' .$date. '<br>
			url: <a href="' .$url. '" target="_blank">' .$url. '</a><br>
			content: ' .$content. '<br>
			image: <a href="' .$image. '" target="_blank">' .$image. '</a><br><br>';
				
		//ADD TO DB
		//include ('rss_add.php');
	endforeach;


//TWITTER
elseif ($type == '2') : 
	//GRAB RSS FEEDS
	require_once 'rss_fetch.php';
	$rss = fetch_rss($feed);

	echo '<h2>Site: Twitter - '.$feed. '</h2>';

	$count = '';

	foreach ($rss->items as $item) :
		$count++;
		$date = $item['published'];
		$date = str_replace('T', ' ', $post_date);
		$date = str_replace('Z', '', $post_date);
		
		$url = $item['link'];
		$content  = $item['title'];
	
		$image = $item['link'];
	
		echo $count. '. <br>
			date: ' .$date. '<br>
			url: <a href="' .$url. '" target="_blank">' .$url. '</a><br>
			content: ' .$content. '<br>
			image: <a href="' .$image. '" target="_blank">' .$image. '</a><br><br>';
		
		//ADD TO DB
		//include ('rss_add.php');
	endforeach;

//FLICKR
elseif ($type == '3') :
	//GRAB RSS FEEDS
	require_once 'rss_fetch.php';
	$rss = fetch_rss($feed);

	echo '<h2>Site: Flickr - '.$feed. '</h2>';

	$count = '';

	foreach ($rss->items as $item) :
		$count++;
		
		$content  = $item['title'];
		$url = $item['link'];

		$image = $item['description'];
		$image = str_replace('<a', '<p', $image);
		$image = explode('<img src="', $image);
		$image = explode('" width=', $image[1]);
		$image = $image[0];
		$image = str_replace('_m.jpg', '_t.jpg', $image);

		$date = $item['pubDate'];
		//Convert $date to datetime
		//Tue, 10 Feb 2009 19:52:01 -0800

		echo $count. '. <br>
			date: ' .$date. '<br>
			url: <a href="' .$url. '" target="_blank">' .$url. '</a><br>
			content: ' .$content. '<br>
			image: <a href="' .$image. '" target="_blank">' .$image. '</a><br><br>';
	
		//ADD TO DB
		//include ('rss_add.php');
	endforeach;


//YOUTUBE
elseif ($type == '4') :
	//GRAB RSS FEEDS
	require_once 'rss_fetch.php';
	$rss = fetch_rss($feed);

	echo '<h2>Site: Youtube - '.$feed. '</h2>';

	$count = '';

	foreach ($rss->items as $item) :
		$count++;
	
		$date = $item['pubDate'];
		//Convert $date to datetime
		//Wed, 11 Mar 2009 10:53:49 -0700
		
		$content  = $item['title'];
    $url = $item['link'];

		$image = $item['description'];
		$image = str_replace('<a', '<p', $image);
		
		$image = explode('<img src="', $image);
		$image = explode('" align=', $image[1]);
		$image = $image[0];
		
		
		echo $count. '. <br>
			date: ' .$date. '<br>
			url: <a href="' .$url. '" target="_blank">' .$url. '</a><br>
			content: ' .$content. '<br>
			image: <a href="' .$image. '" target="_blank">' .$image. '</a><br><br>';

		//ADD TO DB
		//include ('rss_add.php');
	endforeach;


//DELICIOUS
elseif ($type == '5') :

endif;

?>
	
</body>
</html>
