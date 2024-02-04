<?php
    require "../dbconnect.php";
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['catID'];
        // echo $id;
        $sql="DELETE FROM categories WHERE id = :id";
        $sql= $conn->prepare($sql);
        $sql->bindParam(':id',$id);
        $sql->execute();
        header("location: categories.php");

    }else{

    include "layouts/side_nav.php";
    $sql = "SELECT * FROM categories";
   
    // echo $sql;
    // $stmt = $conn->query($sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    // var_dump($categories); 
    }
?>


        <main>
            <div class="container-fluid px-4">
             <div class="mt-3">
                <h1 class="mt-4 d-inline">Categories</h1>
                <a href="create_category.php" class="btn btn-lg btn-primary float-end">Create Categories</a>
             </div>  
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                                    <th>No</th>
                                    <th>Category</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                           <tbody>
                                <?php 
                                    foreach ($categories as $category) {
                                ?>
                                <tr>
                                    <td><?= $category['id']?></td>
                                    <td><?= $category['name']?></td>
                                    <td>

                                        <button class="btn btn-sm btn-outline-warning">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger delete" data-post_id=<?= $category['id']?>>Delete</button>

                                    </td>
                                </tr>
                                <?php }?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
          
        <!-- Delete Modal -->
        <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure delete?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="" method="post">
                        <input type="hidden" name="catID" id="catID">
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                    
                </div>
                </div>
            </div>
        </div>

<?php

    include "layouts/footer.php"

?>

