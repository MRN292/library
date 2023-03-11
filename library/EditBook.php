<?php


require 'FUNC_VALID.php';
require 'CRUD.php';
if(VALID_SESSION('admin')==false){
    header("location:AdminLogin.php");
}

$nameErr = $imgErr = $writerErr = $genreErr = "";
$name = $writer = $genre = $img = $stock = $page = "";


if (isset($_POST['edit'])) {

    $id = $_POST['edit'];

    $quary = SpecialRead('library', 'Books', '*', 'id', $id);

    while ($res = mysqli_fetch_assoc($quary)) {
        $name = $res['name'];
        $writer = $res['writer'];
        $genre = $res['genre'];
        $img = $res['img'];
        $page = $res['page'];
        $stock = $res['stock'];

    }
}




// echo $id;
if (isset($_POST["EditBook"])) {

    $flag = false;

    $id = $_POST['EditBook'];

    $resimg = "";

    $quary = SpecialRead('library', 'Books', '*', 'id', $id);
    while ($res = mysqli_fetch_assoc($quary)) {
        $resimg = $res['img'];
    }


    $name = VALID_BOOK_NAME($_POST['BookName']);
    if (is_array($name)) {
        $nameErr = $name[1];
        $flag = $name[0];
    }


    $Stock = $_POST['BookStock'];


    $page = $_POST['BookPage'];


    $genre = $_POST['Genre'];

    $writer = VALID_NAME($_POST['BookWriter']);
    if (is_array($writer)) {
        $writerErr = $writer[1];
        $flag = $writer[0];
    }


    $img = '';
    if ($flag == false) {
        $img = basename($_FILES['BookImg']['name']);
        if (!empty($img)) {
            $img = VALID_IMG_BOOK($_FILES['BookImg']);
            if (is_array($img)) {
                $imgErr = $img[1];
                $flag = $img[0];
            }
        } else {
            $img = $resimg;
        }
    }



    if ($flag == false) {

        Update('library', 'Books', 'name', $name, $id);
        Update('library', 'Books', 'writer', $writer, $id);
        Update('library', 'Books', 'page', $page, $id);
        Update('library', 'Books', 'stock', $Stock, $id);
        Update('library', 'Books', 'img', $img, $id);
        Update('library', 'Books', 'genre', $genre, $id);
        header("Refresh:0; url=showBooks.php");

    }

}


?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" dir="rtl">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کتاب جدید</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body>
    <center>
        <h3 class="col-form-label">مشخصات کتاب را وارد کنید</h3>
    </center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype='multipart/form-data'>

        <center style="margin-right:29.5%">


            <div class="d-flex" style="margin-top:0.5%">
                <label class="col-sm-1 col-form-label" style="margin-top:0.5%">نام کتاب :</label>
                <div class="col-sm-5">
                    <input dir="ltr" type="text" class="form-control" name="BookName" value="<?php if (isset($_POST['BookName'])) {
                        echo $_POST['BookName'];
                    } else {
                        echo $name;
                    } ?>">
                </div>
            </div>


            <div class="d-flex" style="margin-top:0.5%">
                <label class="col-sm-1 col-form-label" style="margin-top:0.5%">نویسنده :</label>
                <div class="col-sm-5">
                    <input dir="ltr" type="text" class="form-control" name="BookWriter" value="<?php if (isset($_POST['BookWriter'])) {
                        echo $_POST['BookWriter'];
                    } else {
                        echo $writer;
                    } ?>">
                </div>
            </div>


            <div class="d-flex" style="margin-top:0.5%">
                <label class="col-sm-1 col-form-label" style="margin-top:0.5%">ژانر کتاب :</label>
                <div class="col-sm-5">
                    <select name="Genre" class="form-control">
                        <!-- <option value="default">یک گزینه انتخاب کنید</option> -->
                        <option value="tars" <?php if (isset($_GET['Genre']) && $_GET['Genre'] == "tars") {
                            echo 'selected';
                        } else {
                            if ($genre == 'tars') {
                                echo 'selected';
                            }
                        } ?>>ترسناک</option>
                        <option value="love" <?php if (isset($_GET['Genre']) && $_GET['Genre'] == "love") {
                            echo 'selected';
                        } else {
                            if ($genre == 'love') {
                                echo 'selected';
                            }
                        } ?>>عاشقانه</option>
                        <option value="kill" <?php if (isset($_GET['Genre']) && $_GET['Genre'] == "kill") {
                            echo 'selected';
                        } else {
                            if ($genre == 'kill') {
                                echo 'selected';
                            }
                        } ?>>جنایی</option>
                        <option value="classic" <?php if (isset($_GET['Genre']) && $_GET['Genre'] == "classic") {
                            echo 'selected';
                        } else {
                            if ($genre == 'classic') {
                                echo 'selected';
                            }
                        } ?>>کلاسیک</option>
                    </select>
                </div>

            </div>


            <div class="d-flex" style="margin-top:0.5%">
                <label class="col-sm-1 col-form-label" style="margin-top:0.5%">موجودی :</label>
                <div class="col-sm-5">
                    <input dir="ltr" type="number" class="form-control" name="BookStock" min="0" max="100" value="<?php if (isset($_POST['BookStock'])) {
                        echo $_POST['BookStock'];
                    } else {
                        echo $stock;
                    }
                    ?>">
                </div>
            </div>

            <div class="d-flex" style="margin-top:0.5%">
                <label class="col-sm-1 col-form-label" style="margin-top:0.5% ;">تعداد صفحه : </label>
                <div class="col-sm-5">
                    <input dir="ltr" type="number" class="form-control" name="BookPage" min="1" value="<?php if (isset($_POST['BookPage'])) {
                        echo $_POST['BookPage'];
                    } else {
                        echo $page;

                    }
                    ?>">
                </div>
            </div>

            <div class="d-flex" sstyle="margin-top:0.5%">
                <label class="col-sm-1 col-form-label">عکس کتاب:</label>
                <div class="col-sm-5">
                    <input type='file' name='BookImg'>
                </div>
            </div>
        </center>
        <center>
            <img width='60' height='70' src="<?php echo "lib/book/img/" . $img ?>">
        </center>
        <center>
            <center style="margin-top:0.5%">
                <div class="col-sm-3 d-grid " style="margin-top:0.1%">
                    <button type="submit" name="EditBook" value="<?php echo $id; ?>" class="btn btn-primary">ویرایش
                        کتاب</button>

                </div>
                <a href="/library/showBooks.php" role="button" class="btn btn-outline-danger"
                    style="margin-top:0.1%">بازگشت</a>
            </center>
        </center>
    </form>

</body>

</html>


<?php




?>