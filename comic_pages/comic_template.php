<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/comic_page.css">
    <title>Comic Canopy</title>
</head>
<body>

    <header class="header-main">
        <div class="header-main-logo">
            <a href="../index.php"><img src="../assets/Acorn_CC.png" alt="cc-logo"></a>
            <nav class="header-main-nav">
                <ul>
                    <li><a href="recommendations.php">Recommendations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="welcome">
        <section id="comic_header">
            <img src="../assets/Acorn_CC.png" alt="comic image" />
            <section id="name_author">
                <h1>Long Comic Name Here</h1>
                <h3>Author Name, Artist Name</h3>
            </section>
        </section>
    </section>

    <section id="about_comic">
        <p><b>About:</b></p>
        <p>This is a place to put the general about this comic section, but it will be pretty long so it would be good to be able to have the option to collapse the text if it is getting to long, just like this actually. A text that is more than four or five rows should be collapsed down to prevent it from taking up too much of the screen</p>
    </section>

    <section id="comic_table">
        <?php
            $pageList = range(1, 6);
            $read_unread = ["comic_read", "comic_read", "comic_unread", "comic_unread", "comic_unread", "comic_unread", "comic_unread", "comic_unread", "comic_unread"]
        ?>


        <?php if (!empty($pageList)): // if subscriptions list has items ?>
            <table id="comic_pages">
                <?php foreach ($pageList as $index => $page): ?>
                    <tr class="<?= htmlspecialchars($read_unread[$index]) ?> <?= htmlspecialchars($page) ?>">
                        <td class="comic_page_details">
                            <h3>Page <?= htmlspecialchars($page) ?></h3>
                            <p>https://testing.com/comic/page-<?= htmlspecialchars($page) ?></p>
                        </td>
                        <td>Continue Reading</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropbtn">⋮</button>
                                <div class="dropdown-content">
                                    <a href="#">Mark as Read</a>
                                    <a href="#">Read Up to Here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: // if subscriptions list is empty ?>
            <p>This comic as no pages, odd</p>
        <?php endif; ?>

    </section>    
    
</body>
</html>