<?php
/**************************************** *
 * filename: upload.php
 * author: Stina Englesson & Jing-Jing Lin
 * date 2020-03-27
 * 
 * add post to db, show user new post
**************************************** */

  require_once '../header-admin.php';
  // Logga in i databasen
  require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'):
  
  // Lägg till htmlspecialchars för att rensa HTML
  $heading = htmlspecialchars($_POST['heading']);
  $image = htmlspecialchars(basename( $_FILES["image"]["name"]));
  $content = htmlspecialchars($_POST['content']);
  $map = ($_POST['map']);
  $video = ($_POST['video']);
  $publish = htmlspecialchars($_POST['publish']);
  if( $publish == 'publish' ){
    $publishtext = "Publicerad";
  } else {
    $publishtext = "Opublicerad";
  }

  // Förbered en SQL-sats
  $sql = "INSERT INTO blog (heading,content,image,map, video,publish) 
          VALUES ( :heading, :content,:image, :map, :video, :publish)";
  $stmt = $db->prepare($sql);

  // Binda variabler till params, som finns i VALUES
  $stmt->bindParam(':heading' , $heading);
  $stmt->bindParam(':content' , $content);
  $stmt->bindParam(':map' , $map);
  $stmt->bindParam(':video' , $video);
  $stmt->bindParam(':image' , $image);
  $stmt->bindParam(':publish' , $publish);

  // Skicka SQL till databasen
  $stmt->execute();

  // byt ut radbrytningar till p-taggar
  $content_replace_br =  str_replace("\n","<p/><p>",$content);

endif;

$target_dir = "../images/";

$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

echo "<br>
<div class='card'>
<div class='card-body'>
    <p class='text-muted'>$publishtext</p>
  <h2>$heading</h2>
  <img src='../images/$target_file' class='img-fluid' alt='$image'>
  <p>$content_replace_br</p>
  $map
  <p>$video</p>
</div>
</div>
<br>";

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "<img src='../images/$target_file' class='img-fluid' alt='$image'><br>";
        $uploadOk = 1;
    } else {
        echo "Det här är ingen bild.<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Den här bilden fanns redan.<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Tyvärr, filen är för stor.<br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Tyvärr, bara JPG, JPEG, PNG & GIF är tillåtna filformat.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Filen gick inte att ladda upp.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo " Bilden ". basename( $_FILES["image"]["name"]). " har laddats upp.<br>";
    } else {
        echo "Tyvärr, det blev något fel vid uppladdning av fil.<br>";
    }
}

?>
<br><br>
<a href="index.php">Till adminsidan</a>
<br><br>
<a href="../index.php">Till bloggen</a>

<?php
include_once '../footer.php';
?>