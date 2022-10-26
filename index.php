<?php 
    require_once('config.php');
    require_once('functions.php');
 
    if(isset($_POST['submit']))
    {
        if(isset($_POST['candidate']) && !empty($_POST['candidate']))
        {
            $candidateName = $_POST['candidate'];
            $clientIP = $_SERVER['REMOTE_ADDR'];
            $checkIfIpExist = ifIPIsExist($clientIP);
 
            if($checkIfIpExist == 1)
            {
                $errorMsg = 'You already cast your vote.';
            }
            else
            {
                $sql = 'insert into election (candidate_name,user_ip) values(:name,:ip)';
                $handle = $pdo->prepare($sql);
                
                $params = [
                    'name' => $candidateName,
                    'ip' =>$clientIP
                ];
 
                $handle->execute($params);
                
                if($handle->rowCount())
                {
                    $successMsg = 'Thank you! For your vote';
                }
                else
                {
                    $errorMsg = 'Unable to save your vote. Try again later';
                }
 
                
            }
        }
        else
        {
            $errorMsg = 'Please pick one election vot';
        }
        
    }
 
    $congressCount = getSingleCondidateData('Congress');
    $aamCount = getSingleCondidateData('AAM');
    $bjpCount = getSingleCondidateData('BJP');
    $rjdCount = getSingleCondidateData('RJD');
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Online Voting </title>
  </head>
  <body >
  <div class="container mt-1 p-3 text-center">
    <h1>Online Voting Election </h1>
  </div>
    <div class="container mt-1 p-3 border">
    
    <h2>Vote for Best Condidte:</h2>
        <?php 
            if(isset($errorMsg))
            {
                echo '<div class="alert alert-danger">'.$errorMsg.'</div>';
            }
 
            if(isset($successMsg))
            {
                echo '<div class="alert alert-success">'.$successMsg.'</div>';
            }
        ?>
        <form class="" method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <div class="row ">
                <div class="col-md-6 ">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="election1" name="condidate" value="Congress">
                        <label class="custom-control-label" for="election1">Congress</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="election2" name="condidate" value="AAM">
                        <label class="custom-control-label" for="election2">Aam Admi Party</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="election3" name="condidate" value="BJP">
                            <label class="custom-control-label" for="election3">Bharatiya Janata Party</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="election4" name="condidate" value="RJD">
                            <label class="custom-control-label" for="election4">RASHTRIYA JANATA DAL </label>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pt-2">
                    <button type="submit" name="submit" class="btn btn-danger">Vote</button>
                </div>
            </div>   
        </form>
 
    </div>
    <div class="container mt-3 border p-3">
    <h2>Result: Vote for Best condidate</h2>
        <div class="row">
            <div class="col-md-2">Congress</div>
            <div class="col-md-6">
                <div class="progress mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:<?php echo $congressCount?>"><?php echo $congressCount?></div>
                </div>
            </div>
         </div>   
         <div class="row">
            <div class="col-md-2">Aam Aadmi Party</div>
            <div class="col-md-6">
            <div class="progress mb-2">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:<?php echo $aamCount?>"><?php echo $aamCount?></div>
            </div>
            </div>
         </div>   
         <div class="row">
            <div class="col-md-2">Bharatiya Janata Party</div>
            <div class="col-md-6">
                <div class="progress mb-2">
                    <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width:<?php echo $bjpCount?>"><?php echo $bjpCount?></div>
                </div>
            </div>
         </div>   
         <div class="row">
         <div class="col-md-2">RASHTRIYA JANATA DAL</div>
            <div class="col-md-6">
                <div class="progress mb-2">
                    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:<?php echo $rjdCount?>"><?php echo $rjdCount?></div>
                </div>
            </div>
         </div>   
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 
   
  </body>
</html>