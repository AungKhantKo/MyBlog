<?php

    include "layouts/side_nav.php";
    require "../dbconnect.php";

    $sql = "SELECT *FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
?>


        <main>
            <div class="container-fluid px-4">
             <div class="mt-3">
                <h1 class="mt-4 d-inline">Categories</h1>
                <a href="posts.php" class="btn btn-lg btn-danger float-end">Cancel</a>
             </div>  
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="categories.php">Categories</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Create Category
                    </div>
                    <div class="card-body">
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Category title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
                
<?php

    include "layouts/footer.php"

?>