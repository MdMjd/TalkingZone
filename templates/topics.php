<?php include('includes/header.php'); ?>
<ul id="topics">
  <!--Check for topics-->
  <?php if($topics) : ?>
  <!--Run the loop if there are topics present-->
  <?php foreach($topics as $topic) : ?>
  <li class="topic">
  <div class="row">
  <div class="col-md-2">
    <img class="avatar pull-left" src="images/avatars/<?php echo $topic->usr_avatar; ?>" />
  </div>
  <div class="col-md-10">
    <div class="topic-content pull-right">
      <h3><a href="topic.php?id=<?php echo $topic->tpc_id; ?>"><?php echo $topic->tpc_title; ?></a></h3>
      <div class="topic-info">
        <a href="topics.php?category=<?php echo urlFormat($topic->ca_id); ?>"><?php echo $topic->ca_name; ?></a> >>
        <a href="topics.php?user=<?php echo urlFormat($topic->usr_id); ?>"><?php echo $topic->usr_username ?></a> >>
        <?php echo formatDate($topic->tpc_create_date); ?>
        <span class="badge pull-right"><?php echo replyCount($topic->tpc_id); ?></span>
      </div>
    </div>
  </div>
</div>
</li>
<?php endforeach; ?>
</ul>
<?php else : ?>
<p> No Topics to Display</p>
<?php endif; ?>
<h3>Forum Statistics</h3>
<ul>
<li>Total Number of Users: <strong>52</strong></li>
<li>Total Number of Topics: <strong><?php echo $totalTopics; ?></strong></li>
<li>Total Number of Categories: <strong><?php echo $totalCategories; ?></strong></li>
</ul>
<?php include('includes/footer.php'); ?>
