<?php
// session_start();

require 'FUNC_VALID.php';
require 'CRUD.php';


$usernameErr = $emailErr = $passwordErr = $imgErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $flag = false;

    $username = VALID_USER($_POST['username']);
    if (is_array($username)) {
        $usernameErr = $username[1];
        $flag = $username[0];
    }


    $password = VALID_PASS($_POST['password']);

    if (is_array($password)) {
        $passwordErr = $password[1];
        $flag = $password[0];
    }

    if ($flag == false) {
        // INSERT($dbname, $table, $what, $input)
        CREATE_DATABASE('library');
        CREATE_TABLE_ADMIN('library', 'Admins');

        INSERT_ADMIN('library', 'Admins', $username, $password);
        // header("Refresh:0; url=AdminSignin.php");

        CREATE_SESSION("admin");
        header("Location:admin.php");
    }





}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
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
        if (!empty($passwordErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$passwordErr</strong>
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
                        <input type="text" class="form-control" dir="ltr" name="username"
                            value="<?php if (isset($_POST['username'])) {
                                echo $_POST['username'];
                            } ?>">
                    </div>
                </div>

                <div class="d-flex" style="margin-top:0.5%">
                    <label class="col-sm-1 col-form-label">رمزعبور :</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" dir="ltr"
                            value="<?php if (isset($_POST['password'])) {
                                echo $_POST['password'];
                            } ?>">
                    </div>
                </div>


            </center>
            <center style="margin-top:0.5%">
                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary" style="margin-top:0.1%">ثبت نام</button>
                </div>
            </center>

        </form>


    </div>

</body>

</html>