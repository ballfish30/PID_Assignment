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



  function products()
  {
    $this->view("Backend/products");
  }



  function categorys()
  {
    $this->view("Backend/categorys");
  }



  function categoryCreate()
  {
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
    return header("Location: http://localhost:8888/PID_Assignment/backend/categorys");
  }



  function categoryUpdate()
  {
    $categoryName = $_POST['categoryName'];
    $categoryId = $_POST['categoryId'];
    // 資料庫連線參數
    $link = include 'config.php';
    $sql = <<<mutil
    update rainfallNow
    set
      categoryName = "$categoryName"
    where
        id = '$categoryId';
    mutil;
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
    } else {
      echo "刪除失敗";
    }
  }
}
