<?php
include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin-style.css?v=<?php echo time(); ?>">
    <title>Green Coffee Admin Panel - Registered Users</title>
</head>
<body>
    <?php include '../components/admin_header.php'; ?> 
    <div class = "main">
        <div class="banner">
            <h1>Registered Users</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">Dashboard</a> <span>/ Registered Users</span>
        </div>
        <section class= "Accounts">
            <h1 class="heading">Registered Users</h1>
            <div class="box-container">
                <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();

                if($select_users-> rowCount() > 0){
                    while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                        $user_id = $fetch_users['id'];
                ?>
                <div class="box">
                    <p>User Id: <span><?= $user_id; ?></span></p>
                    <p>User Name: <span><?= $fetch_users['name']; ?></span></p>
                    <p>User Email: <span><?= $fetch_users['email']; ?></span></p>
                </div>
                <?php
                    }
                }else{
                echo' <div class ="empty">
                <p>No Users Registered yet!</p>
            </div>';
                }
                ?>
            </div>
        </section>
    </div>

    <!-- SweetAlert CDN link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Custom JS link -->
    <script type="text/javascript" src="script.js"></script>
    <!-- Alert -->
    <?php include '../components/alert.php'; ?>
</body>
</html>
