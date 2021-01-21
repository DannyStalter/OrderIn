<?php
defined('orderinsystem') or exit;
if (isset($_POST['login'], $_POST['email'], $_POST['password']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    // Check if the account exists
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ?');
    $stmt->execute([ $_POST['email'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($account && password_verify($_POST['password'], $account['password'])) {
        session_regenerate_id();
        $_SESSION['account_loggedin'] = TRUE;
        $_SESSION['account_id'] = $account['id'];
        $_SESSION['account_admin'] = $account['admin'];
        $_SESSION['account_rID'] = $account['rID'];
        $items_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        if ($items_in_cart) {
            header('Location: index.php?page=checkout');
        } else {
            header('Location: index.php?page=myaccount');
        }
        exit;
    } else {
        $error = 'Incorrect Email/Password!';
    }
}

$register_error = '';
// Registration
if (isset($_POST['register'], $_POST['email'], $_POST['password'], $_POST['cpassword']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    // Check if the account exists
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ?');
    $stmt->execute([ $_POST['email'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($account) {
        $register_error = 'Account already exists with this email!';
    } else if ($_POST['cpassword'] != $_POST['password']) {
        $register_error = 'Passwords do not match!';
    } else {
        $stmt = $pdo->prepare('INSERT INTO accounts (email, password, first_name, last_name, address_street, address_city, address_state, address_zip, address_country) VALUES (?,?,"","","","","","","")');
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->execute([ $_POST['email'], $password ]);
        $account_id = $pdo->lastInsertId();
        session_regenerate_id();
        $_SESSION['account_loggedin'] = TRUE;
        $_SESSION['account_id'] = $account_id;
        $_SESSION['account_admin'] = 0;
        $_SESSION['account_rID'] = 0;
        $items_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        if ($items_in_cart) {
            header('Location: index.php?page=checkout');
        } else {
            header('Location: index.php?page=myaccount');
        }
        exit;
    }
}

if (isset($_SESSION['account_loggedin'])) {
    $stmt = $pdo->prepare('SELECT
        i.img AS img,
        i.name AS name,
        t.created AS transaction_date,
        i.time AS `time`,
        t.payment_status AS status,
        ti.item_price AS price,
        ti.item_quantity AS quantity
        FROM transactions t
        JOIN transactions_items ti ON ti.txn_id = t.txn_id
        JOIN accounts a ON a.id = t.account_id
        JOIN items i ON i.id = ti.item_id
        WHERE t.account_id = ?
        ORDER BY t.created DESC');
    $stmt->execute([ $_SESSION['account_id'] ]);
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?=template_header('My Account')?>

<div class="myaccount content-wrapper">

    <?php if (!isset($_SESSION['account_loggedin'])): ?>

    <div class="login-register">

        <div class="login">

            <h1>Login</h1>

            <form action="index.php?page=myaccount" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="john@example.com" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input name="login" type="submit" value="Login">
            </form>

            <?php if ($error): ?>
            <p class="error"><?=$error?></p>
            <?php endif; ?>

        </div>

        <div class="register">

            <h1>Register</h1>
               
            <form action="index.php?page=myaccount" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="name@example.com" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required>
                <input name="register" type="submit" value="Register">
            </form>

            <?php if ($register_error): ?>
            <p class="error"><?=$register_error?></p>
            <?php endif; ?>

        </div>

    </div>

    <?php else: ?>

    <h1>My Account</h1>

    <h2>My Orders</h2>

    <table>
        <thead>
            <tr>
                <td colspan="2">Item</td>
                <td class="rhide">Date</td>
                <td>ETA</td>
                <td>Status</td>
                <td class="rhide">Price</td>
                <td>Quantity</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transactions)): ?>
            <tr>
                <td colspan="8" style="text-align:center;">You have no recent orders</td>
            </tr>
            <?php else: ?>
            <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td class="img">
                    <?php if (!empty($transaction['img']) && file_exists('imgs/' . $transaction['img'])): ?>
                    <img src="imgs/<?=$transaction['img']?>" width="50" height="50" alt="<?=$transaction['name']?>">
                    <?php endif; ?>
                </td>
                <td><?=$transaction['name']?></td>
                <td class="rhide"><?=$transaction['transaction_date']?></td>
                <td class="time"><?=$transaction['time']?></td>
                <td class="status"><?=$transaction['status']?></td>
                <td class="price rhide"><?=currency_code?><?=number_format($transaction['price'],2)?></td>
                <td class="quantity"><?=$transaction['quantity']?></td>
                <td class="price"><?=currency_code?><?=number_format($transaction['price'] * $transaction['quantity'],2)?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php endif; ?>

</div>

<?=template_footer()?>
