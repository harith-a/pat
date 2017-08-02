<?php
include('db.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//query nama setiap negeri
$sql2 = "SELECT DISTINCT `NEGERI` FROM `pti_ahli` ORDER BY NEGERI ASC;";

if(!$result = $conn->query($sql2)){
	    die('There was an error running the query [' . $db->error . ']');
	}

while ($obj = $result->fetch_object()) {
        $negeri[] = $obj->NEGERI;
    }


//query jumlah berdaftar setiap negeri
foreach ($negeri as &$value) {

	$sql = "SELECT * FROM `pti_ahli` WHERE `NEGERI`='" . $value . "' AND `Registered`=1";

	if(!$result2 = $conn->query($sql)){
	    die('There was an error running the query [' . $db->error . ']');
	}

	$JumlahNegeri[] = ($result2->num_rows);
}

$jantina = array("LELAKI","PEREMPUAN");

foreach ($jantina as &$value) {

	$sql3 = "SELECT * FROM `pti_ahli` WHERE `JANTINA`='" . $value . "' AND `Registered`=1";

	if(!$result3 = $conn->query($sql3)){
	    die('There was an error running the query [' . $db->error . ']');
	}

	$JumlahJantina[] = ($result3->num_rows);
}

//4th query

$r10 = 0;
$r20 = 0;
$r30 = 0;
$r40 = 0;
$r50 = 0;
$r60 = 0;
$r70 = 0;

$sql4 = "SELECT `NO_KP` FROM `pti_ahli` WHERE `Registered`=1";

	if(!$result4 = $conn->query($sql4)){
	    die('There was an error running the query [' . $db->error . ']');
	}

while($row4 = mysqli_fetch_array($result4)) {
		$umur = substr($row4[0], 0, 2);
		if ($umur > 16){
			$umur = 116-$umur;
			}
		else {
			$umur = 16-$umur;
		 }
		switch ($umur) {
			
			case $umur>70:
				$r70++;
				break;
			
			case $umur>=60:
				$r60++;
				break;

			case $umur>=50:
				$r50++;
				break;
			
			case $umur>=40:
				$r40++;
				break;

			case $umur>=30:
				$r30++;
				break;

			case $umur>=20:
				$r20++;
				break;

			case $umur<20:
				$r10++;
				break;

			
		}
      }
$JumlahUmur = array($r10,$r20,$r30,$r40,$r50,$r60,$r70);


//compile all data into single variable
$multi = array('Negeri' => $negeri , 'JumlahNegeri' => $JumlahNegeri , 'JumlahJantina' => $JumlahJantina, 'JumlahUmur' => $JumlahUmur);



//send data as json
echo json_encode($multi);

$conn->close();
?>
