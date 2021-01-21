<?php

defined('orderinsystem') or exit;
if (isset($_POST['item_id'], $_POST['quantity']) && is_numeric($_POST['item_id']) && is_numeric($_POST['quantity'])) {
    $item_id = (int)$_POST['item_id'];
    $quantity = abs((int)$_POST['quantity']);
    // Get item options
    $options = '';
    $options_price = 0.00;
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'option-') !== false) {
            $options .= str_replace('option-', '', $k) . '-' . $v . ',';
            $stmt = $pdo->prepare('SELECT * FROM items_options WHERE title = ? AND name = ? AND item_id = ?');
            $stmt->execute([ str_replace('option-', '', $k), $v, $item_id ]);
            $option = $stmt->fetch(PDO::FETCH_ASSOC);
            $options_price += $option['price'];
        }
    }
    $options = rtrim($options, ',');
    $stmt = $pdo->prepare('SELECT * FROM items WHERE id = ?');
    $stmt->execute([ $_POST['item_id'] ]);
  
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if item exists 
    if ($item && $quantity > 0) {
      
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $cart_item = &get_cart_item($item_id, $options);
            if ($cart_item) {
                $cart_item['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][] = array(
                    'id' => $item_id,
                    'quantity' => $quantity,
                    'options' => $options,
                    'options_price' => $options_price,
                );
            }
        }
    }
    header('location: index.php?page=cart');
    exit;
}
// Remove item from cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header('location: index.php?page=cart');
    exit;
}
// Empty cart
if (isset($_POST['emptycart']) && isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    header('location: index.php?page=cart');
    exit;
}
// Update item quantities in cart
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = abs((int)$v);
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                $_SESSION['cart'][$id]['quantity'] = $quantity;
            }
        }
    }
    header('location: index.php?page=cart');
    exit;
}
if (isset($_POST['checkout']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=checkout');
    exit;
}

$items_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$subtotal = 0.00;
// If there are items in cart
if ($items_in_cart) {
    $array_to_question_marks = implode(',', array_fill(0, count($items_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM items WHERE id IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_column($items_in_cart, 'id'));
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($items_in_cart as &$cart_item) {
        foreach ($items as $item) {
            if ($cart_item['id'] == $item['id']) {
                $cart_item['meta'] = $item;

                if ($cart_item['options_price'] > 0) {
                    $subtotal += (float)$cart_item['options_price'] * (int)$cart_item['quantity'];
                } else {
                    $subtotal += (float)$item['price'] * (int)$cart_item['quantity'];
                }
            }
        }
    }
}
?>

<?=template_header('Order IN')?>

<div class="cart content-wrapper">

    <h1>Order IN</h1>

    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Item</td>
                    <td></td>
                    <td class="rhide">Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($items_in_cart)): ?>
                <tr>
                    <td colspan="6" style="text-align:center;">You have no items added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($items_in_cart as $num => $item): ?>
                <tr>
                    <td class="img">
                        <?php if (!empty($item['meta']['img']) && file_exists('imgs/' . $item['meta']['img'])): ?>
                        <a href="index.php?page=item&id=<?=$item['id']?>">
                            <img src="imgs/<?=$item['meta']['img']?>" width="50" height="50" alt="<?=$item['meta']['name']?>">
                        </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?page=item&id=<?=$item['id']?>"><?=$item['meta']['name']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$num?>" class="remove">Remove</a>
                    </td>
                    <td class="price">
                        <?=$item['options']?>
                        <input type="hidden" name="options" value="<?=$item['options']?>">
                    </td>
                    <?php if ($item['options_price'] > 0): ?>
                    <td class="price rhide"><?=currency_code?><?=number_format($item['options_price'],2)?></td>
                    <?php else: ?>
                    <td class="price rhide"><?=currency_code?><?=number_format($item['meta']['price'],2)?></td>
                    <?php endif; ?>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$num?>" value="<?=$item['quantity']?>" min="1" <?php if ($item['meta']['quantity'] != -1): ?>max="<?=$item['meta']['quantity']?>"<?php endif; ?> placeholder="Quantity" required>
                    </td>
                    <?php if ($item['options_price'] > 0): ?>
                    <td class="price"><?=currency_code?><?=number_format($item['options_price'] * $item['quantity'],2)?></td>
                    <?php else: ?>
                    <td class="price"><?=currency_code?><?=number_format($item['meta']['price'] * $item['quantity'],2)?></td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php $time = 0; ?>
        <?php if (!empty($items_in_cart)): ?>
            <?php foreach ($items as $i): ?> 
                <?php if ($i['time'] >= $time): ?>
                    <?php $time = $i['time']; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price"><?=currency_code?><?=number_format($subtotal,2)?></span>
            <span class="text"></span>
            <span class="text">ETA</span>
            <td class="time"><?=$time . ' min'?></td>
        </div>
        <div class="buttons">
            <input type="submit" value="Empty Cart" name="emptycart">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Checkout" name="checkout">
        </div>

    </form>

</div>

<?=template_footer()?>
