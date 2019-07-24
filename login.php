<?php session_start(); ?>
<?php
#session_destroy();
?>
<?php
error_reporting('E_ALL');
if (isset($_SESSION['log_in'])) {
  header('Location: pages/');
  exit();
}


if (isset($_POST['btn_log'])) {
  $attemp_user = $_POST['user_email'];
  $attemp_psw = $_POST['user_psw'];

  //$attemp_user = ($_POST['user_email']) ? a : b ;

  include 'includes/config_db.php';
  //global $con;

  #$mysqli = $con;
  $status = "1";

  $stmt = $con->prepare("SELECT first_name, last_name, user_name, user_password, status FROM auth_tbl WHERE user_name = ? AND user_password = ? AND status = ?");
  $stmt->bind_param("sss", $attemp_user, $attemp_psw, $status);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows === 0) {
    $stmt->close();
    $msg = "<p style='color:#f40000;'>Invalid credentials</p>";
  }
  else{
    while($row = $result->fetch_assoc()) {
      $user = $row['first_name'] .', '. $row['last_name'];
    }
    $stmt->close();
    $_SESSION['log_in'] = $user;
    $_SESSION['start_logged_time'] = time();
    $_SESSION['exp_logged_time'] = $_SESSION['start_logged_time'] + (30 * 60);
    /*echo '<script type="text/javascript"> window.open("pages/","_self");</script>';*/
    header('Location: pages/');
    exit();
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Login</title>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
              <div class="form-label-group">
                <input type="email" class="form-control" placeholder="Email address" name="user_email" required autofocus>
                <label>Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" class="form-control" placeholder="Password" name="user_psw" required>
                <label>Password</label>
              </div>

              <!-- <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>-->
              <button class="btn btn-lg btn-primary btn-block text-uppercase" name="btn_log" type="submit">Sign in</button>
              <hr class="my-4">
              <div class="form-label-group">
                <?php if(isset($msg)){echo $msg; } else{ echo "Please place your credentials.";}?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>