<?php

defined('orderinsystem') or exit;

if (isset($_GET['query']) && $_GET['query'] != '') {

    $search_query = htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8');
    $stmt = $pdo->prepare('SELECT * FROM items WHERE name LIKE ? ORDER BY date_added DESC');
    $stmt->execute(['%' . $search_query . '%']);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_items = count($items);
} else {
    $error = 'No search query was specified!';
}
?>

<?=template_header('Search')?>

<?php if ($error): ?>

<p class="content-wrapper error"><?=$error?></p>

<?php else: ?>

<div class="items content-wrapper">

    <h1>Search Results for "<?=$search_query?>"</h1>

    <p><?=$total_items?> Items</p>

    <div class="items-wrapper">
        <?php foreach ($items as $item): ?>
        <a href="index.php?page=item&id=<?=$item['id']?>" class="item">
            <?php if (!empty($item['img']) && file_exists('imgs/' . $item['img'])): ?>
            <img src="imgs/<?=$item['img']?>" width="200" height="200" alt="<?=$item['name']?>">
            <?php endif; ?>
            <span class="name"><?=$item['name']?></span>
            <span class="price">
                <?=currency_code?><?=number_format($item['price'],2)?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>

</div>

<?php endif; ?>

<?=template_footer()?>
