<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/iframe.css">
      <link rel="icon" type="image/x-icon" href="assets/Acorn_CC.png">
    <title>Comic Canopy</title>
</head>
<body>


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

        // query indivual comic table
        $get_page_num = $_GET["page_num"];
        $tableName = $comic_row["Table Name"];

        try {
              // check if table exists
              $comic_query = $pdo->query("SELECT * FROM $tableName WHERE `Page Number` = '$get_page_num'");
              $comic_page_num = $comic_query->fetchAll(PDO::FETCH_ASSOC);
              $comic_page_num = $comic_page_num[0];
        } catch (PDOException $e) {
              $comic_page_num = [];
          }
    ?>

  <div class="wrapper">

    <iframe src=<?= $comic_page_num["Page URL"]; ?> id="internal-website"></iframe>

    <nav class="overlay-nav">
      <ul>
          <li><a href="comic_template.php?comic_name=<?= $comic_row["Table Name"] ?>" class="row_link">X</a></li>
          <!--<li><button id="minimize">↓</button></li>-->
          <div class="dropdown">
              <button class="settings">⋮</button>
                  <div class="dropdown-content">
                      <button class="selected">Default: Arrows</button>
                      <button class="unselected">Click to Proceed</button>
                      <button class="unselected">Click Website (Untracked)</button>
                  </div>
          </div>
          <li><button id="favorite_page">☆</button></li>

          <?php
            // get first and last page
            $page_query = $pdo->query("SELECT * FROM $tableName");
            $page_query_requests = $page_query->fetchAll(PDO::FETCH_ASSOC);
            $first_page = $page_query_requests[0]["Page Number"];
            $last_page = $page_query_requests[count($page_query_requests) - 1]["Page Number"];

            // get previous page
            if ($get_page_num == 1) {
              $previous_page = 1; // set to 1 if at the first page
            } else {
                $page_before_query = $pdo->query("SELECT * FROM $tableName WHERE `Page Number` < '$get_page_num' ORDER BY `Page Number` DESC LIMIT 1;");
                $page_before_query_request = $page_before_query->fetchAll(PDO::FETCH_ASSOC);
                $previous_page = $page_before_query_request[0]["Page Number"];
            }

            // get next page
            if ($get_page_num == count($page_query_requests)) {
              $next_page = $get_page_num; // if on last page, set to current page
            } else {
                $page_next_query = $pdo->query("SELECT * FROM $tableName WHERE `Page Number` > '$get_page_num' ORDER BY `Page Number` ASC LIMIT 1;");
                $page_next_query_request = $page_next_query->fetchAll(PDO::FETCH_ASSOC);
                $next_page = $page_next_query_request[0]["Page Number"];
            }
            
          ?>
          <li><a href="iframe.php?comic_name=<?=$tableName ?>&page_num=<?=$previous_page ?>" class="previous">⇦</a></li>
          <li><a href="iframe.php?comic_name=<?=$tableName ?>&page_num=<?=$first_page ?>" class="first_page">↞</a></li>
          <li><a href="iframe.php?comic_name=<?=$tableName ?>&page_num=<?=$last_page ?>" class="last_page">↠</a></li>
          <li><a href="iframe.php?comic_name=<?=$tableName ?>&page_num=<?=$next_page ?>" class="next">⇨</a></li>
      </ul>
      <p id="page_url"><?= $comic_page_num["Page URL"]; ?></p>
    </nav>
    
  </div>
    
</body>
</html>