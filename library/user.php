<?php
session_start();
// echo $_SESSION['username'];


if(VALID_SESSION('user')==false){
    header("Location:LOGIN.php");
}
require 'FUNC_VALID.php';
require 'CRUD.php';
CREATE_DATABASE('library');
CREATE_TABLE_RENTED_RECEIVE('library', 'RandR');




?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    <title>پنل کاریری</title>
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

    <br>

    <center>
        <h3>
            پنل کاربری
        </h3>
    </center>
    <hr>
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




    <div class="col-sm-3 d-inline-flex">
        <form action="" method="GET" dir='ltr'>
            <div class="input-group mb-3">


                <!-- <input type="text" name="search" class="form-control"> -->
                <select name="sort" class="form-control">
                    <option value="reset">یک گزینه انتخاب کنید</option>
                    <option value="pageBIG" <?php if (isset($_GET['sort']) && $_GET['sort'] == "pageBIG") {
                        echo 'selected';
                    } ?>>تعداد صفحه(زیاد به کم)</option>
                    <option value="pageSML" <?php if (isset($_GET['sort']) && $_GET['sort'] == "pageSML") {
                        echo 'selected';
                    } ?>>تعداد صفحه(کم به زیاد)</option>
                    <option value="stockBIG" <?php if (isset($_GET['sort']) && $_GET['sort'] == "stockBIG") {
                        echo 'selected';
                    } ?>>موجودی(زیاد به کم)</option>
                    <option value="stockSML" <?php if (isset($_GET['sort']) && $_GET['sort'] == "stockSML") {
                        echo 'selected';
                    } ?>>موجودی(کم به زیاد)</option>Z
                </select>
                <button type="submit" class="btn btn-primary">مرتب کردن</button>
            </div>

        </form>
    </div>

    <div class="d-sm-inline-flex" style="margin-right:12%">
        <form action="" method="get">


            ترسناک &nbsp;<input class='form-check-input mt-2' type='radio' name='genreF' value='tars' <?php if (isset($_GET['genreF']) && !empty($_GET['EnPost'])) {
                echo "checked";
            } ?>>

            &nbsp;&nbsp;&nbsp;&nbsp;

            کلاسیک &nbsp;<input class='form-check-input mt-2' type='radio' name='genreF' value='classic' <?php if (isset($_GET['genreF']) && !empty($_GET['EnComment'])) {
                echo "checked";
            } ?>>

            &nbsp;&nbsp;&nbsp;&nbsp;

            جنایی &nbsp;<input class='form-check-input mt-2' type='radio' name='genreF' value='kill' <?php if (isset($_GET['genreF']) && !empty($_GET['EnComment'])) {
                echo "checked";
            } ?>>

            &nbsp;&nbsp;&nbsp;&nbsp;

            عاشقانه &nbsp;<input class='form-check-input mt-2' type='radio' name='genreF' value='love' <?php if (isset($_GET['genreF']) && !empty($_GET['EnComment'])) {
                echo "checked";
            } ?>>


            &nbsp; &nbsp;


            <input type="submit" class="btn btn-primary btn-sm" name="filter" value="فیلتر کردن">
            <a href="/library/user.php" class="btn btn-danger  btn-sm" role="button">تازه سازی</a>
        </form>
    </div>

    <hr>

    <form action="EditUser.php" method="post">
        <button name="edituser" value="<?php echo $_SESSION['username'] ;?>" class="btn btn-outline-success">ویرایش
            اطلاعات</button>
        <a href="/library/myBooks.php" class="btn btn-outline-primary">کتاب های من</a>
    </form>



    <table dir="ltr" class='table table-boarderd'>
        <thead>
            <tr>
                <th>شناسه</th>
                <th>عکس کتاب</th>
                <th>نام کتاب</th>
                <th>نویسنده کتاب</th>
                <th>ژانر</th>
                <th>تعداد صفحه</th>
                <th>موجودی</th>
                <th>عملیات</th>

            </tr>
        </thead>
        <tbody>
            <?php


            // $quaryU = Read('library', 'users', '*', $_GET['username']);
            if (isset($_GET['search'])) {
                $quary = BOOK_SEARCHER('library', 'Books', $_GET['search']);


                while ($res = mysqli_fetch_assoc($quary)) {
                    $id = $res['id'];
                    $name = $res['name'];
                    $writer = $res['writer'];
                    $genre = $res['genre'];
                    $img = $res['img'];
                    $page = $res['page'];
                    $stock = $res['stock'];
                    $enabled = $res['enabled'];
                    if ($enabled == 1) {
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
                                <?php echo $page; ?>
                            </td>
                            <td>
                                <?php echo $stock; ?>
                            </td>
                            <td>
                                <form method='post' class='d-sm-inline-flex'>
                                    <button name="rent" value="<?php echo $id; ?>" class="btn btn-outline-dark">اجاره</button>
                                </form>

                            </td>
                        </tr>

                        <?php


                    }
                }
            } else {

                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == "reset") {
                        header("Refresh:0; url=user.php");

                    }


                    $sort = '';
                    if ($_GET['sort'] == "pageBIG") {
                        $sort = 'DESC';
                        $quary = sorter('library', 'Books', 'page', $sort);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            $id = $res['id'];
                            $name = $res['name'];
                            $writer = $res['writer'];
                            $genre = $res['genre'];
                            $img = $res['img'];
                            $page = $res['page'];
                            $stock = $res['stock'];
                            $enabled = $res['enabled'];
                            if ($enabled == 1) {
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
                                        <?php echo $page; ?>
                                    </td>
                                    <td>
                                        <?php echo $stock; ?>
                                    </td>
                                    <td>
                                        <form method='post' class='d-sm-inline-flex'>
                                            <button name="rent" value="<?php echo $id; ?>" class="btn btn-outline-dark">اجاره</button>
                                        </form>

                                    </td>
                                </tr>

                                <?php


                            }

                        }

                    }

                    if ($_GET['sort'] == "pageSML") {
                        $sort = 'ASC';
                        $quary = sorter('library', 'Books', 'page', $sort);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            $id = $res['id'];
                            $name = $res['name'];
                            $writer = $res['writer'];
                            $genre = $res['genre'];
                            $img = $res['img'];
                            $page = $res['page'];
                            $stock = $res['stock'];
                            $enabled = $res['enabled'];
                            if ($enabled == 1) {
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
                                        <?php echo $page; ?>
                                    </td>
                                    <td>
                                        <?php echo $stock; ?>
                                    </td>
                                    <td>
                                        <form method='post' class='d-sm-inline-flex'>
                                            <button name="rent" value="<?php echo $id; ?>" class="btn btn-outline-dark">اجاره</button>
                                        </form>

                                    </td>
                                </tr>

                                <?php


                            }

                        }

                    }

                    if ($_GET['sort'] == "stockBIG") {
                        $sort = 'DESC';
                        $quary = sorter('library', 'Books', 'stock', $sort);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            $id = $res['id'];
                            $name = $res['name'];
                            $writer = $res['writer'];
                            $genre = $res['genre'];
                            $img = $res['img'];
                            $page = $res['page'];
                            $stock = $res['stock'];
                            $enabled = $res['enabled'];
                            if ($enabled == 1) {
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
                                        <?php echo $page; ?>
                                    </td>
                                    <td>
                                        <?php echo $stock; ?>
                                    </td>
                                    <td>
                                        <form method='post' class='d-sm-inline-flex'>
                                            <button name="rent" value="<?php echo $id; ?>" class="btn btn-outline-dark">اجاره</button>
                                        </form>

                                    </td>
                                </tr>

                                <?php


                            }

                        }

                    }

                    if ($_GET['sort'] == "stockSML") {
                        $sort = 'ASC';
                        $quary = sorter('library', 'Books', 'stock', $sort);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            $id = $res['id'];
                            $name = $res['name'];
                            $writer = $res['writer'];
                            $genre = $res['genre'];
                            $img = $res['img'];
                            $page = $res['page'];
                            $stock = $res['stock'];
                            $enabled = $res['enabled'];
                            if ($enabled == 1) {
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
                                        <?php echo $page; ?>
                                    </td>
                                    <td>
                                        <?php echo $stock; ?>
                                    </td>
                                    <td>
                                        <form method='post' class='d-sm-inline-flex'>
                                            <button name="rent" value="<?php echo $id; ?>" class="btn btn-outline-dark">اجاره</button>
                                        </form>
                                    </td>
                                </tr>

                                <?php


                            }

                        }

                    }

                } else {
                    if (isset($_GET['filter']) && !empty($_GET['genreF'])) {

                        $quary = SpecialRead('library', 'Books', '*', 'genre', $_GET['genreF']);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            $id = $res['id'];
                            $name = $res['name'];
                            $writer = $res['writer'];
                            $genre = $res['genre'];
                            $img = $res['img'];
                            $page = $res['page'];
                            $stock = $res['stock'];
                            $enabled = $res['enabled'];
                            if ($enabled == 1) {
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
                                        <?php echo $page; ?>
                                    </td>
                                    <td>
                                        <?php echo $stock; ?>
                                    </td>
                                    <td>
                                        <form method='post' class='d-sm-inline-flex'>
                                            <button name="rent" value="<?php echo $id; ?>" class="btn btn-outline-dark">اجاره</button>
                                        </form>

                                    </td>
                                </tr>

                                <?php


                            }

                        }




                    } else {
                        $quary = Read('library', 'books', '*', 'id');

                        if (mysqli_num_rows($quary) > 0) {
                            while ($res = mysqli_fetch_assoc($quary)) {
                                $id = $res['id'];
                                $name = $res['name'];
                                $writer = $res['writer'];
                                $genre = $res['genre'];
                                $img = $res['img'];
                                $page = $res['page'];
                                $stock = $res['stock'];
                                $enabled = $res['enabled'];
                                if ($enabled == 1) {
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
                                            <?php echo $page; ?>
                                        </td>
                                        <td>
                                            <?php echo $stock; ?>
                                        </td>
                                        <td>
                                            <form action="bookOperation.php" method='post' class='d-sm-inline-flex'>
                                                <button name="rent" value="<?php echo $id; ?>" class="btn btn-outline-dark">اجاره</button>
                                            </form>

                                        </td>
                                    </tr>

                                    <?php


                                }
                            }
                        }
                    }


                }
            }



            ?>




        </tbody>


    </table>
    <a href="/library/LOGIN.php" class="btn btn-danger">خروج</a>



</body>

</html>