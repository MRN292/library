<?php



require 'FUNC_VALID.php';
require 'CRUD.php';

if(VALID_SESSION('admin')==false){
    header("location:AdminLogin.php");
}




if (isset($_POST['varifyer'])) {
    Update('library', 'Users', 'varify', 1, $_POST['varifyer']);
    header("Refresh:0; url=showUsers.php");
}
if (isset($_POST['deleter'])) {
    Update('library', 'Users', 'del', 1, $_POST['deleter']);
    header("Refresh:0; url=showUsers.php");
}
if (isset($_POST['unban'])) {
    Update('library', 'Users', 'permission', 1, $_POST['unban']);
    header("Refresh:0; url=showUsers.php");
}
if (isset($_POST['ban'])) {
    Update('library', 'Users', 'permission', 0, $_POST['ban']);
    header("Refresh:0; url=showUsers.php");
}
if (isset($_POST['showH'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="rtl">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
        <title>تاریخجه</title>
    </head>

    <body>
        <a style="margin-top:2% ; margin-right:1%" href="/library/showUsers.php" role="button" class="btn btn-outline-danger">بازگشت</a>
        <center>
            <label class="col-form-label">تاریخچه</label>
        </center>



        <table dir="ltr" class='table table-boarderd'>
            <thead>
                <th>شناسه</th>
                <th>عکس کتاب</th>
                <th>نام کتاب</th>
                <th>نویسنده کتاب</th>
                <th>ژانر</th>
                <th>تاریخ اجاره</th>
                <th>تاریح تحویل</th>
            </thead>
            <tbody>
                <?php

                $sort = 'ASC';
                $quary = sorter('library', 'randr', 'date_recived', $sort);
                if (mysqli_num_rows($quary) > 0) {
                    while ($res = mysqli_fetch_assoc($quary)) {
                        $id = $res['id'];
                        $name = $res['name'];
                        $img = $res['img'];
                        $writer = $res['writer'];
                        $UserID = $res['UserID'];
                        $genre = $res['genre'];
                        $date_rent = $res['date_rented'];
                        $date_recived = $res['date_recived'];

                        if ($UserID == $_POST['showH']) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $id; ?>
                                </td>
                                <td><img width='30' height='40' src="<?php echo "lib/book/img/" . $img ?>"></td>
                                <td>
                                    <?php echo $name; ?>
                                </td>
                                <td>
                                    <?php echo $writer; ?>
                                </td>
                                <td>
                                    <?php echo $genre; ?>
                                </td>
                                <td>
                                    <?php echo $date_rent; ?>
                                </td>
                                <td>
                                    <?php if (empty($date_recived)) {
                                        echo "تحویل نداده";
                                    } else {
                                        echo $date_recived;
                                    } ?>
                                </td>
                            </tr>



                            <?php
                        }
                    }
                }

                ?>

            </tbody>

        </table>


    </body>

    </html>





    <?php


}


?>