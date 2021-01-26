<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Get your link | Interclip</title>

  <!-- styles -->
  <link rel="stylesheet" href="../css/get.css">
  <link rel="stylesheet" href="../css/dark.css" media="(prefers-color-scheme: dark)">
  <link rel="stylesheet" href="../css/menu.css">

</head>

<body>

  <?php
  include_once "menu.php";

  if (!empty($_POST['user'])) {
    $user_code = $_POST['user'];

    include_once "./db.php";
    include_once "components/get.php";
  }

  if (!empty($url)) {
    function get_shorten_url($url)
    {
      $headers = get_headers($url, 1);
      if (isset($headers['Location'])) return $headers['Location'];
      else return $url;
    }
    $realUrl = get_shorten_url($url);
  }
  ?>

  <div id="fullscreen">
    <div class="fullscreen-content" id="resultSec">

      <div class="title">
        <h1><a id="urlLink" href="<?php if (isset($url)) {
                                    echo $url;
                                  } ?>"><?php if (isset($url)) {
                                        echo $url;
                                      } ?></a></h1>
        <?php
        if (isset($url)) {
          echo "<p>... is the URL of the code " . $user_code . "</p>";
        } else {
          http_response_code(404);
          echo "<p>There was no url found for the code " . $user_code . "</p>";
          die();
        }
        ?>
        <div id="embed"> </div>
        <img id="imgShow">
        <div id="output"> </div>

      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="../js/get.js"></script>
  <script type="module">
    import {
      embed
    } from "https://cdn.jsdelivr.net/gh/aperta-principium/embed.js/embed.min.js";

    embed("<?php echo $realUrl ?>");
  </script>

</body>

</html>