<?php

    require_once 'common-top.php';

?>

    <h2 class="centred">Your Orders</h2>


<?php

    $sql = 'SELECT * FROM orders WHERE user = ? ORDER BY datetime DESC';
    $orders = getRecords( $sql, 'i', $_SESSION['user']['id'] );

    foreach( $orders as $order ) {
?>

        <div class="card">
            <h3>Order #<?= sprintf( '%05d', $order['id'] ) ?></h3>

            <p>Placed on <strong><?= niceDate( $order['datetime'] ) ?></strong>
               at <strong><?= niceTime( $order['datetime'] ) ?></strong></p>

            <table>

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Item Cost</th>
                        <th>Total Cost</th>
                    <tr>
                </thead>

                <tbody>

<?php
    // Get the products for this order
    $sql = 'SELECT products.name,
                    products.price,
                    contains.qty
            FROM products
            JOIN contains ON products.id = contains.product
            WHERE `order` = ?';
    $products = getRecords( $sql, 'i', $order['id'] );
    $totalCost = 0;

    foreach( $products as $product ) {
        $productTotal = $product['qty'] * $product['price'];
        $totalCost += $productTotal;

        echo '<tr>';
        echo   '<td>'.$product['name'].'</td>';
        echo   '<td class="right">'.$product['qty'].'</td>';
        echo   '<td class="right">$'.number_format( $product['price'], 2 ).'</td>';
        echo   '<td class="right">$'.number_format( $productTotal, 2 ).'</td>';
        echo '</tr>';
    }

?>
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th class="right">$<?= number_format( $totalCost, 2 ) ?></th>
                    <tr>
                </tfoot>
            </table>

            <p><?= $order['processed'] ? '<strong class="success">Processed</strong>'
                                       : '<span class="error">Not processed yet</span>' ?>

        </div>

<?php
    }

    require_once 'common-bottom.php';
?>