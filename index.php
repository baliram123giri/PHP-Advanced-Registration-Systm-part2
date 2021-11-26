<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
    <?php
        // echo "Good Morning";
        // echo md5("bali"); // MD5 Hashing Algorithm 32
        // echo"<br>";
        // echo sha1("bali"); // SHA1 Hashing Algorithm 40
        // echo"<br>";
        // echo hash('sha512', 'bali'); // SHA512 Hashing Algorithm 128
        if(isset($_GET['rgistration'])){
             // make db connection
             $conn = mysqli_connect('localhost', 'root', '', 'ecom_db');
              
               // Always Filter Santize the incomming data
             $fname = mysqli_real_escape_string($conn, $_GET['fname']);
             $lname = mysqli_real_escape_string($conn, $_GET['lname']);
             $uname = mysqli_real_escape_string($conn, $_GET['uname']);
             $pass = mysqli_real_escape_string($conn, $_GET['pass']);
             $cpass = mysqli_real_escape_string($conn, $_GET['cpass']);
             $email = mysqli_real_escape_string($conn, $_GET['email']);
             $mobileno = mysqli_real_escape_string($conn, $_GET['mobileno']);

             //2.build the query
              if($pass == $cpass){
              
                //4.display the result
              
               $uniqe = "SELECT * FROM users_tbl WHERE username ='$uname' OR email = '$email' ";

               // create the query
               $result =  mysqli_query($conn, $uniqe);
               $count = mysqli_num_rows($result);
              
               if($count > 0){
                echo"<script> swal('Username or email already exits!', '', 'error'); </script>";
               }else{
                   $pass = hash('sha512',`$pass`);
                   $query = "INSERT INTO users_tbl (`fname`,`lname`,`email`, `password`, `username`, `mobileno`) VALUES ('$fname','$lname', '$email', '$pass', '$uname', '$mobileno') ";
                    //3.excute the query
                  mysqli_query($conn, $query);
                
                  header('Location:'. 'index.php?msg=1');
          
               }

              }else{
                echo"<script> swal('Password not match!', 'please enter the same password', 'error'); </script>";
              }
             //5.db connection close
             mysqli_close($conn);
        }
        /*else{
            echo"no";
        }*/
     ?>
     <?php 
         if((isset($_GET['msg'])) && ($_GET['msg']==1)){
            echo"<script> swal('Good job!', 'Registered SuccessFully..', 'success'); </script>";
         }
     ?>
    <form class="w-50 offset-3 mt-5" action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
    <h1>Registration Form</h1>
  <div class="mb-3">
    <label for="fname" class="form-label">First Name</label>
    <input required name="fname" type="text" class="form-control" id="fname" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="lname" class="form-label">Last Name</label>
    <input required name="lname" type="text" class="form-control" id="lname" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input required name="uname" type="text" class="form-control" id="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input required name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="mobileno" class="form-label">Mobile Number</label>
    <input required name="mobileno" type="number" class="form-control" id="mobileno" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input required name='pass' type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
    <input required name="cpass" type="password" class="form-control" id="exampleInputPassword2">
  </div>
  <div class="mb-3 form-check">
    <input required name="agree" value="yes" type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Terms and Conditions</label>
  </div>
  <button type="submit" name="rgistration" class="btn btn-primary">Submit</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>