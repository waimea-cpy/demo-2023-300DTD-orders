<?php

    require_once 'common-session.php';

    unset( $_SESSION['cart'] );

    header( 'location: index.php' );

?>

