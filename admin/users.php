<?php

    include "layouts/side_nav.php";
    require "../dbconnect.php";
    $sql = "SELECT * FROM users";
    // echo $sql;
    // $stmt = $conn->query($sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    // var_dump($posts); 
?>


        <main>
            <div class="container-fluid px-4">
             <div class="mt-3">
                <h1 class="mt-4 d-inline">Users</h1>
                <a href="add_users.php" class="btn btn-lg btn-primary float-end">Add User</a>
             </div>  
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Users
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Passwrod</th>                                   
                                    <th>Role</th>
                                    <th>Create_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Passwrod</th>                                   
                                    <th>Role</th>
                                    <th>Create_at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                           <tbody>
                                <?php 
                                    foreach ($users as $user) {
                                ?>
                                <tr>
                                    <td><?= $user['name']?></td>
                                    <td><?= $user['email']?></td>
                                    <td><?= $user['password']?></td>
                                    <td><?= $user['role']?></td>
                                    <td><?= $user['created_at']?></td>
                                    <td>

                                        <button class="btn btn-sm btn-outline-warning">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>

                                    </td>
                                </tr>
                                <?php }?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
                
<?php

    include "layouts/footer.php"

?>