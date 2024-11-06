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
    <title>Green Coffee Admin Panel - Dashboard</title>
</head>
<body>
    <?php include '../components/admin_header.php'; ?> 
    <div class = "main">
        <div class="banner">
            <h1>Dashboard</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">Home</a> <span>/ Dashboard</span>
        </div>
        <section class= "dashboard">
            <h1 class="heading">Dashboard</h1>
            <div class="box-container">
                <div class="box">
                    <h3>Welcome</h3>
                    <p><?= $fetch_profile['name'] ?></p>
                    <a href="#" class="btn">Profile</a>
                </div>
                <div class="box">
                <?php
                    $select_product = $conn->prepare("SELECT * FROM `products`");
                    $select_product->execute();
                    $num_of_products = $select_product->rowCount();
                    ?>
                    <h3><?= $num_of_products; ?></h3>
                    <p>Products Added</p>
                    <a href="add_products.php" class="btn">Add new Products</a>

                </div>
                <div class="box">
                    <?php
                    $select_active_product = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
                    $select_active_product->execute(['active']);
                    $num_of_active_products = $select_active_product->rowCount();
                    ?>
                    <h3><?= $num_of_active_products; ?></h3>
                    <p>Total Active Products</p>
                    <a href="view_product.php" class="btn">View Active Products</a>
                </div>
                <div class="box">
                    <?php
                    $select_deactive_product = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
                    $select_deactive_product->execute(['deactive']);
                    $num_of_deactive_products = $select_deactive_product->rowCount();
                    ?>
                    <h3><?= $num_of_deactive_products; ?></h3>
                    <p>Total Deactive Products</p>
                    <a href="view_product.php" class="btn">View Deactive Products</a>
                </div>
                <div class="box">
                    <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $num_of_users = $select_users->rowCount();
                    ?>
                    <h3><?= $num_of_users; ?></h3>
                    <p>Registered Users</p>
                    <a href="user_account.php" class="btn">View Users</a>
                </div>
                <div class="box">
                    <?php
                    $select_admin = $conn->prepare("SELECT * FROM `admin`");
                    $select_admin->execute();
                    $num_of_admin = $select_admin->rowCount();
                    ?>
                    <h3><?= $num_of_admin; ?></h3>
                    <p>Registered Admin</p>
                    <a href="user_account.php" class="btn">View Admins</a>
                </div>
                <div class="box">
                    <?php
                    $select_message = $conn->prepare("SELECT * FROM `message`");
                    $select_message->execute();
                    $num_of_message = $select_message->rowCount();
                    ?>
                    <h3><?= $num_of_message; ?></h3>
                    <p>Unread Message</p>
                    <a href="admin_message.php" class="btn">View Message</a>
                </div>
                <div class="box">
                    <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders`");
                    $select_orders->execute();
                    $num_of_orders = $select_orders->rowCount();
                    ?>
                    <h3><?= $num_of_orders; ?></h3>
                    <p>Total Orders Placed</p>
                    <a href="order.php" class="btn">View Orders</a>
                </div>
                <div class="box">
                    <?php
                    $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                    $select_confirm_orders->execute(['in progress']);
                    $num_of_confirm_orders = $select_confirm_orders->rowCount();
                    ?>
                    <h3><?= $num_of_confirm_orders; ?></h3>
                    <p>Total Confirmed Orders</p>
                    <a href="order.php" class="btn">View Confirmed Orders</a>
                </div>
                <div class="box">
                    <?php
                    $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                    $select_canceled_orders->execute(['canceled']);
                    $num_of_canceled_orders = $select_canceled_orders->rowCount();
                    ?>
                    <h3><?= $num_of_canceled_orders; ?></h3>
                    <p>Total Canceled Orders</p>
                    <a href="order.php" class="btn">View Canceled Orders</a>
                </div>

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
