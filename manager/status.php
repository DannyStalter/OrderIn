<?php
defined('admin') or exit;
$restaurant = isset($_SESSION['account_rID']) ? $_SESSION['account_rID'] : '';

$stmt = $pdo->prepare('SELECT
    i.img AS img,
    i.name AS name,
    t.*,
    ti.item_price AS price,
    ti.item_quantity AS quantity,
    ti.item_options AS options
    FROM transactions t
    JOIN transactions_items ti ON ti.txn_id = t.txn_id
    JOIN items i ON i.id = ti.item_id
    JOIN items_restaurants ir ON ir.item_id = i.id 
    JOIN restaurants r ON r.id = ir.restaurant_id AND r.id = :restaurant_id
    ORDER BY t.created DESC');


$stmt->bindValue(':restaurant_id', $restaurant, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$status = array("In-Progress", "Completed");

?>

<?=template_manager_header('Orders')?>

<h2>Orders</h2>

<div class="content-block">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Item</td>
                    <td class="responsive-hidden">Date</td>
                    <td class="responsive-hidden">Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                    <td class="responsive-hidden">Email</td>
                    <td class="responsive-hidden">Status</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="8" style="text-align:center;">There are no recent orders</td>
                </tr>
                <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <tr class="details" onclick="location.href='index.php?page=statuschange&id=<?=$order['id']?>'">
                    <td class="img">
                        <?php if (!empty($order['img']) && file_exists('../imgs/' . $order['img'])): ?>
                        <img src="../imgs/<?=$order['img']?>" width="32" height="32" alt="<?=$order['name']?>">
                        <?php endif; ?>
                    </td>
                    <td><?=$order['name']?></td>
                    <td class="responsive-hidden"><?=date('F j, Y', strtotime($order['created']))?></td>
                    <td class="responsive-hidden"><?=currency_code?><?=number_format($order['price'],2)?></td>
                    <td><?=$order['quantity']?></td>
                    <td><?=currency_code?><?=number_format($order['price'] * $order['quantity'], 2)?></td>
                    <td class="responsive-hidden"><?=$order['payer_email']?></td>
                    <td class="responsive-hidden">
                    <td class="responsive-hidden"><?=$order['payment_status']?></td>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?=template_admin_footer()?>
