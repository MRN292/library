<?php   

// echo $_SESSION['username'];
require 'FUNC_VALID.php';
require 'CRUD.php';
if(VALID_SESSION('user')==false){
    SESSION_DESTROYER();
    
    header("Location:index.php");
}

// session_start();


if (isset($_POST['rent'])) {

    $my_array = json_decode($_POST['rent']);


    $BookID = $my_array[0];
    $UserId = "";
    $UserRented = "";
    $temp = "";

    $quary = SpecialRead("library", "users", "*", "username", $my_array[1]);
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

        header("Refresh:0; url=user.php?Err=$Err&&username=$my_array[1]");
        


    } else {
        $Err = 2;
        header("Refresh:0; url=user.php?Err=$Err&&username=$my_array[1]");

    }

    




    // echo $_SESSION['username'];
}
if(isset($_POST['give'])){

    $my_array = json_decode($_POST['give']);
    $id = $my_array[0];
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
        header("Refresh:0; url=myBooks.php?Err=$Err&&username=$my_array[1]");

    }



}



?>