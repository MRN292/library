<?php   
session_start();
// echo $_SESSION['username'];

if(VALID_SESSION('user')==false){
    header("Location:LOGIN.php");
}

require 'FUNC_VALID.php';
require 'CRUD.php';


if (isset($_POST['rent'])) {

    $BookID = $_POST['rent'];
    $UserId = "";
    $UserRented = "";
    $temp = "";

    $quary = SpecialRead("library", "users", "*", "username", $_SESSION['username']);
    while ($res = mysqli_fetch_assoc($quary)) {
        $UserId = $res['id'];
        $UserRented = $res['rented'];
    }
    $quary = SpecialRead("library", "books", "*", "id", $BookID);
    while ($res = mysqli_fetch_assoc($quary)) {
        $temp = $res;
    }
    // echo $temp['id'];

    // name,writer,genre,BookID,UserID,date_rented
    if ($temp['stock'] > 0) {
        INSERT_RENTED("library", "randr", $temp['name'],$temp['writer'], $temp['img'], $temp['genre'], $temp['id'], $UserId, date("Y-m-d H:i:s"));
        $stock = $temp['stock'];
        $stock--;
        $UserRented++;

        Update('library', 'Books', 'stock', $stock, $temp['id']);
        Update('library', 'users', 'rented', $UserRented, $UserId);

        $Err = 1;

        header("Refresh:0; url=user.php?Err=".$Err);
        


    } else {
        $Err = 2;
        header("Refresh:0; url=user.php?Err=".$Err);

    }

    




    // echo $_SESSION['username'];
}
if(isset($_POST['give'])){
    $id = $_POST['give'];
    $BookId="";
    $UserId = "";
    $quary = SpecialRead("library", "randr", "*", "id", $id);
    while ($res = mysqli_fetch_assoc($quary)) {
        // "UPDATE $table SET $what='$input' WHERE id=$where";
        Update('library', 'randr', 'date_recived', date("Y-m-d H:i:s") , $res['id']);
        $BookId = $res['BookID'];
        $UserId = $res['UserID'];
    }

    $quary = SpecialRead("library", "users", "*", "id", $UserId);
    while ($res = mysqli_fetch_assoc($quary)) {
        $Rented = $res['rented'];
        $Rented--;
        Update('library', 'users', 'rented', $rented, $UserId);
    }

    $quary = SpecialRead("library", "Books", "*", "id", $BookId);
    while ($res = mysqli_fetch_assoc($quary)) {
        $stock = $res['stock'];
        $stock++;
        Update('library', 'Books', 'stock', $stock, $res['id']);
        $Err = 1;
        header("Refresh:0; url=myBooks.php?Err=".$Err);

    }



}



?>