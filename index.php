<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Comic Canopy</title>
</head>
<body> 
    <header class="header-main">
        <div class="header-main-logo">
            <a href="index.php"><img src="assets/Acorn_CC.png" alt="cc-logo"></a>
            <nav class="header-main-nav">
                <ul>
                    <li><a href="recommendations.php">Recommendations</a></li>
                    <li><a href="comic_pages/comic_template.php">Testing</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="welcome">
        <h1>Home</h1>
        <p>Welcome to Comic Canopy</p>
    </section>

    <?php
        
    ?>

    <section id="subscriptions">
        <h2>Your Subscriptions</h2>

        <?php
            $subscriptionList = false;
            if (!$subscriptionList) {
                // If no subscriptions, default text
                ?>
                    <p>You have no subscriptions, yet</p>
                <?php
            }
        ?>

</section>

</body>
</html>