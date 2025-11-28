<?php


?>

<!DOCTYPE html>
<html lang="<?php language_attributes();?>" class="no-js">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add wp_head function for title -->
    <?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>> <!-- Add body class for loading wordpress classes -->
    
    <header>
       <div class="container">
            <nav class="nav montserrat" id="nav">
                <div class="logo-container">
                    <h3 class="logo"> <?php echo get_theme_mod('webaura_logo');?></h3>
                </div>
                <?php wp_nav_menu( array(
                    'theme_location' => 'main_menu',
                    'menu_id' => 'nav',
                ) ); ?>
                <!-- <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Portfolios</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Contact</a></li>
                </ul> -->
            </nav>
       </div>
    </header>
    <main>

    </main>
    <footer>

    </footer>   
    
<!-- Add wp_footer function for title -->
<?php wp_footer( ); ?>
</body>
</html>