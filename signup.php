<?php
$user = false;
$succes = false;
$errorInput = false;
$successInput = false;
$checkpassword = false;

if($_SERVER['REQUEST_METHOD']=="POST"){
  require('connection.php');

  //hold the value of the input fields
  $username = $_POST['username'];
  $password = $_POST['password'];

  //check empty input fields
    if(empty($username) || empty($password)){
      $errorInput = true;
    }
    //check the length of the password 
    else if((int)$password == 4){
      $checkpassword = true;
    }
     //check if the user already created
    else{
     $sql = "select * from singupform where username='$username'";
     $result = $conn->query( $sql );
     if($result){
       $row = mysqli_num_rows($result);
       if($row > 0){
         $user = true;
       }
           //creating user or insertion user
         else{
           $sql = "insert into singupform(username , password) values('$username' , '$password')";
           $result = $conn->query($sql);
           if($result){
             $succes = true;
           }
           else{
             die("invalid insertion". $conn->error);
           }
         }
     }

    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sing-Up page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container m-3 d-flex justify-content-center align-items-center" style="height: 80vh;">
      <form action="signup.php" method="post">
      <div class="mb-3  shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="col p-2">
        <dv class="row g-3">
          <div class="colo">
            <h1 class="text-center">Sign Up!</h1>
          </div>      
          <?php
          if($user){
            echo'
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>User error!</strong> user already exist!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          }
          ?>
          <?php
          if($succes){
              echo'
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>Success: </strong> user creation successfully
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
          }
          ?>
              <div class="col">
                <label  class="form-label fs-20 fw-bold">Username</label>
                <input type="text" class="form-control w-100 shadow-sm p-2 mb-3 bg-body-tertiary rounded"
                    name="username" placeholder="Enter Username">
              </div>
              <div class="col">
                <label  class="form-label fs-20 fw-bold">Password</label>
                <input type="password" class="form-control w-100 shadow-sm p-2 mb-3 bg-body-tertiary rounded" 
                    name="password" placeholder="Enter Password">
              </div>
              </div>
              <?php
                  if($checkpassword){
                    echo'
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Check password! </strong> password number must be 4 digit!
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  }
               ?>

              <?php
                if($errorInput){
                    echo'
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Empty fields! </strong> All input fields are required!
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  }
              ?>
              <div class="row mx-auto">
                <div class="col">
                <button type="submit"  class="btn btn-primary w-100">Sign up</button>
                </div>
                <div class="col">
                <button type="reset" class="btn btn-danger w-100">Cancel</button>
                </div>
              </div>
          </div>
      </dv>
      </form>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>