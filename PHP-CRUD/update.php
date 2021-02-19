<?php
    require_once 'functions.php';
    include ('parts/header.php');
    $row = update_get();
?>
<div class="container">
    <div class="col pt-5">
        <h2>Update data</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>" method="post">
            <div class="form-group mt-2">
                <label for="update_title">Title</label>
                <input type="text" name="update_title" class="form-control" id="update_title" placeholder="Title" value="<?php echo $row['title']; ?>" required>
                <small class="form-text text-muted">Make sure your title is unique</small>
            </div>
            <div class="form-group mt-2">
                <label for="update_content">Content</label>
                <textarea class="form-control" name="update_content" id="update_content" value="ad" cols="50" rows="4"><?php echo $row['content']; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-2">Submit</button>
        </form>  
        <hr>  
    </div>
</div>
<?php
    include ('parts/footer.php');
?>