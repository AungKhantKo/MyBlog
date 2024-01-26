<?php

    include "layouts/side_nav.php";
    require "../dbconnect.php";

    $sql = "SELECT *FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
?>


        <main>
            <div class="container-fluid px-4">
             <div class="mt-3">
                <h1 class="mt-4 d-inline">Users</h1>
                <a href="users.php" class="btn btn-lg btn-danger float-end">Cancel</a>
             </div>  
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="users.php">Users</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Add User
                    </div>
                    <div class="card-body">
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Roles</label>
                                <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                                    <option selected>Choose...</option>
                                    <?php 
                                        foreach ($users as $user) {
                                    ?>

                                    <option value="<?= $user['id']?>"><?= $user['role'] ?></option>

                                    <?php }?>
                                </select>
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