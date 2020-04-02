<?php
/**************************************** *
 * filename: edit.php
 * author: Stina Englesson & Jing-Jing Lin
 * date 2020-03-27
 * 
 * update post info db
**************************************** */
  require_once '../db.php';
  require_once '../header-admin.php';

  $id = htmlentities($_GET['id']);

  // hämtar info fron blog-tabell, alla kolumner på en specifik rad
  $sql = 'SELECT * FROM blog WHERE id = :id';

  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $heading = htmlspecialchars($row['heading']);
  $content = htmlentities($row['content']);
  $map = ($row['map']);
  $video = ($row['video']);
  $image = htmlspecialchars($row['image']);

  // kollar om det redan finns en bild inlaggd, visar bild
if(empty($image)){
    // skriv ut rubrik
    echo "<h1>Uppdatera blogginlägg</h1>";
    $addImage = '
    <div class="col-md-12 form-group">
    <label for="image">Välj bild</label>
        <input  type="file" 
                name="image" 
                id="fileToUpload" 
                class="form-control"> 
    </div>';
} else {
    // skriv ut rubrik och visa bild med knappar
    echo "<h1>Uppdatera blogginlägg</h1>
    <img src='../images/$image' alt='' width='200px'><br>";
    $addImage = '';
    $updateImage = '<p><a href="update-image.php?id='.$id.'" class="btn btn-sm btn-warning">Byt bild</a>';
    $deleteImage = '<p><a href="update-image.php?id='.$id.'" class="btn btn-sm btn-danger">Radera bild</a>';
    echo $updateImage;
    echo $deleteImage;
}

?>
<form   action="update.php?id=<?php echo $id;?>"       
        enctype="multipart/form-data"  
        accept-charset="UTF-800"
        method="post" 
        class="row">

    <div class="col-md-12 form-group">
        <input  name="heading"
                type="text" 
                required
                class="form-control" 
                placeholder="Rubrik" 
                value="<?php echo $heading ?>">
    </div>   
      
    <div class="col-md-12 form-group">
        <textarea   name="content" 
                    cols="30" 
                    rows="5" 
                    required
                    class="form-control" 
                    placeholder="Skriv ett inlägg" 
                    value=""><?php echo $content ?></textarea>
    </div>

    <div class="col-md-12 form-group">
        <input  name="map" 
                type="text" 
                class="form-control" 
                placeholder="Bädda in karta"
                value='<?php echo $map ?>'>
    </div>   
        
    <br>
    <div class="col-md-12 form-group">
        <input  name="video" 
                type="text" 
                class="form-control" 
                placeholder="Bädda in video" 
                value='<?php echo $video ?>'>
    </div>
    
    <?php echo $addImage; ?>

    <div class="col-md-12 form-group">
        <input  type="submit" 
                value="Uppdatera inlägg"
                class="btn btn-success form-control">
    </div>
</form>

<?php
    require_once '../footer.php';
?>