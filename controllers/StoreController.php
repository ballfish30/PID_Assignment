<?php

class StoreController extends Controller
{

    function index()
    {
        $this->view("Store/index");
    }



    function cartAdd(){
        session_start();
        // 資料庫連線參數
        $link = include 'config.php';
        //抓取商品
        $sql = <<<mutil
          select * from product where id = "$_GET[productId]";
        mutil;
        $result = mysqli_query($link, $sql);
        $product = mysqli_fetch_assoc($result);
        //確認購物車是否有重複商品
        $sql = <<<mutil
          select * from cart where orderid = "$_SESSION[orderId]" and productId = "$_GET[productId]";
        mutil;
        $result = mysqli_query($link, $sql);
        $cart = mysqli_fetch_assoc($result);
        if ($cart == Null){
            $sql = <<<mutil
                insert into cart(orderId, productId, quantity, total)
                values($_SESSION[orderId], $product[id], $_GET[quantity], $product[price]*$_GET[quantity])
            mutil;
        }else{
            $sql = <<<mutil
                update cart
                set
                    quantity = quantity + $_GET[quantity],
                    total = quantity*$product[price]
                where
                    id = $cart[id]
            mutil;
        }
        if(mysqli_query($link, $sql)){
            echo('已加入購物車');    
        }else{
            echo('請先登入會員');
        }
    }



    function cartUpdate(){
        session_start();
        // 資料庫連線參數
        $link = include 'config.php';
        //抓取商品
        $sql = <<<mutil
          select * from product where id = "$_GET[productId]";
        mutil;
        $result = mysqli_query($link, $sql);
        $product = mysqli_fetch_assoc($result);
        $sql = <<<mutil
            update cart
            set
                quantity = $_GET[quantity],
                total = quantity*$product[price]
            where
                id = $_GET[cartId]
        mutil;
        if(mysqli_query($link, $sql)){
            echo('已更改購物車');    
        }else{
            echo('更改失敗');
        }
    }



    function orderCheck(){
        session_start();
        // 資料庫連線參數
        $link = include 'config.php';
        //確定訂單金額
        $sql = <<<mutil
          select * from cart where orderId = "$_SESSION[orderId]";
        mutil;
        $result = mysqli_query($link, $sql);
        $orderTotal;
        while($cart = mysqli_fetch_assoc($result)):
            $orderTotal += $cart['total'];
        endwhile;
        $sql = <<<mutil
          update orders
            set
                total = $orderTotal
            where
                id = $_SESSION[orderId]
        mutil;
        mysqli_query($link, $sql);
        return $this->view('store/orderCheck');
    }



    function carts(){
        $this->view('Store/carts');
    }



    function pay(){
        $this->view('Store/sample_All_CreateOrder');
    }
}
?>