<?php

    require_once 'common-top.php';

    if( !$loggedIn ) header( 'location: form-login.php' );

?>


    <section>
        <header class="middle">
            <h2>Placing Order...</h2>
        </header>

<?php

    if( isset( $_SESSION['cart'] ) ) {

        // Create a new order and get its ID
        $sql = 'INSERT INTO orders (user) VALUES (?)';
        $orderID = modifyRecords( $sql, 'i', $_SESSION['user']['id'] );

        showStatus( 'Order #'.$orderID.' created', 'success' );

        foreach( $_SESSION['cart'] as $prodID => $qty ) {
            $sql = 'INSERT INTO contains (`order`, product, qty) VALUES (?, ?, ?)';
            modifyRecords( $sql, 'iii', [$orderID, $prodID, $qty] );
        }
    }
    else {
        showStatus( 'Cart is empty', 'error' );
    }

    showStatus( 'Order placed successfully', 'success' );

    echo '</section>';

    unset( $_SESSION['cart'] );

    addRedirect();

    require_once 'common-bottom.php';
?>