<?php
$link = include 'config.php';
$sql = <<<mutil
    select *, p.id from product as p inner join category as c on p.categoryId = c.id;
  mutil;
$result = mysqli_query($link, $sql);
?>
<script src='/PID_Assignment/js/jquery.min.js'></script>
<?php require_once('header.php'); ?>
<div class="wrap full-wrap">
  <div class="main-wrap">
    <section class="main main-archive">
      <div class="looｐ">
        <article class="post format-gallery post_format-post-format-gallery">
          <a href="#" title="陰間條例 夜神篇">
            <div class="part-gallery">
              <div class="flexslider">
                <ul class="slides">
                  <li><span class="post-image"><img width="502" height="502" src="/PID_Assignment/img/117960712_1478591842322708_5243812457812818534_o.jpg" alt="陰間條例 夜神篇" /></span></li>
                  <!-- <li><span class="post-image"><img width="502" height="502" src="/PID_Assignment/img/118076033_1485082471673645_778841976934694298_n.jpg" alt="Run-1" /></span></li>
                  <li><span class="post-image"><img width="502" height="502" src="/PID_Assignment/img/118398197_1483998731782019_4389253984520822273_o.jpg" alt="Run-2" /></span></li> -->
                </ul>
              </div>
            </div>
          </a>
          <div class="inner">
            <h2 class="entry-title">
              <a href="#" title="陰間條例 夜神篇">
                陰間條例 夜神篇 </a>
            </h2>
            <ul class="meta top">
              <li class="time">
                <a href="#" title="陰間條例 夜神篇">
                  <time class="post-date updated" datetime="2015-02-01">September 2, 2020</time>
                </a></li>
              <li class="comments post-tags">
                <a href="#">1
                  Comments</a></li>
              <li class="author-m post-tags">
                By <span class="vcard author post-author"><span class="fn"><a href="#" title="Posts by Clare Smith" rel="author">Ballfish</a></span></span>
              </li>
            </ul>
            <div class="post-content">
              <p>台灣第一款漫畫改編劇本殺於今天開始募資！
                知名漫畫「陰間條例」帶你進入記憶碎片的夜神旅店中，特別的玩法、多種結局令你意想不到的劇情！</p>
            </div>
          </div>
        </article>
      </div>
    </section>



    <h1>桌上有戲</h1>
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-md-4">
          <h3><?php echo $row['productName'] ?></h3>
          <div>
            <div class="pull-left">
              <img src="../<?php echo $row['picture']?>" style="background-size: contain; width:200px; height:250px" border="0" title="<?php echo $row['productName'] ?>">
            </div>
            <div class="pull-left">
              <h4><?php echo $row['price'] ?>$NTD</h4>
                <input type="hidden" value="<?php echo $row['id']?>">
                <div class="form-group">
                  <label>數量：</label>
                  <input type="number" value="1" class="form-control quantity">
                </div>
                <div class="form-group pull-right">
                  <butten class="btn btn-danger add-to-cart">
                    <i class="fa fa-shopping-cart">加入購物車</i>
                  </butten>
                </div>
            </div>
            <div class="clearfix">
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  </div><!-- /main-wrap -->
</div><!-- /wrap -->

<script>
  $(".add-to-cart").on("click", function() {
    $this = $(this);
    $productId = $this.parent().prev().parent().children().next().first().val();
    $quantity = $this.parent().parent().children().children().next().val();
  });
</script>
<?php require_once('footer.php'); ?>