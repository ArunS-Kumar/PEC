<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PEC | Staff Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/iCheck/square/blue.css">
  <!-- jQuery 2.2.0 -->
<script src="../assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="../assets/bootstrap/js/jquery.validate.js"></script>
<style type="text/css">
    em.error {
    color: red;
    font-size: 12px;
}
</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>PCE </b>Docs Manager</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Staff Sign in</p>
     <?php session_start(); if(isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
      <div class="callout callout-danger" style=" padding: 6px 29px 6px 15px; text-align: center;">
          <p><?php echo $_SESSION['error']; ?> </p>
        </div>
    <?php } ?>
    <form action="javascript:;" method="post" id="loginform">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <input type="hidden" name="access" value="2">
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
           <!--  <label>
              <input type="checkbox"> Remember Me
            </label> -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../assets/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
    jQuery(function() { 

    $("#loginform").validate({ 
        rules: { 
            password: {
                required: true,
                minlength:6,
                maxlength:55
            },

            email: {
                required: true,
                email: true,
                maxlength:55
            }
        },
        messages: {
            password: {
                required: "The Password is required.",
                minlength:"The Password at least 6 characters.",
                maxlength:"The Password can not exceed 55 characters in length."
            },

            email: {
                required: "The Email is required.",
                maxlength:"The Email can not exceed 55 characters in length.",
                email: "The Email must contain a valid email address."
            }
        },
        onfocusout: false,
        onkeyup: false,
        errorElement: "em"
    });

    });
            
</script>
</body>
</html>
