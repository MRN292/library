<?php



require 'FUNC_VALID.php';
require 'CRUD.php';
if(VALID_SESSION('admin')==false){
    header("location:AdminLogin.php");
}

$nameErr = $imgErr = $writerErr = $genreErr = "";


CREATE_DATABASE('library');
CREATE_TABLE_BOOK('library', 'Books');

$flag = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['NewBook'])) {



    $name = VALID_BOOK_NAME($_POST['BookName']);
    if (is_array($name)) {
        $nameErr = $name[1];
        $flag = $name[0];
    }


    $Stock = $_POST['BookStock'];


    $page = $_POST['BookPage'];


    
    
    $genre =  $_POST['Genre'];
    // if($genre = 'default'){
    //     $flag = true;
    //     $genreErr = "یک ژانر انتخاب کنید";
    // }


    
    $writer = VALID_NAME($_POST['BookWriter']);
    if (is_array($name)) {
        $writerErr = $writer[1];
        $flag = $writer[0];
    }
    
    $img = '';
    if ($flag == false) {
        $img = VALID_IMG_BOOK($_FILES['BookImg']);
        if (is_array($img)) {
            $imgErr = $img[1];
            $flag = $img[0];
        }

    }
   

    if ($flag == false) {
        
        INSERT_BOOK('library', 'Books', $name, $writer, $img, $genre, $page, $Stock);
        header("Refresh:0; url=admin.php");
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
    <?php
    if (!empty($nameErr)) {
        echo "
                <div class='alert alert-warning alert-dismissible fale show' role='alert'>
                <strong>$nameErr</strong>
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
    if (!empty($writerErr)) {
        echo "
                <div class='alert alert-warning alert-dismissible fale show' role='alert'>
                <strong>$writerErr</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
                </div>
                ";

    }
    if (!empty($genreErr)) {
        echo "
                <div class='alert alert-warning alert-dismissible fale show' role='alert'>
                <strong>$genreErr</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
                </div>
                ";

    }



    ?>
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
                    } ?>">
                </div>
            </div>


            <div class="d-flex" style="margin-top:0.5%">
                <label class="col-sm-1 col-form-label" style="margin-top:0.5%">نویسنده :</label>
                <div class="col-sm-5">
                    <input dir="ltr" type="text" class="form-control" name="BookWriter" value="<?php if (isset($_POST['BookWriter'])) {
                        echo $_POST['BookWriter'];
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
                        } ?>>ترسناک</option>
                        <option value="love" <?php if (isset($_GET['Genre']) && $_GET['Genre'] == "love") {
                            echo 'selected';
                        } ?>>عاشقانه</option>
                        <option value="kill" <?php if (isset($_GET['Genre']) && $_GET['Genre'] == "kill") {
                            echo 'selected';
                        } ?>>جنایی</option>
                        <option value="classic" <?php if (isset($_GET['Genre']) && $_GET['Genre'] == "classic") {
                            echo 'selected';
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
                        echo 0;
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
                        echo 1;
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
            <center style="margin-top:0.5%">
                <div class="col-sm-3 d-grid " style="margin-top:0.1%">
                    <button type="submit" name="NewBook" class="btn btn-outline-success">افزودن کتاب</button>

                </div>
                <a href="/library/showBooks.php" role="button" class="btn btn-outline-danger"
                    style="margin-top:0.1%">بازگشت</a>
            </center>
        </center>
    </form>
</body>

</html>