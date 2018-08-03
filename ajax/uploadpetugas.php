<?php
ini_set('auto_detect_line_endings', true);

            function loadCSV($file)
            {
                // Create an array to hold the data
                $arrData = array();
                
                // Create a variable to hold the header information
                $header = NULL;
                $start = NULL;
                $end = NULL;
                
                
                // If the file can be opened as readable, bind a named resource
                if (($handle = fopen($file, 'r')) !== FALSE)
                {
                    // Loop through each row
                    while (($row = fgetcsv($handle)) !== FALSE)
                    {
                        // Loop through each field
                        foreach($row as &$field)
                        {
                            // Remove any invalid or hidden characters
                            $field = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $field);
                            
                            // Escape characters for MySQL (single quotes, double quotes, linefeeds, etc.)
                            //$field = mysqli_escape_string($db, $field);
                        }
                        
                        // If the header has been stored
                        if ($header)
                        {
                            // Create an associative array with the data
                            // check the row value to detect end of table with != NULL 
                            if($row[2] != NULL)
                            {
                               $arrData[] = array_combine($header, array_slice($row,$start,$end));
                            }
                        }
                        // Else the header has not been stored
                        else
                        {
                    // Store the current row as the header, check where is 1st column using array_search
                            $start = array_search("NO", $row);
                            $end = array_search("NO. KP", $row)+1;
                            
                            if(is_numeric($start)){
                                //remove empty column with slice
                                $header = array_slice($row,$start,$end);
                                print_r($header);
                            }
                            
                        }
                    }
                    // Close the file pointer
                    fclose($handle);
                }
            
                return $arrData;
            }

            //insert array into DB
            function toDB($array){
            include('db.php');
            // Connect to the database
            $db = mysqli_connect($servername,$username,$password,$dbname) or die("Failed to connect to MySQL: " . mysqli_connect_error());

            foreach ($array as $row){

                $r1 = $row['NO']; 
                $r2 = mysqli_real_escape_string($db,$row['NAMA']);  
                $r3 = $row['NO. KP'];
                                    
                $sql = "INSERT INTO pti_petugas (`NO`, `NAMA`, `NO_KP`) 
                VALUES ('$r1','$r2','$r3')
                ON DUPLICATE KEY UPDATE
                NO='$r1',
                NAMA='$r2',
                NO_KP='$r3'";
                
                if(!$db->query($sql)){
                    echo "Error: %s\n".$db->error."<br>";
                }
            }


            // Close the MySQL connection
                $db->close();
            }



//turn on php error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    $name     = $_FILES['file']['name'];
    $tmpName  = $_FILES['file']['tmp_name'];
    $error    = $_FILES['file']['error'];
    $size     = $_FILES['file']['size'];
    $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    
    switch ($error) {
        case UPLOAD_ERR_OK:
            $valid = true;
            //validate file extensions
            if ( !in_array($ext, array('csv')) ) {
                $valid = false;
                $response = 'Invalid file extension.';
            }
            //validate file size
            if ( $size/1024/1024 > 2 ) {
                $valid = false;
                $response = 'File size is exceeding maximum allowed size.';
            }
            //upload file
            if ($valid) {
                
                $data = loadCSV($tmpName);
                toDB($data);
                $response = 'Database update successful';    
            }
            break;
        case UPLOAD_ERR_INI_SIZE:
            $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $response = 'The uploaded file was only partially uploaded.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $response = 'No file was uploaded.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
            break;
        case UPLOAD_ERR_EXTENSION:
            $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
            break;
        default:
            $response = 'Unknown error';
        break;
    }

    echo $response;
}
?>