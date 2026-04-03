<!DOCTYPE html>
<html>
<head>
    <title>Aruix</title>
    <?php wp_head(); // WordPress hook that outputs scripts, styles, and other <head> elements ?>
</head>
<body>
    <header>
        <h1>Aruix</h1>
        <nav>
            <?php
                // Render a navigation menu assigned to the 'primary' theme location
                wp_nav_menu(array(
                    'theme_location' => 'primary'
                ));
            ?>
        </nav>
    </header>