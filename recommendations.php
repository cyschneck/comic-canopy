<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/recommendations.css">
    <script src="javascript/recommendations.js"></script> 
    <title>Comic Canopy - Recommmendations</title>
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

    <?php    
        $dsn = "mysql:host=localhost;dbname=comic_canopy";
        $dbusername = "root";
        $dbpassword = "";

        try {
            // connect to database
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // report back error message on fail connectioned
            echo "Connection failed: " . $e->getMessage();
        }
        // populate recommendations page based on all existing comics
        $all_comics_query = $pdo->query("SELECT * FROM all_comics");
        $all_comics_results = $all_comics_query->fetchAll(PDO::FETCH_ASSOC);
    ?>


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

            <?php if (!empty($all_comics_results)): // if subscriptions list has items ?>
                <table id="recommendation-table">
                    <?php foreach ($all_comics_results as $comic_row): ?>
                        <tr>
                            <td>
                                <a href="comic_template.php?comic_name=<?= $comic_row["Table Name"] ?>" class="row_link">
                                    <h3 class="comic_name"> <?= $comic_row["Comic Name"] ?></h3>
                                    <p class="url"><?= $comic_row["Base URL"] ?></p>
                                    <section class="tags">
                                        <ul>
                                            <?php 
                                                $comic_tags_str = $comic_row["Tags"];
                                                $comic_tags_str = str_replace(['"', "“", '“', "”"], '', $comic_tags_str); // stripe out quotes
                                                $all_tags = preg_split('/,\s*/', $comic_tags_str);
                                                foreach ($all_tags as $comic_tag):
                                             ?>
                                                <li><?= $comic_tag ?></li>
                                            <?php endforeach; ?>
                                            <?php if ($comic_row["Length"] >= 250) {?>
                                                <li>Long Comic</li>
                                            <?php } if ($comic_row["Length"] <= 100) {?>
                                                <li>Short Comic</li>
                                            <?php }?>
                                            
                                        </ul>
                                    </section>
                                    <p class="description">
                                        <?php
                                            $description = $comic_row["Long Description"];
                                            $description = str_replace(['"', "“", '“', "”"], '', $description); // stripe out quotes
                                            $description = str_replace(['\n'], ' ', $description); // stripe out newline characters
                                        ?>
                                        <?=$description ?>
                                    </p>
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