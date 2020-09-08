<?php

class BackendController extends Controller
{
  function index()
  {
    $this->view("Backend/index");
  }



  function members()
  {
    $this->view("Backend/members");
  }



  function memberisActive()
  {
    // 資料庫連線參數
    $link = include 'config.php';
    $userId = $_GET['userId'];
    $sql = <<<mutil
      select * from user where id = '$userId';
      mutil;
    $result = mysqli_query($link, $sql);
    $search = mysqli_fetch_assoc($result);
    if ($search['isActive']) {
      $sql = <<<mutil
      update user
      set
        isActive = 0
      where
        id = '$userId';
      mutil;
    } else {
      $sql = <<<mutil
      update user
      set
        isActive = 1
      where
        id = '$userId';
      mutil;
    }
    if (mysqli_query($link, $sql)) {
      echo "已成功";
    } else {
      echo "失敗";
    }
  }



  function categorys()
  {
    $this->view("Backend/categorys");
  }



  function categoryCreate()
  {
    if($_SERVER['REQUEST_METHOD']=='GET') {
      if(isset($_GET['Message'])){
          echo $_GET['Message'];
      }
      return $this->view("Backend/categoryCreate");
    }
    $categoryName = $_POST['categoryName'];
    // 資料庫連線參數
    $link = include 'config.php';
    $sql = <<<mutil
        insert into category(
          categoryName
        )
        values(
          "$categoryName"
        )
    mutil;
    mysqli_query($link, $sql);
    return header("Location: http://localhost:8888/PID_Assignment/backend/categorys");
  }



  function categoryUpdate()
  {
    if($_SERVER['REQUEST_METHOD']=='GET') {
      if(isset($_GET['Message'])){
          echo $_GET['Message'];
      }
      return $this->view("Backend/categoryUpdate");
    }
    $categoryName = $_POST['categoryName'];
    $categoryId = $_POST['categoryId'];
    // 資料庫連線參數
    $link = include 'config.php';
    $sql = <<<mutil
    update category
    set
      categoryName = "$categoryName"
    where
        id = '$categoryId';
    mutil;
    mysqli_query($link, $sql);
    return header("Location: http://localhost:8888/PID_Assignment/backend/categorys");
  }




  function categoryDelete()
  {
    $categoryId = $_GET['categoryId'];
    // 資料庫連線參數
    $link = include 'config.php';
    $sql = <<<mutil
      DELETE FROM category
      WHERE
      id = "$categoryId";
    mutil;
    if (mysqli_query($link, $sql)) {
      echo "刪除成功";
      return header("Location: http://localhost:8888/PID_Assignment/backend/categorys");
    } else {
      echo "刪除失敗";
      return header("Location: http://localhost:8888/PID_Assignment/backend/categorys");
    }
  }



  function products()
  {
    $this->view("Backend/products");
  }



  function productCreate()
  {
    if($_SERVER['REQUEST_METHOD']=='GET') {
      if(isset($_GET['Message'])){
          echo $_GET['Message'];
      }
      return $this->view("Backend/productCreate");
    }
    $productName = $_POST['productName'];
    $categoryId = $_POST['categoryId'];
    $productPrice = $_POST['productPrice'];
    $productDescription = $_POST['productDescription'];
    $target_dir = "productImg/";
    // 資料庫連線參數
    $link = include 'config.php';
    $sql = <<<mutil
        insert into product(
          productName, price, description, categoryId
        )
        values(
          "$productName", "$productPrice", "$productDescription", "$categoryId"
        )
    mutil;
    mysqli_query($link, $sql);
    //取的剛新增資料的ＩＤ
    $newID = mysqli_insert_id($link);
    $sql = <<<mutil
        UPDATE product
        SET
          picture = "$target_dir$newID.jpg"
        where
          id = "$newID";
    mutil;
    mysqli_query($link, $sql);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newID . ".jpg");
    return header("Location: http://localhost:8888/PID_Assignment/backend/products");
  }



  function productUpdate(){
    if($_SERVER['REQUEST_METHOD']=='GET') {
      if(isset($_GET['Message'])){
          echo $_GET['Message'];
      }
      return $this->view("Backend/productUpdate");
    }
    // 資料庫連線參數
    $link = include 'config.php';
    $target_dir = "productImg/";
    $sql = <<<mutil
        UPDATE product
        SET
          productName = "$_POST[productName]",
          price = "$_POST[productPrice]",
          description = "$_POST[productDescription]",
          categoryId = $_POST[categoryId]
        where
          id = "$_POST[productId]";
    mutil;
    echo $sql;
    mysqli_query($link, $sql);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $_POST["productId"] . ".jpg");
    return header("Location: http://localhost:8888/PID_Assignment/backend/products");
  }



  function productDelete(){
    // 資料庫連線參數
    $link = include 'config.php';
    $productId = $_GET['productId'];
    $sql = <<<mutil
    delete from product where id = $productId
    mutil;
    mysqli_query($link, $sql);
    return $this->view('Backend/products');
  }



  function order(){
    $this->view("Backend/order");
  }
  function orders(){
    $this->view("Backend/orders");
  }
}
