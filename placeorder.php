<?php

defined('orderinsystem') or exit;
unset($_SESSION['cart']);
?>
<?=template_header('Place Order')?>

<?php if ($error): ?>
<p class="content-wrapper error"><?=$error?></p>
<?php else: ?>
<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us, if you have an account with us, your order details will be in the My Account section.</p>
</div>
<?php endif; ?>

<?=template_footer()?>
