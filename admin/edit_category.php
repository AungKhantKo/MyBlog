<?php

    session_start();
    if(isset($_SESSION['user_id'])){
    
    require "../dbconnect.php";

    $id = $_GET['catID'];
    
    $sql = "SELECT * FROM categories WHERE categories.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(':id', $id);
    $stmt -> execute();
    $category =  $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($category);
    // die();  

    if($_SERVER['REQUEST_METHOD'] == "POST"){

    $title = $_POST['title'];

    // echo "$title";
    // die();

    // $sql = "INSERT INTO categories (name) VALUES (:title)";
    $sql= "UPDATE categories SET name = :title WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->execute();

    header("location: categories.php");

    } else{
        
        include "layouts/side_nav.php";
        $sql = "SELECT *FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
    }
?>


        <main>
            <div class="container-fluid px-4">
             <div class="mt-3">
                <h1 class="mt-4 d-inline">Edit Categories</h1>
                <a href="categories.php" class="btn btn-lg btn-danger float-end">Cancel</a>
             </div>  
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="categories.php">Categories</a></li>
                    <li class="breadcrumb-item active">Edit Categories</li>
                </ol>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Edit Category
                    </div>
                    <div class="card-body">
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Category title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $category['name'] ?>">
                            </div>                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
                
<?php

    include "layouts/footer.php";
    }else{
        header('location: ../index.php');
    }

?>