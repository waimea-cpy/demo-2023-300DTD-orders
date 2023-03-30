<?php

    require_once 'common-top.php';

    $prodID = $_GET['id'];

    // Is the product in cart already?
    if( isset( $_SESSION['cart'][$prodID] ) ) {
        // Yes, so remove it
        unset( $_SESSION['cart'][$prodID] );
    }

    header( 'location: show-cart.php' );
?>