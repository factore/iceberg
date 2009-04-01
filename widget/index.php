<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Iceberg Widget - Populate</title>

<link href="/css/display.css" rel="stylesheet" type="text/css">
<script language="javascript" src="jquery.js"></script>
<script language="javascript">
  jQuery(function() {
    jQuery('#campaign_select').click(function() {
      if(this.value != "")
        location.href = "index.php?campaign_id=" + this.value;
      });
  });
</script>


</head>

<body>
<?

//PULL IN ALL THE FEEDS AND RUN
//@ $db = mysql_pconnect('localhost:3306', '344827_1c3b3rg', 's0c14lm3d14tr00p');
@ $db = mysql_pconnect('localhost:3306', 'root', 'root');
//test connection
if (!$db) echo 'Error [index.php]:  Could not connect to the database.';

mysql_select_db('344827_iceDEV', $db);

$client_id =  1; //dynamically change later

$query_campaigns = "SELECT distinct campaign_id, campaign
                from campaign_index
                where client_id = $client_id";

$result_campaigns = mysql_query($query_campaigns);

?>
  <div id="widget_container">
    <div id="campaign_select_container">
      <select id="campaign_select">
        <option value="">Select a Campaign</option>
        <?
          while($row_campaigns = mysql_fetch_array($result_campaigns))  {
            echo("<option value=\"{$row_campaigns['campaign_id']}\">{$row_campaigns['campaign']}</option>");
          }
        ?>
      </select>
    </div>
    <div id="campaign_posts_container">

      <?
        if(isset($_GET['campaign_id'])) {



          $query_campaign = "SELECT widget_num, campaign
                  from campaign_index
                  where campaign_id = {$_GET['campaign_id']}";

          $result_campaign = mysql_query($query_campaign);
          $campaign_details = mysql_fetch_array($result_campaign);
          $limit = $campaign_details['widget_num'];
          $campaign_title = $campaign_details['campaign'];

          echo "<div id='campaign_title'>" . $campaign_title . "</div>";

          $query_posts =  "Select post_index.content, post_index.url, post_index.image_url, source_index.type as source_type
                        from post_index
                        inner join source_campaign on post_index.source_id = source_campaign.source_id
                        inner join campaign_index on source_campaign.campaign_id = campaign_index.campaign_id
                        inner join source_index on post_index.source_id = source_index.source_id
                        where campaign_index.campaign_id = {$_GET['campaign_id']}
                        and approval = 1
                        order by post_index.approval_date DESC
                        limit {$limit}";

          $result_posts = mysql_query($query_posts);

          while($row_posts = mysql_fetch_array($result_posts)) { ?>

            <div class="post">
              <? if($row_posts['image_url'] != "") : ?>
                <div class="post_image"><img src='<? echo $row_posts['image_url'] ?>' /></div>
              <? endif; ?>
              <div class="post_body"><a target="new" href='<? echo $row_posts['url'] ?>'><? echo $row_posts['content'] ?></a></div>
            </div>


          <?}
          }
      ?>

    </div>




  </div>

</body>
</html>
