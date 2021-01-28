<?php 
require_once('config.php'); 
Session::checkLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Admin  - Login</title>

  <!-- Custom fonts for this template-->
  <link href="admin-assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin-assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">             
              <div class="col-lg-6 offset-lg-3">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                  </div>
                  <?php
                 if (isset($_POST['submit']) && $_POST['submit'] == 'Login' ) {
                    $username=$_POST['username'];
                    $password=$_POST['password'];
                    //validate for hacker
                    $fm=new Format;
                    $username=$fm->validatehack($username);
                    $password=$fm->validatehack($password);

                    $data=[
                      [
                        'field_name' =>  'username',
                        'required'   => true,
                      ],
                      [
                        'field_name' =>  'password',
                        'required'   => true,
                      ],
                    ];
                    
                    if (Validation::validate($data)=== false) {
                      $login    = new Login;
                      $login->checkLogin(['*'], 'users', ['username', '=', $username, 'password', '=', hash('sha512', $password)]);
                      $query  =  $login->query;
                      $num_rows=$query->num_rows;

                      if ($num_rows==true) {                     
                          $row = $query->fetch_assoc();
                          $status=$row['status'];
                          $log_admin_id=$row['user_id'];
                          if ($status == 0) {
                            echo "<div class='alert alert-danger'>";
                            echo 'Your account is block, Please contact administrator';
                            echo '</div>';
                          }
                          else{
                            Session::set("adminlogin", true);
                            Session::set("adminName",  $row['full_name']);
                            Session::set("adminId",    $row['user_id']);
                            Session::set("adminUser",  $row['username']);
                            Session::set("adminEmail", $row['email']);

                              // $_SESSION['loged_admin']    =  $username;
                              // $_SESSION['loged_admin_id'] =  $log_admin_id;

                              unset($_SESSION['no_of_attempted']);
                              header("Location:dashboard.php");
                            exit();
                            echo "</div>";
                          }

                      }
                      else{
                           if (isset($_SESSION['no_of_attempted']) && $_SESSION['no_of_attempted'] >=3){
                              echo "<div class='alert alert-danger'>";
                              echo "You Enter over 3 wrong username and password.Plz wait 2 minite or recovery password";
                              echo "</div>";
                              exit();
                        }
                       echo "<div class='alert alert-danger'>";
                       echo "Both USERNAME AND PASSWORD IS WRONG";
                       echo "</div>";

                          if (isset($_SESSION['no_of_attempted'])) {
                             $_SESSION['no_of_attempted']++;
                            
                          }
                          else
                          {
                           $_SESSION['no_of_attempted'] =  1;  
                          }                      
                    }
                  }
                 }//if
                   
                   ?>
                  <form class="user" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                      <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-user"  placeholder="Enter Username">
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user"  >
                      </div>
                      <div class="form-group">            
                            <input type="submit" name="submit" value="Login" class="btn btn-primary btn-user btn-block">                        
                      </div>                        
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.php">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin-assets/vendor/jquery/jquery.min.js"></script>
  <script src="admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin-assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin-assets/js/sb-admin-2.min.js"></script>

</body>

</html>
