<?php
    require_once 'common-session.php';
    require_once 'common-functions.php';

    // Check if user is logged in
    // i.e. we have valid credentials in session
    $loggedIn = isset( $_SESSION['user'] );

    $cartCount = isset( $_SESSION['cart'] ) ? ('('.count( $_SESSION['cart'] ).')') : '';
?>


<!doctype html>

<html>

<head>
    <title>Steve's Boutique</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/simple.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="light">
    <header>

        <h1><a href="./">Steve's Boutique</a></h1>

<?php
    if( $loggedIn ) {
        echo '<div class="user">';
        echo   $_SESSION['user']['forename'].' '.$_SESSION['user']['surname'].' ';
        echo   '('.$_SESSION['user']['username'].')';
        echo '</div>';
    }
?>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
<?php
    if( $loggedIn ) {
        echo '<li><a href="show-orders.php">My Orders</a></li>';
        echo '<li><a href="process-logout.php">Logout</a></li>';
    }
    else {
        echo '<li><a href="form-login.php">Login</a></li>';
        echo '<li><a href="form-new-user.php">Sign Up</a></li>';
    }

    echo '<li><a href="show-cart.php">🛒 '.$cartCount.'</a></li>';
?>
            </ul>
        </nav>


    </header>

    <?php showDebugInfo(); ?>

    <main>

