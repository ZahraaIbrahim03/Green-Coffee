<?php
    include '../components/connection.php';

    if(isset($_POST['register'])){

        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = $_POST['password'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        
        $cpass = $_POST['cpassword'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $img_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../image/' .$image;

        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
        $select_admin->execute([$email]);

        if($select_admin->rowCount() > 0) {
            $warning_msg[] = ' user email already exist';
        } else {
            if($pass  != $cpass){
                $warning_msg[] = 'confirm password not matched';
            }else{
                $insert_admin = $conn->prepare("INSERT INTO `admin`(id,name,email,
                password,profile) VALUES (?,?,?,?,?)");

                $insert_admin->execute([$id, $name, $email, $cpass, $image]);
                move_uploaded_file($img_tmp_name, $image_folder);
                $success_msg[] = 'new admin register';
            }
        }
    }
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href = 'https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel = 'stylesheet'>
    <link rel="stylesheet" type="text/css" href="admin-style.css?v=<?php echo time(); ?>">
    <title>Green Coffe Admin Panel - Register</title>
</head>
<body>
    <div class = "main-container">
        <section>
            <div class="form-container" id="admin-login">
                <form action="" method = "post" enctype = "multipart/form-data">
                    <h3>Register Now</h3>
                    <div class="input-field">
                        <label> User Name <sup>*</sup></label>
                        <input type = "text" name = "name" maxlength = "20" required placeholder = "
                        Enter your username" oninput = "this.value.replace(/\/g, '')">
                    </div>
                    <div class="input-field">
                        <label> User Email <sup>*</sup></label>
                        <input type="email" name = "email" maxlenghth = "20" required placeholder ="
                        Enter your email" oninput = "this.value.replace(/\/\g,'')">
                    </div>
                    <div class="input-field">
                        <label> User password <sup>*</sup></label>
                        <input type="password" name = "password" maxlenghth = "20" required placeholder ="
                        Enter your password" oninput = "this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field">
                        <label> Confrim password <sup>*</sup></label>
                        <input type="password" name = "cpassword" maxlenghth = "20" required placeholder ="
                        confirm your password" oninput = "this.value.replace(/\s/g,'')">
                    </div>

                    <div class="input-field">
                        <label> Select Profile<sup>*</sup></label>
                        <input type="file" name = "image" accept = "image/*" maxlenghth = "20" required placeholder ="
                        confirm your password" oninput = "this.value.replace(/\s/g,'')">
                    </div>
                    <button type = "submit" name = "register" class = "btn"> Register Now</button>
                    <p>Already have an account? <a href = "login.php" >Login Now!</a></p>
                </form>
            </div>
        </section>
    </div>

        <!-- sweetalert cdn link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!-- custom js link -->
        <script type = "text/javascript" src = "script.js"></script>
        <!-- alert -->
         <?php include '../components/alert.php'; ?>

</body>
</html>