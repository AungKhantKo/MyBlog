<?php

    
    require "../dbconnect.php";

    $id = $_GET['userID'];
    
    $sql = "SELECT * FROM users WHERE users.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(':id', $id);
    $stmt -> execute();
    $user =  $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($user);
    // die();  


    if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST ['name'];
    $email = $_POST ['email'];
    $password = $_POST ['password'];
    $role = $_POST ['role'];
    
    // echo "$name and $email and $password and $role";
    // die();

    // $sql = "INSERT INTO users (name,email,password,role) VALUES (:name, :email, :password, :role)";
    $sql = "UPDATE users SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    $stmt->execute();

    header("location: users.php");

    } else {

        include "layouts/side_nav.php";
        $sql = "SELECT *FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();

    }
?>


        <main>
            <div class="container-fluid px-4">
             <div class="mt-3">
                <h1 class="mt-4 d-inline">Edit Users</h1>
                <a href="users.php" class="btn btn-lg btn-danger float-end">Cancel</a>
             </div>  
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="users.php">Users</a></li>
                    <li class="breadcrumb-item active">Edit Users</li>
                </ol>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Edit User
                    </div>
                    <div class="card-body">
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= $user['password'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Roles</label>
                                <select class="form-select" id="role" name="role" aria-label="Default select example">
                                    
                                    

                                    <option value="Author" <?= $user['role'] == 'Author'? 'selected': ''; ?>>Author</option>
                                    <option value="Admin" <?= $user['role'] == 'Admin'? 'selected': ''; ?>>Admin</option>


                                    
                                </select>
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

    include "layouts/footer.php"

?>