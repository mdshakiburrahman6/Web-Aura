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
            <nav class="nav" id="nav">
                <div class="logo-container">
                    <h3 class="logo">Web<span>Aura</span></h3>
                </div>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Portfolios</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
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