<?php
require_once 'connection.php';

function get_all_data() {
    global $conn;
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0): ?>
        <div class="col-12 pt-5"><h1>All Posts</h1></div>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                    <div class="card-body">
                        <h4><a class="text-secondary text-decoration-none" href="single.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
                        <p class="card-text"><?php echo htmlspecialchars_decode(substr($row['content'], 0, 100)).'...'; ?></p>
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
        <?php endwhile; ?>
    <?php else: ?>
        <h3>Our database is not working.</h3>
    <?php endif; 
}
?>