<?php
// v Different way of accessing database. Cart only able to access DB with db.php
include('db.php');
$status="";
// "Code" is equivalent to "MenuItemID" from our ERD. Our Primary Key.
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query(
$con,
"SELECT * FROM `menu` WHERE `code`='$code'"
);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$time = $row['time'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
 $code=>array(
 'name'=>$name,
 'code'=>$code,
 'price'=>$price,
 'time'=>$time,
 'quantity'=>1,
 'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Item has been added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
 $status = "<div class='box' style='color:red;'>
 Item is already in your cart!</div>";
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Item has been added to your cart!</div>";
 }

 }
}
?>

<!-- Header start -->

<?php
include_once 'header.php';
?>


<div class="menu-items-inner-flexbox">


<?php
$result = mysqli_query($con,"SELECT * FROM `menu`");
while($row = mysqli_fetch_assoc($result)){
    echo "<div class=''>
    <div class='menu-inner-items'>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <div class='image'><img style='width: 280px; height: 210px;' src='".$row['image']."' /></div>
    <div class='name'>".$row['name']."</div>
    <div class='price'>$".$row['price']."</div>
    <button type='submit' class='buy'>Buy Now</button>
    </form>
    </div>
    </div>"
    ;
        }
    mysqli_close($con);
  ?>

  <?php
  if(!empty($_SESSION["shopping_cart"])) {
  $cart_count = count(array_keys($_SESSION["shopping_cart"]));
  ?>
  <div class="cart_div">
  <a href="cart.php"><img class="cart-icon" src="images/cart-icon.png" /> Cart<span>
  <?php echo $cart_count; ?></span></a>
  </div>
  <?php
  }
  ?>

</div>


<!-- ^End div of Menu Items flex content -->


</body>
</html>
