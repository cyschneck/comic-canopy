<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/recommendations.css">
     <script src="javascript/recommendations.js"></script> 
    <title>Comic Canopy - FAQ</title>
</head>
<body>
    <header class="header-main">
        <div class="header-main-logo">
            <a href="index.php"><img src="assets/Acorn_CC.png" alt="cc-logo"></a>
            <nav class="header-main-nav">
                <ul>
                    <li><a href="recommendations.php">Recommendations</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <section id="recommendations">
        <h2>Recommendations</h2>

        <input type="text" placeholder="Search for comic..." id="comicName" onkeyup="searchComicsByName()">
        <section id="tag_grids">
            <ul>
                <li>Essential Reading</li>
                <li>Fantasy</li>
                <li>Science-Fiction</li>
                <li>Horror</li>
                <li>Educational</li>
                <li>Romance</li>
                <li>Comedy</li>
            </ul>
        </section>

        <section id="recommendation-list">

            <?php
                // placeholder testing for loop
                $all_comics = ["Red Rum Mysteries", "Sad and Sexy Vampires Comic", "XKCD"];
                $comic_urls = ["mystery-red.com", "hotVampiresNearYou.com", "xkcd.com"];
            ?>

            <?php if (!empty($all_comics)): // if subscriptions list has items ?>
                <table id="recommendation-table">
                    <?php foreach ($all_comics as $index => $comic): ?>
                        <tr>
                            <td>
                                <a href="comic_pages/comic_template.php" class="row_link">
                                    <h3 class="comic_name"> <?= htmlspecialchars($comic) ?></h3>
                                    <p class="url"><?= htmlspecialchars($comic_urls[$index]) ?></p>
                                    <section class="tags">
                                        <ul>
                                            <li>Fantasy</li>
                                            <li>Horror</li>
                                            <li>Romance</li>
                                        </ul>
                                    </section>
                                    <p class="description">This is a very long description of the comic that is not exactly the same as the "about" comic section, just a short blurb with relevant tags and the like</p>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <?php else: // if full list is empty ?>
                <p>There are no recommendations, odd</p>
            <?php endif; ?>

        </section>
    </section> 
</body>
</html>