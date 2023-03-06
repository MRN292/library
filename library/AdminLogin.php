<?php

require 'CRUD.php';
session_start();



$Err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $tmp = $_POST['username'];
    $tmp2 = hash('md5', $_POST['password']);
    $query = SpecialRead("library", 'Admins', 'password', 'username', $tmp);
    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['password'] == $tmp2) {

                // $_SESSION["user"] = $username;
                // $_SESSION["login_time_stamp"] = time();
                header("Location:admin.php");
                


            }else{
                $Err = "نام کاربری یا کلمه عبور اشتباه است";
            }
        }
    } else {
        $Err = "نام کاربری یا کلمه عبور اشتباه است";
    }
}

?>



<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" dir="rtl">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود مدیر</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body>
    <div class="conrainer my-5 ">
        <center>
            <h2>ورود مدیر</h2>
        </center>
        <br>


        <?php
        if (!empty($Err)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$Err</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        ?>


        <form method="post" enctype='multipart/form-data'
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <center style="margin-right:29.5%">
                <div class="d-flex">
                    <label class="col-sm-1 col-form-label">نام کاربری :</label>
                    <div class="col-sm-5">
                        <input dir="ltr" type="text" class="form-control" name="username"   value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>">
                    </div>
                </div>


                <div class="d-flex" style="margin-top:0.5%">
                    <label class="col-sm-1 col-form-label">کلمه عبور :</label>
                    <div class="col-sm-5">
                        <input dir="ltr" type="password" class="form-control" name="password"   value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
                    </div>
                </div>
            </center>
            

            <center style="margin-top:0.5%">
                <div class="col-sm-3 d-grid " style="margin-top:0.1%">
                    <button type="submit" class="btn btn-outline-primary">ورود</button>
                </div>
            </center>

        </form>

    </div>
</body>

</html>