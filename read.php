<?php
/**************************************** *
 * read info from db & display posts
**************************************** */

  // koppla till databas
  require_once 'db.php';
  // förbered SQL-förfrågning
  $stmt = $db->prepare("SELECT * FROM blog ORDER BY date DESC");
  // verkställ
  $stmt->execute();
  // starta div för inlägg
  echo "<div class='container'>";

  // loopar över arrayen som har resultatet från db
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
      // spara data från db i varsin variabel
      $id = htmlspecialchars($row['id']); // $row = array
      $heading = htmlspecialchars($row['heading']);
      $image = htmlspecialchars($row['image']);
      $content = htmlspecialchars($row['content']);
      $date = htmlspecialchars($row['date']);
      $map = $row['map'];
      $video = ($row['video']);

      // replace line break ad p-tag
      $content_replace_br =  str_replace("\n","<p/><p>",$content);      

      if(!empty($video)){
        $videotext = "<iframe width='560' height='315'  src='https://www.youtube.com/embed/$video' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
      } else {
        $videotext = '';
      }
      if(!empty($map)){
        $maptext = $map;
      } else {
        $maptext = '';
      }
      
      $publish = htmlspecialchars($row['publish']);

      if( $publish == 'publish' ){
          // skriv ut content
          // OBS! ÄNDRA KARTAN TILL DE SOM HAR DET INLAGT
        echo "<br>
        <div class='card'>
          <div class='card-body'>
            <h2>$heading</h2>
            <img src='images/$image' class='img-fluid' alt='$image'>
            $videotext
            <p>$content_replace_br</p>
            <p>$maptext</p>
            <p>$date</p>
          </div>
        </div>
        <br>
        "; 
      }


  // avsluta while loop
  endwhile;
// stäng post div
  echo "</div>";
