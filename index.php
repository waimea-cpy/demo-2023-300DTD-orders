<?php

    require_once 'common-top.php';

    echo '<section class="hero">';
    echo   '<h1>Steve\'s Boutique</h1>';
    echo   '<p>Everything the modern human needs!</p>';
    echo '</section>';


    $sql = 'SELECT id,
                   name,
                   description,
                   price
            FROM products
            ORDER BY name ASC';

    $products = getRecords( $sql );

    echo '<section id="products-list" class="columns">';

    echo   '<header>';
    echo     '<h2>Our Product Range...</h2>';
    echo   '</header>';

    foreach( $products as $product ) {
        echo '<div class="card product">';
        echo   '<h3>'.$product['name'].'</h3>';
        echo   '<p>'.$product['description'].'</p>';
        echo   '<p>$'.$product['price'].' each</p>';

        echo   '<form method="POST" action="process-add-to-cart.php">';
        echo     '<label>Qty</label>';
        echo     '<input type="number" name="qty" min="1" value="1" required>';
        echo     '<input type="hidden" name="id" value="'.$product['id'].'">';
        echo     '<input type="submit" value="Add to cart">';
        echo   '</form>';
        echo '</div>';
    }

    echo '</section>';

    require_once 'common-bottom.php';

?>

