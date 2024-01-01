<?php
  session_start();

  if ( $_SESSION[ "email" ] == "" || $_SESSION[ "email" ] == NULL ) {
    header( 'Location:../login.php' );
  }

  $userid = $_SESSION[ "id" ];
  $userfname = $_SESSION[ "firstname" ];
  $userlname = $_SESSION[ "lastname" ];
  $useradrs = $_SESSION[ "address" ];
  $userphn = $_SESSION[ "phone" ];
  $userprm = $_SESSION[ "promotion" ];

  //include connection file
  include('../classes/connextion.php');
  include('../classes/inscription.php');
  //create in instance of class Connection
  $connection = new Connection();

  //call the selectDatabase method
  $connection->selectDatabase('emsipoo');


  if(isset($_POST["submit"])){
    $pincode = $_POST["pincode"];
    if($pincode===$userprm){
        $id = $_GET['id'];
        $inscription = new Inscription($userid,$id,date('Y-m-d H:i:s'));
        $inscription->insertInscription('inscription',$connection->conn);
        header( "Location:examen.php?id=$id" );
    }else{
      echo '<div style="text-align:center;margin-top:15%;"><h2><b>Wrong Promotion Code
      </b></h2><img src="images/wrong.png"></div>';
    }

  }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pincode Verification</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Student <?php echo "<span style='color:red'>".$userfname."</span>";?> Pincode Verification</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Pincode Verification
                        </div>
                        <div class="panel-body">
                        <form name="pincodeverify" method="post">
                          <div class="form-group">
                            <label for="pincode">Enter Pincode</label>
                            <input type="password" class="form-control" id="pincode" name="pincode" placeholder="Pincode" required />
                          </div>
 
                          <button type="submit" name="submit" class="btn btn-default">Verify</button>
                          <a class="btn btn-default" href="../Abc/index.php">Back</a>
                           <hr />
   
                        </form>
                            </div>
                            </div>
                    </div>
                  
                </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
