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
        <p>Welcome to Comic Canopy</b></p>
    </section>

    <section id="subscriptions">
        <h2>Your Subscriptions</h2>

        <?php
            // placeholder for loop
            //$subscriptionList = [];
            $subscriptionList = ["Alien Titan Comic", "Sad and Sexy Vampires Comic", "XKCD", "Red Rum Mysteries"];
        ?>


        <?php if (!empty($subscriptionList)): // if subscriptions list has items ?>
            <table id="subscription-table">
                <?php foreach ($subscriptionList as $sub): ?>
                    <tr>
                        <td>
                            <img src="assets/Acorn_CC.png" alt="comic image" />
                        </td>
                        <td>
                            <a href="comic_pages/comic_template.php" class="row_link">
                                <h3 class="comic_name"><?= htmlspecialchars($sub) ?></h3>
                                <p class="url">testingURL.com</p>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: // if subscriptions list is empty ?>
            <p>You have no subscriptions, yet</p>
        <?php endif; ?>

    </section>

        
</body>
</html>