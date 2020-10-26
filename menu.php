<?php
include_once 'header.php';
?>

<!-- CSS TESTING -->

  <!-- MENU NAV LAYOUT -->

  <div class="flexbox-container-menuNav">

    <div class="menuNav-box menuNav-box-name"><p class="menuNav-p">Restaurant Name</p></div>
    <div class="menuNav-box menuNav-box-type"><p class="menuNav-p">Type of Restaurant</p></div>
    <div class="menuNav-box menuNav-box-time"><p class="menuNav-p">Estimated Time</p></div>
    <div class="menuNav-box menuNav-box-cart">
      <form class="search-form" action="#" method="post">
        <input type="text" placeholder="Search...">
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
    </div>
    <div class="menuNav-box menuNav-box-search"><p class="menuNav-p">Cart(0)</p></div>

  </div>

  <!-- MENU LAYOUT -->
<div class="flexbox-container-menu">

  <div class="menu-box menu-box-menu">
    <h3>Menu</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis quisquam, doloribus ipsa excepturi quos. Eum id eligendi nobis ea, inventore veniam error saepe at debitis rerum reprehenderit, unde tempora. Quasi?</p>
  </div>


  <div class="menu-box menu-box-menu-items">
    <h3 class="menu-title-box">Menu Items</h3>

    <?php
    include_once 'menu-items.php';
    ?>
    <div style="clear:both;"></div>

    <div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
    </div>
  </div>

  <div class="flexbox-container-aside">

    <div class="menu-box menu-box-cart-items">
      <h4>Cart Items</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis quisquam, doloribus ipsa excepturi quos. Eum id eligendi nobis ea, inventore veniam error saepe at debitis rerum reprehenderit, unde tempora. Quasi?</p>
    </div>
    <div class="menu-box menu-box-contact">
      <h6>Contact Info</h6>
      <p>Lorem ipsum</p>
    </div>

  </div>

</div>



</body>

</html>
