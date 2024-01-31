<?php
    require "../dbconnect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['postID'];
        // echo $id;
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt ->bindParam(':id',$id);
        $stmt->execute();
        header("location: posts.php");

    }else{

    include "layouts/side_nav.php";
    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name  FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id = posts.user_id";
    
    // echo $sql;
    // $stmt = $conn->query($sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
    // var_dump($posts);
    } 
?>


        <main>
            <div class="container-fluid px-4">
             <div class="mt-3">
                <h1 class="mt-4 d-inline">Posts</h1>
                <a href="create_post.php" class="btn btn-lg btn-primary float-end">Creat Post</a>
             </div>  
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Posts</li>
                </ol>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Posts
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>Category</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>Category</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                           <tbody>
                                <?php 
                                    foreach ($posts as $post) {
                                ?>
                                <tr>
                                    <td><?= $post['title']?></td>
                                    <td><?= $post['u_name']?></td>
                                    <td><?= $post['c_name']?></td>
                                    <td>

                                        <a href="../detail.php?postID=<?= $post['id']?>" class="btn btn-sm btn-outline-primary" target="_blank">Details</a>
                                        <button class="btn btn-sm btn-outline-warning">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger delete" data-post_id=<?= $post['id']?> >Delete</button>

                                    </td>
                                </tr>
                                <?php }?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    <!-- Modal -->
    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form action="" method="post">
                    <input type="hidden" name="postID" id="postID">
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
                
            </div>
            </div>
        </div>
    </div>
                
<?php

    include "layouts/footer.php"

?>