<?php include('includes/header.php'); ?>
<!--Create Topics Form using the name as the style is the name-->
<ul id="topics">
  <li id="main-topic" class="topic topic">
    <div class="row">
      <div class="col-md-2">
        <div class="user-info">
          <img class="avatar pull-left" src="<?php echo BASE_URI; ?>images/avatars/<?php echo $topic->usr_avatar; ?>" />
          <ul>
            <li><strong><?php echo $topic->usr_username; ?></strong></li>
            <li><?php echo userPostCount($topic->usr_id); ?> Posts</li>
            <li><a href="<?php echo BASE_URI; ?>topics.php?user=<?php echo $topic->usr_id; ?>">View topics</a>
          </ul>
        </div>
      </div>
      <div class="col-md-10">
        <div class="topic-content pull-right">
          <?php echo $topic->tpc_body; ?>
        </div>
      </div>
    </div>
  </li>
  <?php foreach($replies as $reply) : ?>
  <li class="topic topic">
    <div class="row">
      <div class="col-md-2">
        <div class="user-info">
          <img class="avatar pull-left" src="<?php echo BASE_URI; ?>images/avatars/<?php echo $reply->usr_avatar; ?>" />
          <ul>
            <li><strong><?php echo $reply->usr_username; ?></strong></li>
            <li><?php echo userPostCount($reply->usr_id); ?> Posts</li>
            <li><a href="<?php echo BASE_URI; ?>topics.php?user=<?php echo $reply->usr_id; ?>">View Topics</a>
          </ul>
        </div>
      </div>
      <div class="col-md-10">
        <div class="topic-content pull-right">
          <?php echo $reply->rep_body; ?>
        </div>
      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>
<!--Reply Section-->
<h3>Reply To Topic</h3>
<?php if (isLoggedIn()): ?>
  <form role="form" method="post" action="topic.php?id=<?php echo $topic->tpc_id; ?>">
    <div class="form-group">
      <textarea id="reply" rows="10" cols="80" class="form-control" name="body"></textarea>
        <script>
          CKEDITOR.replace( 'reply' );
        </script>
    </div>
    <button name="do_reply" type="submit" class="btn btn-default">Submit</button>
  </form>
<?php else: ?>
  <p>Please Log in to Reply.</p>
<?php endif; ?>
<?php include('includes/footer.php'); ?>
