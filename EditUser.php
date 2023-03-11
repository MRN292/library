<?php

// echo $_SESSION['username'];

require 'FUNC_VALID.php';
require 'CRUD.php';
if(VALID_SESSION('user')==false){
    SESSION_DESTROYER();
    
    header("Location:index.php");
}

// session_start();
$usernameErr = $emailErr = $passwordErr = $imgErr = "";
$Tid = $Tusername = $Temail = $Tpassword = $Timg = "";
if (isset($_POST["edituser"])) {
    $quary = SpecialRead("library", "users", "*", "username", $_POST['edituser']);
    echo  $_POST['edituser'];
    while ($res = mysqli_fetch_assoc($quary)) {
        $Tid = $res['id'];
        $Tusername = $res['username'];
        $Temail = $res['email'];
        $Timg = $res['img'];
        $Tpassword = $res['password'];
    }
}



if (isset($_POST['edit'])) {




    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['edit'];

        // echo $_POST['edit'];

        // "SELECT $what from $table where $where='$input'";
        $quary = SpecialRead("library", "users", "*",'id' ,$id);
        while ($res = mysqli_fetch_assoc($quary)) {
            $Timg = $res['img'];
        }
        $flag = false;

        $username = VALID_USER($_POST['username']);
        if (is_array($username)) {
            $usernameErr = $username[1];
            $flag = $username[0];
        }

        $email = VALID_EMAIL($_POST['email']);
        if (is_array($email)) {
            $emailErr = $email[1];
            $flag = $email[0];
        }

        $img = '';
        if ($flag == false) {
            $img = basename($_FILES['fileToUpload']['name']);
            if (!empty($img)) {
                $img = VALID_IMG($_FILES['fileToUpload']);
                if (is_array($img)) {
                    $imgErr = $img[1];
                    $flag = $img[0];
                }
            } else {
                $img = $Timg;
            }
        }


        if ($flag == false) {

            // echo $Timg;
            // echo $username , $email , $img ;

            Update('library', 'users', 'username', $username, $id);
            Update("library", "users", "email", $email, $id);
            Update("library", "users", "img", $img, $id);
            header("Refresh:0; url=user.php?username=".$username);




        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش اطلاعات کاربری</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body>
    <div class="conrainer my-5">



        <?php
        if (!empty($usernameErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$usernameErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        if (!empty($emailErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$emailErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";
        }
        if (!empty($passwordErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$passwordErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        if (!empty($imgErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$imgErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }

        ?>

        <center>
            <h2>ثبت نام</h2>
        </center>
        <br>

        <form method="post" enctype='multipart/form-data'
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


            <center style="margin-right:29.5%">

                <div class="d-flex">
                    <label class="col-sm-1 col-form-label">نام کاربری :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" dir="ltr" name="username" value="<?php if (isset($_POST['username'])) {
                            echo $_POST['username'];
                        } else {
                            echo $Tusername;
                        } ?>">
                    </div>
                </div>

                <div class="d-flex" style="margin-top:0.5%">
                    <label class="col-sm-1 col-form-label">ایمیل :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" dir="ltr" value="<?php if (isset($_POST['email'])) {
                            echo $_POST['email'];
                        } else {
                            echo $Temail;
                        } ?>">
                    </div>
                </div>

                <!-- <div class="d-flex" style="margin-top:0.5%">
                    <label class="col-sm-1 col-form-label">رمزعبور :</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" dir="ltr" value="<?php if (isset($_POST['password'])) {
                            echo $_POST['password'];
                        } ?>">
                    </div>
                </div> -->

                <div class="d-flex" style="margin-top:01%">

                    <label class="col-sm-1 col-form-label">عکس :</label>
                    <div class="col-sm-5">
                        <input type='file' name='fileToUpload'>

                    </div>
                    <img width='100' height='100' src="<?php echo "lib/user/img/" . $Timg ?>">
                </div>
            </center>

            <center style="margin-top:0.5%">


                <div class="col-sm-3 d-grid">
                    <button type="submit" value="<?php echo $Tid ?>" name="edit" class="btn btn-outline-success"
                        style="margin-top:0.1%">ویرایش</button>
                </div>
                <div class="" style="margin-top:0.1%">
                    <a role="button" class="btn btn-danger" href="/library/user.php?username=<?php echo $_POST['edituser'] ;?>">برگشت</a>
                </div>
            </center>

        </form>


    </div>

</body>

</html>