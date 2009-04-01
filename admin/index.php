<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Iceberg Widget - Client Admin</title>

<link href="/css/display.css" rel="stylesheet" type="text/css">

</head>

<body>
<?

$campaign_select = $_POST['campaign_select'];
//echo $campaign_select. '<br>';
$source_select = $_POST['source_select'];

//@ $db = mysql_pconnect('mysql50-31.wc1:3306', '344827_1c3b3rg', 's0c14lm3d14tr00p');
@ $db = mysql_pconnect('localhost', 'root', 'root');
//test connection
if (!$db) echo 'Error [index.php]:  Could not connect to the database.';
?>

<? //LOGIN & CONFIRM ?>

<? //DROPDOWN: SELECT A CAMPAIGN ?>
<div class="admin_wrap">
<form class="admin_form" action="?" method="post" accept-charset="utf-8">
	<select class="admin_campaign" name="campaign_select">
	<?
	mysql_select_db('344827_iceDEV', $db);
	$query_campaign = "SELECT * FROM campaign_index WHERE client_id = 1";
	$result_campaign = mysql_query($query_campaign);
	while($row_campaign = mysql_fetch_array($result_campaign)) :
		$campaign_id = $row_campaign['campaign_id'];
		$campaign = $row_campaign['campaign'];
		?>
	  <option class="campaign_option" value="<?= $campaign_id ?>"><?= $campaign ?></option>
	<? endwhile; ?>
	</select>
	<input class="admin_submit" type="submit" value="Compile List">
</form>

<? if($campaign_select) : ?>
	<? //DROPDOWN: SELECT A SOURCE ?>
	<form class="admin_form" action="?" method="post" accept-charset="utf-8">
		<select class="admin_source" name="source_select">
		<?
		mysql_select_db('344827_iceDEV', $db);
		$query_source = "SELECT source_index.* FROM source_index 
								JOIN source_campaign ON source_index.source_id = source_campaign.source_id
							JOIN campaign_index ON source_campaign.campaign_id = campaign_index.campaign_id
							WHERE campaign_index.campaign_id = $campaign_select";
	echo $query_source;
	$result_source = mysql_query($query_source);
	while($row_source = mysql_fetch_array($result_source)) :
		$source_id = $row_source['source_id'];
		$source = $row_source['source'];
		?>
	  	<option class="source_option" value="<?= $source_id ?>"<? if($source_select == $source_id) echo ' selected="selected"' ?>>
			<?= $source ?>
		</option>
	<? endwhile; ?>
	</select>
	<input type="hidden" value="<?= $campaign_select ?>" name="campaign_select">
	<input class="admin_submit" type="submit" value="Filter List">
</form>
<? endif; ?>
</div>

<? //COMPILE LIST ?>
<div class="wrap_li">
	<?
	mysql_select_db('344827_iceDEV', $db);
	$query_li = "SELECT * FROM post_index WHERE source_id = $source_select ORDER BY pull_date DESC";
	//echo $query_li;
	$result_li = mysql_query($query_li);
	while($row_li = mysql_fetch_array($result_li)) :
		$post_id = $row_li['post_id'];
		$content = $row_li[''];
		$url = $row_li[''];
		$pull_date = $row_li[''];
		$image_url = $row_li[''];
		$approval = $row_li[''];
		$approval_date = $row_li[''];
		?>
	  	<form class="admin_li" action="?" method="post" accept-charset="utf-8">
		<?= $post_id ?>
		<input type="hidden" value="<?= $campaign_select ?>" name="campaign_select">
		<input type="hidden" value="<?= $source_select ?>" name="source_select">
		<input class="admin_submit" type="submit" value="Approve">
		</form>
	<? endwhile; ?>
	</form>
</div>


</body>
</html>
