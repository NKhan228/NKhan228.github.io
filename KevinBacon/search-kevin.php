<html>
<head>
    <title>All movies search</title>
    <link href="Baconcss.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <div id="banner">
                <h1><img alt="Banner" src="Bacon.PNG" style="width: -webkit-fill-available; height: 100px;"></h1>
        </div>
        
        
        
        
<?php  $firstName; $lastName;


  $connect="mysql:host=$server;dbname=$database;charset=utf8;port=$dbport";
  try {
    $db = new PDO($connect, $username, $password);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }


        
function getActorByName($db, $firstName, $lastName){ 
$firstName = $_GET['firstname'];
$lastName = $_GET['lastname'];
    
try { 
$stmt = $db->prepare("SELECT A.id, AA.id, A.first_name, AA.first_name, A.last_name, AA.last_name, R.movie_id, RR.movie_id, M.name, M.year
FROM actors as A
INNER JOIN roles as R 
on A.id = R.actor_id
INNER JOIN movies as M
on movie_id = M.id
INNER JOIN roles as RR on M.id = RR.movie_id
INNER JOIN actors as AA on RR.actor_id = AA.id where A.first_name='Kevin' and A.last_name='Bacon' 
and AA.first_name='$firstName' and AA.last_name='$lastName' limit 100");
$data=array(":firstName"=>$firstName, ":lastName"=>$lastName);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
return $rows;

}catch (Exception $e) {
return false;
    
} 
} 
    
if ($rows=getActorByName($db, $_GET['firstname'], $_GET['lastname'])){
$firstName = $_GET['firstname'];
$lastName = $_GET['lastname'];
echo "<table align:'center'>";
echo "<tr> <th>Movies $firstName $lastName has acted in with Kevin Bacon</th> </tr>";
    $s=1;
    foreach($rows as $row){
        if ($s==1){
echo "<table align:'center'>";
echo "<tr> <td class='left'>#</td> <td class='center'>Title</td> <td class='right'>Year</td> </tr>";
        }
$filmYear= $row['year'];
$filmname = $row['name'];
$ID = $s;
echo "<table align:'center'>";
echo "<tr><td class='left'>";
echo $ID;
echo "</td><td class='center'>";
echo $filmname;
echo "</td><td class='right'>";
echo $filmYear;
echo "</td></tr>";
        
echo "</table>";
         $s = $s+1;
    }
} else{
$firstName = $_GET['firstname'];
$lastName = $_GET['lastname'];
echo "Actor $firstName $lastName Not Found or has not acted with Kevin Bacon";
}
        
include "common.php";
        
 ?>
        
        
        
        <div id="w3c">
				<p><img alt="Certification" src="Bacon2.PNG" style="width: -webkit-fill-available; height: 80px;"></p>
        </div>
    </body>
</html>
