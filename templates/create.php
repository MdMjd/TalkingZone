<?php include('includes/header.php'); ?>
<!--Create Topic Form-->
<form role="form" method="post" action="create.php">
  <div class="form-group">
    <label>Topic Title</label>
    <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
  </div>
  <div class="form-group">
    <label>Category</label>
    <select class="form-control" name="category">
      <?php foreach (getCategories() as $category): ?>
      <option value="<?php echo $category->ca_id; ?>"><?php echo $category->ca_name; ?></option>
      <?php endforeach; ?>
  </select>
  </div>
    <div class="form-group">
      <label>Topic Body</label>
      <textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
      <script>CKEDITOR.replace('body');</script>
    </div>
  <button name="do_create" type="submit" class="btn btn-default">Submit</button>
</form>
<?php include('includes/footer.php'); ?>
