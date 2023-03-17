<?php 
 
include 'koneksi.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = ($_POST['password']);
    $cpassword = ($_POST['cpassword']);
	$name = $_POST['name'];
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, password, name,)
                    VALUES ('$username', '$password', '$name')";
            $result = mysqli_query($conn, $sql);
            header("Location: login.php");
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
               
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style2.css">
 
    <title>Register</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-username">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <input class="form-control" placeholder="Username" name="username" type="text" value="<?php echo $username; ?>" required >
            <!-- <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
            </div> -->
            <input class="form-control mt-2" type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required >
            <input class="form-control mt-2" type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required >
            <input class="form-control mt-2" type="name" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
           
            <!-- <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
			<div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
            </div>
			<div class="input-group">
                <input type="name" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
            </div> -->
            <div class="input-group">
                <button name="submit" class="btn btn-primary mt-2"><a style="color: #FFFFFF; text-decoration: none;" href="index.html">Register</a></button>
            </div>
            <p class="login-register-text">Anda sudah punya akun? <a  href="login.php">Login </a></p>
        </form>
    </div>
</body>
</html>