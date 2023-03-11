<?php
// echo $_SESSION['username'];
require 'FUNC_VALID.php';
require 'CRUD.php';
if (VALID_SESSION('user') == false) {
    SESSION_DESTROYER();
    header("Location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en" dir='rtl'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>
<title>کتاب های من</title>
</head>

<body>

    <?php if (isset($_GET['Err'])) {
        if ($_GET['Err'] == 1) {
            $Err = "انجام شد";
        } else {
            $Err = "موجودی اتمام یافته است";
        }
        echo "
                <div class='alert alert-warning alert-dismissible fale show' role='alert'>
                <strong>$Err</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
                </div>
                ";

    } ?>


    <center dir="ltr">
        <label class="col-form-label">
            <?php echo $_GET['username'] ?> کتاب های
        </label>
    </center>

    <table dir="ltr" class='table table-boarderd'>
        <thead>
            <tr>
                <th>نام کتاب</th>
                <th>عکس کتاب</th>
                <th>نویسنده کتاب</th>
                <th>ژانر</th>
                <th>عملیات</th>

            </tr>
        </thead>
        <tbody>
            <?php

            $UserId = "";
            $temp = "";

            $quary = SpecialRead("library", "users", "*", "username", $_GET['username']);
            while ($res = mysqli_fetch_assoc($quary)) {
                $UserId = $res['id'];
            }


            $quary = SpecialRead('library', 'randr', '*', 'UserID', $UserId);

            if (mysqli_num_rows($quary) > 0) {
                while ($res = mysqli_fetch_assoc($quary)) {
                    $id = $res['id'];
                    $name = $res['name'];
                    $img = $res['img'];
                    $writer = $res['writer'];
                    $genre = $res['genre'];
                    $BookID = $res['BookID'];
                    $UserId = $res['UserID'];

                    $rented_date = $res['date_rented'];
                    $res_date = $res['date_recived'];
                    if ($rented_date > $res_date) {
                        ?>
                        <tr>
                            <td>
                                <img width='30' height='40' src="<?php echo "lib/book/img/" . $img ?>">
                            </td>
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
                                <?php $my_array = array($id , $_GET['username']); ?>
                                <form method='post' class='d-sm-inline-flex' action="/library/bookOperation.php">
                                    <button name="give" value="<?php echo htmlspecialchars(json_encode($my_array)); ?>" class="btn btn-outline-success">تحویل</button>
                                </form>

                            </td>
                        </tr>

                        <?php
                    }
                }
            }




            ?>

        </tbody>

    </table>
    <a href="/library/user.php?username=<?php echo $_GET['username']; ?>" dir='rtl' class="btn btn-danger">برگشت</a>


</body>

</html>