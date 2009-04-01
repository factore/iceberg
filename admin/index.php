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
$source_select = $_POST['source_select'];
$post_select = $_POST['post_select'];
$approval_status = $_POST['approval_status'];
$widget_newTotal = $_POST['widget_total'];

//@ $db = mysql_pconnect('mysql50-31.wc1:3306', '344827_1c3b3rg', 's0c14lm3d14tr00p');
@ $db = mysql_connect('localhost', 'root', 'root');
//test connection
if (!$db) echo 'Error [index.php]:  Could not connect to the database.';
?>

<? //CHANGE TOTAL TO SHOW IN WIDGET ?>

<?
if($widget_newTotal) :
	mysql_select_db('344827_iceDEV', $db);
	$update_widgetNum = "UPDATE campaign_index SET widget_num = $widget_newTotal WHERE campaign_id = $campaign_select";
	//echo $update_widgetNum. ' - 1<br>';
	$updated_widgetNum = mysql_query($update_widgetNum);	
	$update_widget = 'Widget total has been updated';
endif;
?>



<? //APPROVE/REMOVE FOR/FROM WIDGET ?>

<?
if($post_select) :
	$approval_date = date('Y-m-d G:i:s');
	if($approval_status == 0) {
		$approval_status = 1;
		mysql_select_db('344827_iceDEV', $db);
		$update_approval = "UPDATE post_index 
									SET approval = $approval_status, approval_date = '$approval_date'
									WHERE post_id = $post_select";
		//echo $update_approval. ' - 1<br>';
		$updated_approval = mysql_query($update_approval);	
		$update_note = 'has been added'; 	
		}
	elseif($approval_status == 1) {
		$approval_status = 0;
		mysql_select_db('344827_iceDEV', $db);
		$update_approval = "UPDATE post_index 
									SET approval = $approval_status, approval_date = ''
									WHERE post_id = $post_select";
		//echo $update_approval. ' - 0<br>';
		$updated_approval = mysql_query($update_approval);		
		$update_note = 'has been removed'; 
		}
	$update_widget = '<div class="widget_update">' .$post_select. ' ' .$update_note. ' to the widget.</div>';
endif;
?>

<?= $update_widget ?>

<? //LOGIN & CONFIRM ?>

<? //DROPDOWN: SELECT A CAMPAIGN ?>
<div class="admin_wrap">
	<div class="campaign_wrap">
		<form class="admin_form" action="?" method="post" accept-charset="utf-8">
			<select class="admin_campaign" name="campaign_select">
			<option value="">Select a Campaign</option>
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
	</div>

	<? if($campaign_select) : ?>
		<? //DROPDOWN: SELECT A SOURCE ?>
		<div class="source_wrap">
		<form class="admin_form" action="?" method="post" accept-charset="utf-8">
			<select class="admin_source" name="source_select">
			<option value="">All Sources</option>
			<?
			mysql_select_db('344827_iceDEV', $db);
			$query_source = "SELECT source_index.*, campaign_index.widget_num FROM source_index 
									JOIN source_campaign ON source_index.source_id = source_campaign.source_id
									JOIN campaign_index ON source_campaign.campaign_id = campaign_index.campaign_id
									WHERE campaign_index.campaign_id = $campaign_select";
			echo $query_source;
			$result_source = mysql_query($query_source);
			while($row_source = mysql_fetch_array($result_source)) :
				$source_id = $row_source['source_id'];
				$source = $row_source['source'];
				$widget_total = $row_source['widget_num'];
				?>
			  	<option class="source_option" value="<?= $source_id ?>"<? if($source_select == $source_id) echo ' selected="selected"' ?>>
					<?= $source ?>
				</option>
			<? endwhile; ?>
			</select>
			<input type="hidden" value="<?= $campaign_select ?>" name="campaign_select">
			<input class="admin_submit" type="submit" value="Filter List">
		</form>
		</div>
		
		<div class="widget_total">
			<form action="?" method="post" accept-charset="utf-8">
				Number of posts to appear on the widget: <input type="text" value="<?= $widget_total ?>" name="widget_total">
				<input class="widget_submit" type="submit" value="Update total">
				<input type="hidden" value="<?= $campaign_select ?>" name="campaign_select">
				<input type="hidden" value="<?= $source_select ?>" name="source_select">
			</form>
		</div>	
	<? endif; ?>
</div>

<? //COMPILE LIST ?>
<div id="wrap_li">
	<?
	mysql_select_db('344827_iceDEV', $db);
	if($source_select) $query_li = "SELECT * FROM post_index WHERE source_id = $source_select ORDER BY pull_date DESC";
	elseif($campaign_select) $query_li = "SELECT * FROM post_index 
												JOIN source_campaign ON post_index.source_id = source_campaign.source_id
												WHERE source_campaign.campaign_id = $campaign_select ORDER BY pull_date DESC";
	//echo $query_li;
	$result_li = mysql_query($query_li);
	$image_url = '';
	while($row_li = mysql_fetch_array($result_li)) :
		$post_id = $row_li['post_id'];
		$content = $row_li['content'];
		$url = $row_li['url'];
		$pull_date = $row_li['pull_date'];
		$image_url = $row_li['image_url'];
		$approval = $row_li['approval'];
		$approval_date = $row_li['approval_date'];
		?>
	  	<form class="admin_li" action="?" method="post" accept-charset="utf-8">
		
		<div class="item_li <? if($approval == 0) echo 'public'; elseif($approval == 1) echo 'private';  ?>">
			<a href="<?= $url ?>" target="_blank">
				<? if($image_url) { ?> <img src="<?= $image_url ?>" class="item_img"> <? } ?>
				<span class="item_content"><?= $content ?></span>
				<span class="item_date"><?= $pull_date ?></span>
			</a>
			<input class="admin_submit" type="submit" value="
				<? if($approval == 0) echo 'Add to widget'; 
				elseif($approval == 1) echo 'Remove from widget'; ?>">
		</div>
		
		<input type="hidden" value="<?= $approval ?>" name="approval_status">
		<input type="hidden" value="<?= $campaign_select ?>" name="campaign_select">
		<input type="hidden" value="<?= $source_select ?>" name="source_select">
		<input type="hidden" value="<?= $post_id ?>" name="post_select">
		</form>
	<? endwhile; ?>
	</form>
</div>

</body>
</html>
