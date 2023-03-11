<?php



$nameErr = $imgErr = "";
require 'FUNC_VALID.php';
require 'CRUD.php';
// if(empty($_SESSION['admin'])&& (time()-$_SESSION['login_time_stamp'] > 60)){
//     
// }



if(VALID_SESSION('admin')==false){
    header("location:AdminLogin.php");
}
// echo var_dump(VALID_SESSION('admin', 5));
// echo $_SESSION['admin'];
// if($out==0){
//     echo 222;
// }

?>



<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" dir="rtl">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body>

    <div class="conrainer my-5 ">
        <center>
            <h3>خوش آمدید</h3>
        </center>
        <br>
        <center>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <a class="btn btn-outline-primary" href="/library/showBooks.php" role="button">لیست کتاب ها</a>
                <a class="btn btn-outline-primary" href="/library/showUsers.php" role="button">لیست کاربران</a>
            </form>
        </center>
        <br>
        <center>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <a class="btn btn-danger" href="/library/AdminLogin.php" role="button">خروج</a>
                
            </form>
        </center>

    </div>
</body>

</html>