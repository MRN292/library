<?php
require 'FUNC_VALID.php';
require 'CRUD.php';
CREATE_DATABASE('library');
CREATE_TABLE_USER('library', 'Users');



?>


<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" dir="rtl">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کاربران</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body style="margin-top:2%">
    <div style="margin-right:1%" class="col-sm-3 d-inline-flex">

        <form action="" method="GET" dir='ltr'>
            <div class="input-group mb-3">
                <input type="text" value="<?php
                if (isset($_GET['search'])) {
                    echo $_GET['search'];
                }
                ?>" name="search" class="form-control" placeholder="جستجو">
                <button type="submit" class="btn btn-primary">جستجو</button>
            </div>
        </form>
    </div>

    <center>
        <label class="col-form-label">لیست کاربران</label>
    </center>

    <table dir="ltr" class='table table-boarderd'>
        <thead>
            <tr>
                <th>شناسه</th>
                <th>عکس کاربر</th>
                <th>نام کاربری</th>
                <th>کلمه عبور کاربر</th>
                <th>ایمیل</th>
                <th>اجاره کرده</th>
                <th>عملیات</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['search'])) {
                $quary = USER_SEARCHER('library', 'Users', $_GET['search']);
                if (mysqli_num_rows($quary) > 0) {
                    while ($res = mysqli_fetch_assoc($quary)) {
                        $id = $res['id'];
                        $img = $res['img'];
                        $username = $res['username'];
                        $email = $res['email'];
                        $password = $res['password'];
                        $rented = $res['rented'];
                        $del = $res['del'];
                        $varify = $res['varify'];
                        $permission = $res['permission'];



                        if ($del == 0) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $id; ?>
                                </td>
                                <td> <img width='30' height='40' src="<?php echo "lib/user/img/" . $img ?>"></td>
                                <td>
                                    <?php echo $username; ?>
                                </td>
                                <td>
                                    <?php
                                    // echo "<form method='post'><button class='btn btn-outline-info btn-sm' name ='showpass' value='$password' >نمایش</button></form>";
                                    if (isset($_POST['showpass' . $id])) {

                                        echo $password;
                                    } else {
                                        ?>
                                        <form method='post'>
                                            <button class='btn btn-outline-info btn-sm' name='showpass<?php echo $id ?>'>نمایش</button>
                                        </form>
                                        <?php
                                    }

                                    // echo $password;
                    
                                    ?>
                                </td>
                                <td>
                                    <?php echo $email; ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($_POST['rented' . $id])) {
                                        echo 11;
                                    } else {
                                        if ($rented == 0) {
                                            echo "اجاره نکرده";
                                        } else {
                                            ?>
                                            <form method='post'>
                                                <button class='btn btn-outline-info btn-sm' name='rented<?php echo $id ?>'>نمایش</button>
                                            </form>
                                            <?php
                                        }
                                    }

                                    ?>
                                </td>


                                <td>

                                    <?php
                                    if ($varify == 0) {
                                        ?>
                                        <form action="/library/userOperation.php" method="post" class='d-sm-inline-flex'>
                                            <button class='btn btn-outline-success btn-sm' value="<?php echo $id; ?>"
                                                name="varifyer">تایید</button>&nbsp;
                                            <button name="deleter" value="<?php echo $id; ?>"
                                                class="btn btn-outline-danger">حذف</button>&nbsp;
                                        </form>


                                        <?PHP

                                    } else {
                                        ?>
                                        <form method='post' class='d-sm-inline-flex' action="/library/userOperation.php">
                                            <button name="deleter" value="<?php echo $id; ?>"
                                                class="btn btn-outline-danger">حذف</button>&nbsp;
                                            <?php
                                            if ($permission == 1) {
                                                ?>
                                                <button name="ban" value="<?php echo $id; ?>"
                                                    class="btn btn-outline-warning">مسدود</button>&nbsp;
                                                <?php
                                            } else {
                                                ?>
                                                <button name="unban" value="<?php echo $id; ?>" class="btn btn-outline-warning">رفع
                                                    مسدود</button>&nbsp;
                                                <?php
                                            }
                                            ?>
                                        </form>



                                        <?php

                                    }

                                    ?>



                                </td>
                            </tr>

                            <?php


                        }
                    }
                }
            } else {
                $quary = Read('library', 'users', '*', 'varify = 1');

                if (mysqli_num_rows($quary) > 0) {
                    while ($res = mysqli_fetch_assoc($quary)) {
                        $id = $res['id'];
                        $img = $res['img'];
                        $username = $res['username'];
                        $email = $res['email'];
                        $password = $res['password'];
                        $rented = $res['rented'];
                        $del = $res['del'];
                        $varify = $res['varify'];
                        $permission = $res['permission'];



                        if ($del == 0) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $id; ?>
                                </td>
                                <td> <img width='30' height='40' src="<?php echo "lib/user/img/" . $img ?>"></td>
                                <td>
                                    <?php echo $username; ?>
                                </td>
                                <td>
                                    <?php
                                    // echo "<form method='post'><button class='btn btn-outline-info btn-sm' name ='showpass' value='$password' >نمایش</button></form>";
                                    if (isset($_POST['showpass' . $id])) {

                                        echo $password;
                                    } else {
                                        ?>
                                        <form method='post'>
                                            <button class='btn btn-outline-info btn-sm' name='showpass<?php echo $id ?>'>نمایش</button>
                                        </form>
                                        <?php
                                    }

                                    // echo $password;
                    
                                    ?>
                                </td>
                                <td>
                                    <?php echo $email; ?>
                                </td>
                                <td>
                                    <?php

                                    if ($rented == 0) {
                                        echo "اجاره نکرده";
                                    } else {
                                        echo $rented;
                                    }

                                    ?>
                                </td>


                                <td>

                                    <?php
                                    if ($varify == 0) {
                                        ?>
                                        <form action="/library/userOperation.php" method="post" class='d-sm-inline-flex'>
                                            <button class='btn btn-outline-success btn-sm' value="<?php echo $id; ?>"
                                                name="varifyer">تایید</button>&nbsp;
                                            <button name="deleter" value="<?php echo $id; ?>"
                                                class="btn btn-outline-danger">حذف</button>&nbsp;
                                        </form>


                                        <?PHP

                                    } else {
                                        ?>
                                        <form method='post' class='d-sm-inline-flex' action="/library/userOperation.php">
                                            <button name="deleter" value="<?php echo $id; ?>"
                                                class="btn btn-outline-danger">حذف</button>&nbsp;
                                            <?php
                                            if ($permission == 1) {
                                                ?>
                                                <button name="ban" value="<?php echo $id; ?>"
                                                    class="btn btn-outline-warning">مسدود</button>&nbsp;
                                                <?php
                                            } else {
                                                ?>
                                                <button name="unban" value="<?php echo $id; ?>" class="btn btn-outline-warning">رفع
                                                    مسدود</button>&nbsp;
                                                <?php
                                            }


                                            ?>
                                            <button value="<?PHP echo $id ?>" name='showH' class="btn btn-outline-info">نمایش
                                                تاریخجه</button>


                                            <?php

                                            ?>
                                        </form>



                                        <?php

                                    }

                                    ?>



                                </td>
                            </tr>

                            <?php


                        }
                    }
                }

            }







            ?>


        </tbody>


    </table>
    <a style="margin-top:2% ; margin-right:1%" href="/library/admin.php" role="button" class="btn btn-dark">بازگشت</a>



</body>

</html>