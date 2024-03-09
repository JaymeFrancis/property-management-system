<?php
$conn = mysqli_connect("localhost", "root", "", "db_pms");
if (! empty($_FILES)) {
    // Validating SQL file type by extensions
    if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {
        $response = array(
            "type" => "error",
            "message" => "Invalid File Type"
        );
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
            move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
            $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
        }
    }
}

function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';
    $mysqli = new mysqli("localhost", "root", "", "db_pms");


    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        //code to delete all tables of the database
        $mysqli->query('SET foreign_key_checks = 0');
        if ($result = $mysqli->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
       
    }
}

$mysqli->query('SET foreign_key_checks = 1');
//end
        foreach ($lines as $line) {
            

            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach
    
        if ($error) {
            $response = array(
                "type" => "error",
                "message" => $error
            );
        } else {
            $response = array(
                "type" => "success",
                "message" => "Database Restore Completed Successfully."
            );
        }
        exec('rm ' . $filePath);
    } // end if file exists
    
    return $response;
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include '../../../head.php'; ?>
<body>

<?php
session_start(); 
require '../../../config.php'; 
?>

<div class="wrapper">
<?php include '../../pmo-nav.php'; ?>
    <div class="main_content">
    <?php include '../../../navbar.php'; ?>  

        <div class="info">

            <div class="page-title">
                <div class="row" style="display: flex;">
                    <div class="col-6 md-6 order-md-1 order-first">
                        <h2>Back-up Database</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-primary">Utilities</li>
                                <li class="breadcrumb-item active" aria-current="page">Restore</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
           

            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Restore Database</h4>
                  </div>
                  <div class="card-body ">
                    <?php
                    if (! empty($response)) {
                        ?>
                    <div class="response <?php echo $response["type"]; ?>">
                    <?php echo nl2br($response["message"]); ?>
                    </div>
                    <?php
                    }
                    ?>
                    <form method="post" action="" enctype="multipart/form-data" id="frm-restore">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="backup_file" class="input-file" style="border-style:solid; border-radius:5px; border-color: #2a75d8">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 0;">
                            <div class="col-md-12" style="margin-bottom: 0;">
                                <button type="submit" name="restore" value="Restore" class="btn float-end" style="background-color:#2a75d8; color: white;">Initiate Restore</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>


  
  </body>
</html>