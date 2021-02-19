<?php
require_once 'connection.php';

// read all data
function get_all_data() {
    global $conn; 
    $sselect_query = "SELECT * FROM posts";
    $results = mysqli_query($conn, $sselect_query);
    if (mysqli_num_rows($results) > 0): ?>
        <div class="col-12 pt-5 mb-2 text-center"><h1>All Posts</h1></div>
            <?php while ($row = mysqli_fetch_assoc($results)): ?>
                <!-- one card start -->
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                        <div class="card-body" >
                            <div style="height:120px;">
                                <h4><a class="text-muted text-decoration-none" href="single.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
                                <p class="card-text"><?php echo htmlspecialchars_decode(substr($row['content'], 0, 40)).'...'; ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="single.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary" role="button" aria-pressed="true">View</a>
                                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-secondary" role="button" aria-pressed="true">Edit</a>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>   
                </div> 
                <!-- one card end  -->
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <h3>Our database is not working.</h3>
    <?php endif; 
}

// create one data
if(isset($_POST['title']) && isset($_POST['content'])) {
    // check title and content empty or not
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        // escape special characters.
        $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
        $content = mysqli_real_escape_string($conn, htmlspecialchars($_POST['content']));
        // check if title already exists
        $check_content = mysqli_query($conn, "SELECT 'title' FROM posts WHERE content='$title'");
        if (mysqli_num_rows($check_content) > 0) {
            echo "<h3>This title already exists - please try a different title name</h3>";
        } else {
            // insert data into database
            $insert_query = "INSERT INTO posts (title, content) VALUES ('$title','$content')";
            $result = mysqli_query($conn, $insert_query);
            // now check if data had been inserted
            if($result) : ?>
                <script>alert('Data inserted');window.location.href = 'index.php';</script>
                <?php
                exit;
            else: ?>
                <h3>Data was not inserted</h3>
            <?php endif;
        }

    } else { ?>
        <h4>Plese fill all fields</h4>
    <?php }
}

// update.php - collect data 
function update_get() {
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        global $conn;
        $id = $_GET['id'];
        $sql = "SELECT * FROM posts WHERE id='$id'";
        $get_id = mysqli_query($conn, $sql);

        if(mysqli_num_rows($get_id) === 1) {
            $row = mysqli_fetch_assoc($get_id);
            return($row);
        }
    }
}

// update.php - update data
if(isset($_POST['update_title']) && isset($_POST['update_content'])) {
    // check if items are empty
    if (!empty($_POST['update_title']) && !empty($_POST['update_content'])) {
        // escape special characters.
        $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['update_title']));
        $content = mysqli_real_escape_string($conn, htmlspecialchars($_POST['update_content']));
        $id = $_GET['id'];
        $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
        $update_query = mysqli_query($conn, $sql);

        if($update_query): ?>
            <script>alert('Post updated');window.location.href = 'index.php';</script>
            <?php
            exit;
         else: ?>
            <h3>Sorry, that didn't work</h3>
        <?php endif;

    } else { ?>
        <h4>Plese fill all fields</h4>
    <?php }
}
?>
