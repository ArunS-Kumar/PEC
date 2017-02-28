<?php
session_start();
require_once('../connection.php');
$_SESSION['error'] = '';

if(!empty($_REQUEST['id']))
{
  $result = $DB->query("SELECT * FROM users where id='".$_REQUEST['id']."'")->fetch_assoc();
}

if(!empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['password']) && $_SESSION["access"] == 1) 
{ 
    $active = 0;
    if(!empty($_REQUEST['active'])) {
        $active = 1;
    } 

    if(!empty($_REQUEST['id']))
    {
        $DB->query("UPDATE users SET name='".$_REQUEST['name']."', email='".$_REQUEST['email']."', password='".sha1($_REQUEST['password'])."', access='".$_REQUEST['access']."', activate='".$_REQUEST['activate']."' WHERE id='".$_REQUEST['id']."'");
    } else {
        $DB->query("INSERT INTO users (name, email, password, access, activate ) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['email']."','".sha1($_REQUEST['password'])."','".$_REQUEST['access']."','".$active."')");
    }
    header('Location: dashboard.php');  

} else if(!empty($_REQUEST['submit']))
{
    $_SESSION['error'] = 'Please enter correct Values';
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PEC | Admin User Form</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="dashboard.php" class="navbar-brand"><b>PEC </b>Docs Manager</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       <!--  <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          
        </div> -->
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
       
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="../logout.php" class="" >
                <!-- The user image in the navbar-->
                <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">Sign out</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
               <!--  <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                </li> -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Home</a>
                  </div>
                  <div class="pull-right">
                    <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          User Form
        </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol> -->
      </section>
      <?php  if(isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
      <div class="callout callout-danger" style=" padding: 6px 29px 6px 15px; text-align: center;">
          <p><?php echo $_SESSION['error']; ?> </p>
        </div>
    <?php } ?>
      <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="form.php" method="post" autocomplete="off">
              <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" required="true" value="<?php if(!empty($result['name'])) echo $result['name']; ?>" >
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required="true" value="<?php if(!empty($result['name'])) echo $result['email']; ?>" >
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required="true" value="" >
                </div>
                <input type="hidden" name="id" value="<?php if(!empty($_REQUEST['id'])) echo $_REQUEST['id']; ?>">
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="access" id="optionsRadios1" value="2" <?php if(!empty($result['access']) && $result['access'] == 2) echo 'checked=""'; ?> >
                      Staff
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="access" id="optionsRadios2" value="3" <?php if( !empty($result['access']) && $result['access'] == 3) echo 'checked=""'; ?> >
                      Student
                    </label>
                  </div>
                  
                </div>


                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="active" value="1" <?php if(!empty($result['activate']) &&  $result['activate'] == 1) echo 'checked=""'; ?>> Active
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
                <a href="dashboard.php">
                <button type="button" class="btn btn-default" name="submit" >Back</button> </a>
              </div>
              
            </form>
          </div>
          <!-- /.box -->

         

        </div>
        <!--/.col (left) -->
        
        
        
      </div>
      <!-- /.row -->
    </section>





       </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.2
      </div>
      <strong>Copyright &copy; 2017 <a href="www.panimalar.ac.in">Panimalar Engineering College</a>.</strong> All rights reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false
    // });
  });
</script>
</body>
</html>
