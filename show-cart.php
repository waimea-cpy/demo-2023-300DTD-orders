<?php

    require_once 'common-top.php';

?>


        <header>
            <h2 class="centred">Your Cart</h2>
        </header>

<?php

    if( isset( $_SESSION['cart'] ) ) {

?>
        <table>

        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Item Cost</th>
                <th>Total Cost</th>
                <th></th>
            <tr>
        </thead>

        <tbody>

<?php
    $sql = 'SELECT name, price FROM products WHERE id = ?';
    $totalCost = 0;

    foreach( $_SESSION['cart'] as $id => $qty ) {
        $products = getRecords( $sql, 'i', $id );
        if( count( $products ) == 0 ) showErrorAndDie( 'Invalid product ID' );
        $product = $products[0];
        $productTotal = $qty * $product['price'];
        $totalCost += $productTotal;

        echo '<tr>';
        echo   '<td>'.$product['name'].'</td>';
        echo   '<td class="right">'.$qty.'</td>';
        echo   '<td class="right">$'.number_format( $product['price'], 2 ).'</td>';
        echo   '<td class="right">$'.number_format( $productTotal, 2 ).'</td>';
        echo   '<td><a href="process-remove-from-cart.php?id='.$id.'"
                       onclick="return confirm( `Remove item... Are you sure?` )">🗑</a></td>';
        echo '</tr>';
    }

?>
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th class="right">$<?= number_format( $totalCost, 2 ) ?></th>
                    <th></th>
                <tr>
            </tfoot>

        </table>

        <footer>
            <p class="centred">
              <a class="button error"
                 href="process-empty-cart.php"
                 onclick="return confirm( 'Empty Cart... Are you sure?' )">🗑 Empty Cart</a>

              <a class="button" href="process-new-order.php">Place Order</a>
            </p>
        </footer>

<?php

    }
    else {
        echo '<p>Cart is empty';
    }

    require_once 'common-bottom.php';
?>