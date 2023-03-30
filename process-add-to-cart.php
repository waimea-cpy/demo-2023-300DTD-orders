<?php

    require_once 'common-top.php';

    $prodID = $_POST['id'];
    $qty = $_POST['qty'];

    // Is the product in cart already?
    if( isset( $_SESSION['cart'][$prodID] ) ) {
        // Yes, so update qty
        $_SESSION['cart'][$prodID] += $qty;
    }
    else {
        //. Nope, so add it
        $_SESSION['cart'][$prodID] = $qty;
    }

    header( 'location: index.php' );
?>