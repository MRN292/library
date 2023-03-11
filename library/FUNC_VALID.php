<?php
function VALID_NAME($input)
{


    $array = [];
    $name = '';
    if (empty($input)) {
        $array[1] = "name is required";
        $array[0] = true;
        return $array;

    } else {
        $name = test_input($input);
        if (!preg_match("/^[a-zA-Z][a-zA-Z-' ]{2,20}[a-zA-Z]$/", $name)) {
            $array[1] = "Invalid name";
            $array[0] = true;
            return $array;
        }
    }
    return $name;
}





function VALID_IMG($file)
{
    $array = [];

    $fileName = basename($file["name"]);

    if (!empty($fileName)) {
        $target_dir = "lib/user/img/";
        $target_file = $target_dir . $fileName;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        $check = getimagesize($file["tmp_name"]);
        if ($check == false) {
            $array[1] = 'فایل انتخاب شده عکس نیست';
            $array[0] = true;
            return $array;
        }

        if ($file["size"] > 2000000) {
            $array[1] = "عکس وارد شده بزرگ تر از حد مجاز است";
            $array[0] = true;
            return $array;
        }

        if ($imageFileType = "jpg" && $imageFileType = "png" && $imageFileType = "jpeg") {
            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                $array[1] = "مشکلی در اپلود عکس به وجود امده";
                $array[0] = true;
                return $array;

            }
        } else {
            $array[1] = "فرمت های مجاز فقط jpg و  jpeg و png هستند";
            $array[0] = true;
            return $array;

        }

    } else {
        $array[1] = "لطفا یک عکس انتخاب کنید";
        $array[0] = true;
        return $array;
    }
    return $fileName;

}

function VALID_IMG_BOOK($file)
{
    $array = [];

    $fileName = basename($file["name"]);

    if (!empty($fileName)) {
        $target_dir = "lib/book/img/";
        $target_file = $target_dir . $fileName;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        $check = getimagesize($file["tmp_name"]);
        if ($check == false) {
            $array[1] = 'فایل انتخاب شده عکس نیست';
            $array[0] = true;
            return $array;
        }

        if ($file["size"] > 2000000) {
            $array[1] = "عکس وارد شده بزرگ تر از حد مجاز است";
            $array[0] = true;
            return $array;
        }

        if ($imageFileType = "jpg" && $imageFileType = "png" && $imageFileType = "jpeg") {
            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                $array[1] = "مشکلی در اپلود عکس به وجود امده";
                $array[0] = true;
                return $array;

            }
        } else {
            $array[1] = "فرمت های مجاز فقط jpg و  jpeg و png هستند";
            $array[0] = true;
            return $array;

        }

    } else {
        $array[1] = "لطفا یک عکس انتخاب کنید";
        $array[0] = true;
        return $array;
    }
    return $fileName;

}


function VALID_USER($input)
{
    $array = [];
    $username = '';

    if (empty($input)) {
        $array[1] = "Username is required";
        $array[0] = true;
        return $array;

    } else {
        $username = test_input($input);
        if (!preg_match('/^[a-zA-Z][0-9a-zA-Z_@]{2,15}[0-9a-zA-Z@]$/', $username)) {
            $array[1] = "Invalid username";
            $array[0] = true;
            return $array;
        }
    }
    return $username;

}

function VALID_EMAIL($input)
{


    $array = [];
    $email = '';

    if (empty($input)) {
        $array[1] = "Email is required";
        $array[0] = true;
        return $array;


    } else {
        $email = test_input($input);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $array[1] = "Invalid email format";
            $array[0] = true;
            return $array;


        }
    }
    return $email;
}


function VALID_PASS($input)
{

    $array = [];
    $password = '';

    if (empty($input)) {
        $array[1] = "Password is required";
        $array[0] = true;
        return $array;

    }
    $password = test_input($input);
    if (strlen($_POST["password"]) < '8') {
        $array[1] = "Your Password Must Contain At Least 8 Characters!";
        $array[0] = true;
        return $array;

    } elseif (!preg_match("#[0-9]+#", $password)) {
        $array[1] = "Your Password Must Contain At Least 1 Number!";
        $array[0] = true;
        return $array;


    } elseif (!preg_match("#[A-Z]+#", $password)) {
        $array[1] = "Your Password Must Contain At Least 1 Capital Letter!";
        $array[0] = true;
        return $array;


    } elseif (!preg_match("#[a-z]+#", $password)) {
        $array[1] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        $array[0] = true;
        return $array;


    }
    $password = hash('md5', $password);



    return $password;

}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function VALID_TITLE($input)
{
    $array = [];
    $title = '';
    $title = test_input($input);
    if (empty($title)) {
        $array[1] = "Title is requierd";
        $array[0] = true;
        return $array;
    } else {


        if (!preg_match("/^[0-9a-zA-Z-' ][0-9a-zA-Z-' ]{2,15}[0-9a-zA-Z]$/", $input)) {
            $array[1] = "Invalid input for title";
            $array[0] = true;
            return $array;
        }
    }


    return $title;
}
function VALID_BOOK_NAME($input)
{
    $array = [];
    $title = '';
    $title = test_input($input);
    if (empty($title)) {
        $array[1] = "لطفا یک اسم برای کتاب وارد کنید";
        $array[0] = true;
        return $array;
    } else {

        if (!preg_match("/^[0-9a-zA-Z-' ][0-9a-zA-Z-' ]{2,15}[0-9a-zA-Z]$/", $input)) {
            $array[1] = "اسم وارد شده معتبر نمی باشد";
            $array[0] = true;
            return $array;
        }
    }


    return $title;
}

function VALID_ARTICLE($input)
{
    $array = [];
    $article = '';
    $article = test_input($input);

    if (empty($article)) {
        $array[1] = "Write some article";
        $array[0] = true;
        return $array;
    }

    return $article;
}
function VALID_FILE($file)
{

    $array = [];

    $fileName = basename($file["name"]);
    if (!empty($fileName)) {
        $target_dir = "uploads/file/";
        $target_file = $target_dir . $fileName;

        $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        if ($file["size"] > 50000000) {
            $array[1] = "Sorry, your file is too large.";
            $array[0] = true;
            return $array;
        }
        if ($FileType = "jpg" && $FileType = "png" && $FileType = "jpeg" && $FileType = "zip" && $FileType = "rar" && $FileType = "exe" && $FileType = "txt") {
            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                $array[1] = "Sorry, there was an error uploading your file.";
                $array[0] = true;
                return $array;

            }
        } else {
            $array[1] = "Sorry, this type not allowed.";
            $array[0] = true;
            return $array;

        }
    } else {
        $array[1] = "Select a file ,please";
        $array[0] = true;
        return $array;
    }
    return $fileName;

}


function CREATE_SESSION($input="DEFAULT")
{
    session_start();

    $_SESSION["$input"] = $input;
    $_SESSION["$input"."_login_time"] = time();
}
function VALID_SESSION($input="DEFAULT" , $time = 10){
    session_start();
    if(empty($_SESSION["$input"])){
        return false;
    }
    if(time() - $_SESSION["$input"."_login_time"] > $time){
        return false;
    }
    return true;
}



?>