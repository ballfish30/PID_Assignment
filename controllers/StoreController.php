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
            $result = mysqli_query($link, $sql);
        }else{
            $sql = <<<mutil
                update cart
                set
                    quantity = $_GET[quantity],
                    total = $_GET[quantity]*$product[price]
                where
                    id = $cart[id]
            mutil;
            $result = mysqli_query($link, $sql);
        }
        $sql = <<<mutil
            insert into cart(
            orderId, produceId, quantity, total
            )
            values(
            "$productName", "$productPrice", "$productDescription", "$categoryId"
            )
        mutil;
        mysqli_query($link, $sql);
        echo('已加入購物車');
;    }
}
?>