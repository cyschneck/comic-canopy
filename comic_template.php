<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/comic_page.css">
    <link rel="icon" type="image/x-icon" href="assets/Acorn_CC.png">
    <title>Comic Canopy</title>
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
        // collect comic data
        $get_name = $_GET["comic_name"];
        $all_comics_query = $pdo->query("SELECT * FROM all_comics WHERE `Table Name` = '$get_name'");
        $all_comics_results = $all_comics_query->fetchAll(PDO::FETCH_ASSOC);
        $comic_row = $all_comics_results[0];
    ?>

    <section id="welcome">
        <section id="comic_header">
            <img src="assets/Acorn_CC.png" alt="comic image" />
            <section id="name_author">
                <h1><?= $comic_row["Comic Name"] ?></h1>
                <h3>
                    <?php 
                        $authors_str = $comic_row["Authors"];
                        $authors_str = str_replace(['"', "“", '“', "”"], '', $authors_str); // stripe out quotes
                    ?>
                    <?= $authors_str ?>
                </h3>
            </section>
        </section>
    </section>

    <section id="about_comic">
        <p><b>About:</b></p>
        <p>
            <?php
                $description = $comic_row["Long Description"];
                $description = str_replace(['"', "“", '“', "”"], '', $description); // stripe out quotes
                $description = str_replace(['\n'], ' ', $description); // stripe out newline characters
            ?>
            <?=$description ?>
        </p>
    </section>
    
    <section id="comic_table">

        <?php
            // query indivual comic table
            $tableName = $comic_row["Table Name"];

            try {
                // check if table exists
                $comic_query = $pdo->query("SELECT * FROM $tableName");
                $comic_pages_result = $comic_query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $comic_pages_result = [];
            }
        ?>
        
        <?php if (!empty($comic_pages_result)): ?>
            <table id="comic_pages">
                <?php foreach ($comic_pages_result as $page): ?>
                    <tr class="comic_unread <?= $page["Page Number"] ?>" class="full_comic_row">
                        <td class="comic_page_details">
                            <a href="iframe.php?comic_name=<?=$tableName ?>&page_num=<?=$page['Page Number'] ?>" class="row_link">
                                <h3>Page <?= $page["Page Number"] ?></h3>
                                <p> <?= $page["Page URL"] ?></p>
                            </a>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropbtn">⋮</button>
                                <div class="dropdown-content">
                                    <a href="#">Mark as Read</a>
                                    <a href="#">Read Up to Here</a>
                                    <a href="#">Mark as Unread</a>
                                    <a href="#">Unread Up to Here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: // if subscriptions list is empty ?>
            <p id="no_pages_found">This comic has no pages, odd</p>
        <?php endif; ?>
    </section>
    
</body>
</html>