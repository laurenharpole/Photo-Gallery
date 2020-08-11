<?php include("includes/init.php"); ?>

<?php
$params = array(
  ':search' => $search
);
$record = exec_sql_query($db, "SELECT * FROM images")->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="styles.css">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gallery</title>
</head>

<body>
  <div class="top">
    <h2 class="data"> <a class="back" href="https://laurenharpole.github.io/port/work.html">⬅</a></h2>
    <h4>PHOTOGRAPHY AND DEVELOPMENT</h4>
    <h2 class="data">Freelance Photography and Full-Stack Web Development</h2>
    <p class="data">I’ve had a camera in my hand since I was a young girl. My fascination with capturing seconds of life eventually developed into a freelancing job, which has gone on for more than three years. Below is a gallery of some of my most recent work, spanning multiple genres from portraiture to nature. Hit the dropdown to sort by tag. Click the magnifying glass to search. <em>I built this sort-able gallery using Php, SQL, CSS, HTML5, and Javascript.</em> <a href="#" class="git"> View Github</a></p>
  </div>
  <div class="gallery">

    <?php
    function gallery_element($record)
    {
      if (intval($record["id"]) < 35) {
    ?>
        <div>
          <?php
          global $db;
          $path = "uploads/images/";
          $img = $path . $record["id"] . $record["file_ext"];
          $alt = $record["id"];

          ?>
          <?php
          $img_tags = exec_sql_query($db, "SELECT * FROM tags INNER JOIN maptags ON tag_id = id WHERE img_id = $alt")->fetchAll();


          $data = array(

            'src' => $record['id']
          );
          $urlTemp = "index.php?";
          $the_data = http_build_query($data);
          $url = $urlTemp . $the_data;
          ?>

          <img id="myImg" onclick="showImage(this)" class="col-1" src="<?php echo $img . "\""  ?>">
          <div class="group">
            <label id="myImg" class="col-1">
              <p></p>
              <!-- the tag names -->
              <?php foreach ($img_tags as $s) {
                echo ('<p class="col">' . $s['tag_name'] . '</p>');
              }
              ?>

            </label>
          </div>
          <!-- </td> -->
        </div>

      <?php } else { //now for user uploaded images
      ?>
        <div>
          <td>
            <?php
            // to make it easier
            $path = "uploads/";
            $img = $path . $record["id"] . "." . $record["file_ext"];
            $alt = $record["id"];

            //delete image
            if (isset($_POST['submit'])) {
              $photo = $_POST['photo'];
              $path = "uploads/" . $photo;
              if (!unlink($path)) {
                echo ("Error deleting $path");
              } else {
                echo ("Deleted $path");
              }
            }
            ?>

            <?php
            // only show file contents and tags if image exists
            if (file_exists($img)) { ?>
              <img id="myImg" onclick="showImage(this)" class="col-1" src="<?php echo $img . "\""  ?>" alt="<?php echo $alt ?>" name="<?php echo $alt ?>">

              <label id="myImg" class="col-1">
                <p></p>
                <!-- <div class="col"> -->
                <?php foreach ($img_tags as $s) {
                  echo ('<p class="col">' . $s['tag_name'] . '</p>');
                }
                ?>
                <form method="post">
                  <input type="text" name="photoname"> type image name
                  <input type="submit" name="submit" value="Delete">
                </form>
                <!-- </div> -->

              </label>
            <?php
            }
            ?>
          </td>
        </div>
    <?php }
    } ?>
  </div>
  <?php
  function print_results()
  {
    global $db, $do_search, $search_field;
    //$search
    if ($do_search) {
  ?>

    <?php
      $gs = "SELECT * from tags";
      foreach ($gs as $a) {
        echo ('<p>' . $a['tag_name'] . '</p>');
      }
      if ($search_field == "everything") {

        $sql = "SELECT * FROM images";
      } elseif ($search_field == "tagged") {
        // implode array and join each element with " OR "
        $sql = "SELECT * FROM images INNER JOIN maptags ON maptags.img_id=images.id";
      } elseif ($search_field != "tagged" && ($search_field != "everything")) {
        $sql = "SELECT * from images INNER JOIN maptags ON images.id = maptags.img_id WHERE tag_id = '$search_field'";
      }
    }
    if (!$do_search) {
      $sql = "SELECT * FROM images";
    }
    $result = exec_sql_query($db, $sql);
    if ($result) {
      // The query was successful, let's get the records.
      $count = 0;
      $records = $result->fetchAll();
      if (count($records) > 0) {
        // We have records to display
        $count++;
        foreach ($records as $rs) {
          gallery_element($rs);
        }
      }
      if ($count == 2) {
        echo '<tr></tr>';
      }
    } ?>
  <?php
  }
  // Search Form
  $SEARCH_FIELDS = [
    "everything" => "everything",
    "tagged" => "tagged",
    "1" => "glints",
    "2" => "nature",
    "3" => "portrait",
    "4" => "hazy",
    "5" => "cellophane",
  ];
  $countoftags = "SELECT * FROM tags";

  // if (count((count($SEARCH_FIELDS) - 2)) == count($countoftags)) {

  //   $newtag = "SELECT * FROM tags WHERE tags.tag_id = count($countoftags)";
  //   // echo $newtag['tag_name'];
  //   array_push($SEARCH_FIELDS, (string) $newtag['tag_name']);
  //}

  if (isset($_GET['search'])) {
    $do_search = TRUE;
    $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);



  ?><h2 class="search-res">RESULTS FOR: <?php echo (strtoupper($SEARCH_FIELDS[$category])); ?></h2><?php
                                                                                                    if (in_array($category, array_keys($SEARCH_FIELDS))) {
                                                                                                      $search_field = $category;
                                                                                                      // var_dump($search_field);
                                                                                                    } else {
                                                                                                      array_push($messages, "Invalid category for search.");
                                                                                                      $do_search = FALSE;
                                                                                                    }

                                                                                                    // Get the search terms
                                                                                                    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
                                                                                                    $search = trim($search);

                                                                                                    // Check if this is an api call to return just the results
                                                                                                    if (isset($_GET['async_results'])) {
                                                                                                      // Just sent the results and nothing else (not the whole HTML document)
                                                                                                      print_results();
                                                                                                      // stop. We don't want to process the whole page.
                                                                                                      exit();
                                                                                                    }
                                                                                                  } else {
                                                                                                    // No search provided, so set the product to query to NULL
                                                                                                    $do_search = FALSE;
                                                                                                    $category = NULL;
                                                                                                    $search = NULL;
                                                                                                  }

                                                                                                  echo isset($_GET['src']);
                                                                                                  // Insert Form
                                                                                                  $messages = array();
                                                                                                  // Set maximum file size for uploaded files.
                                                                                                  // MAX_FILE_SIZE must be set to bytes
                                                                                                  // 1 MB = 1000000 bytes
                                                                                                  const MAX_FILE_SIZE = 1000000;
                                                                                                  // Users must be logged in to upload files!
                                                                                                  if (isset($_POST["submit_upload"])) {
                                                                                                    // get the info about the uploaded files.
                                                                                                    $upload_info = $_FILES["box_file"];
                                                                                                    $tag_info = filter_input(INPUT_GET, 'box_tag', FILTER_SANITIZE_STRING);

                                                                                                    $upload_desc = trim($_POST['description']);
                                                                                                    $upload_tag = trim($tag_info);
                                                                                                    if ($upload_info['error'] == UPLOAD_ERR_OK) {
                                                                                                      // The upload was successful!
                                                                                                      // Get the name of the uploaded file without any path
                                                                                                      $upload_name = basename($upload_info["name"]);
                                                                                                      // Get the file extension of the uploaded file
                                                                                                      $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION));

                                                                                                      $sql = "INSERT INTO images (file_name, file_ext, description) VALUES (:filename, :extension, :description)";
                                                                                                      $params = array(
                                                                                                        ':filename' => $upload_name,
                                                                                                        ':extension' => $upload_ext,
                                                                                                        ':description' => $upload_desc,
                                                                                                      );
                                                                                                      $result = exec_sql_query($db, $sql, $params);
                                                                                                      if ($result) {
                                                                                                        // We successfully inserted the record into the database, now we need to
                                                                                                        // move the uploaded file to it's final resting place: uploads directory
                                                                                                        $file_id = $db->lastInsertId("id");
                                                                                                        $id_filename = 'uploads/' . $file_id . '.' . $upload_ext;
                                                                                                        if (move_uploaded_file($upload_info["tmp_name"], $id_filename)) {
                                                                                                          // Successfully moved the tmp uploaded file to the uploads directory.
                                                                                                        } else {
                                                                                                          array_push($messages, "Failed to upload file. TODO");
                                                                                                        }
                                                                                                      } else {
                                                                                                        array_push($messages, "Failed to upload file. TODO");
                                                                                                      }
                                                                                                    } else {
                                                                                                      // Upload failed.
                                                                                                      array_push($messages, "Failed to upload file. TODO");
                                                                                                    }
                                                                                                  }
                                                                                                    ?>
  <?php
  //gets value of src
  if (isset($_GET["src"])) {


    echo "<div id='myModal' class='modal'><span class='close'>&times;</span><img class='modal-content' id='img01'></div>;
    ";
  ?>
    <?php
    // to add a new tag
    $actual_link = "$_SERVER[REQUEST_URI]";
    $length = strlen($actual_link);
    $index = $length - 1;

    $img_id = intval(substr($actual_link, $index));
    if (isset($_POST["addtag"])) {


      $upload_tag = trim($tag_name);
      $tag_name = filter_input(
        INPUT_POST,
        'tagstuff',
        FILTER_SANITIZE_STRING
      );

      //insert new tag into tags

      // $db->beginTransaction();
      $sql = "INSERT INTO tags (tag_name) VALUES (:tag_name)";
      $params = array(
        ':tag_name' => $tag_name,
      );
      // get result
      $result = exec_sql_query($db, $sql, $params);
    }
    // then insert into maptags
    $tag_id = $db->lastInsertId("id");
    $sql_insert = "INSERT INTO maptags (tag_id, img_id) VALUES (:tag_id, :img_id)";
    $params_insert = array(

      ':tag_id' => $tag_id,
      ':img_id' => 4,
    );
    $result = exec_sql_query($db, $sql_insert, $params_insert);
    ?>
    <!--the modal-->
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01">

    </div><?php
        }
          ?>

  <p><?php echo $result_insert ?><p>

      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
      </div>
      <form id="uploadFile" class="upload" action="index.php" method="post" enctype="multipart/form-data">
        <!-- MAX_FILE_SIZE must precede the file input field -->
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
        <div class="group_label_input">
          <label for="box_file">Upload File:</label>
          <input id="box_file" type="file" name="box_file">
        </div>
        <div class="group_label_input">
          <label for="box_desc">Description:</label>
          <textarea id="box_desc" name="description" cols="40" rows="5"></textarea>

        </div>
        <div class="group_label_input">
          <span></span>
          <button name="submit_upload" type="submit">Upload File</button>
        </div>
      </form>
      <!-- search form -->
      <form id="searchForm" action="index.php" method="get" novalidate>
        <div class="r">
          <div class="c">
            <div class="c-1">
              <p class="selecting">
                <select id="category" name="category">

                  <?php foreach ($SEARCH_FIELDS as $field_name => $label) { ?>
                    <option value="<?php echo $field_name; ?>">
                      <?php echo $label; ?></option>
                  <?php } ?>
                </select>
              </p>
            </div>
          </div>
          <div class="c">
            <div class="c-2">
              <button name="search" class="go" type="submit">
                <p class="search"><img src="search.svg" class="search"></p>
              </button>
            </div>
          </div>
        </div>
      </form>
      </div>
      <form id="galForm">
        <!-- <div class="group-2"> -->

        <ul>
          <?php
          $records = exec_sql_query($db, "SELECT * FROM images")->fetchAll(PDO::FETCH_ASSOC);
          ?>

        </ul>

        <div id="searchResults">
          <?php print_results(); ?>
        </div>
        <!-- </div> -->
      </form>

</body>

</html>
<script>
  // Get the modal
  var modal = document.getElementById('myModal');
  var img = document.getElementById('myImg');
  var p = document.getElementById('myImg');
  var modalImg = document.getElementById("img01");
  var submit = document.getElementsByClassName('submit');
  // When the user clicks on <span> (x), close the modal
  function showImage(imgElement) {
    var src = imgElement.getAttribute("src");
    var id = imgElement.getAttribute("alt");
    modal.style.display = "block";
    modalImg.src = src;
    modalImg.id = id;
  }

  var x = document.getElementById("uploadFile");
  x.style.display = "none";

  function inputTag() {

    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";

  }
</script>
