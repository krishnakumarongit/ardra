<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('site_name'); ?> | <?php echo $this->lang->line('log_in'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo site_url('theme/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url('theme/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo site_url('theme/bower_components/Ionicons/css/ionicons.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url('theme/dist/css/AdminLTE.min.css'); ?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<link rel="shortcut icon" href="<?php echo site_url('favicon.ico'); ?>" type="image/x-icon">
<link rel="icon" href="<?php echo site_url('favicon.ico'); ?>" type="image/x-icon">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page kok">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
	  <div class="login-logo">
    <b><img src="<?php echo site_url('theme/logo.png'); ?>" /></b>
  </div>
    <p class="login-box-msg"><?php echo $this->lang->line('log_in_message'); ?></p>
	<?php 
		$error = validation_errors(); 
		if ($error !="") {
		   echo '<div class="callout callout-danger"><p>'.$error.'</p></div>';
		}
	?>
	<?php if(isset($_SESSION['success']) && $_SESSION['success'] !="" ){ ?>
	<div class="callout callout-success">
			<p><?php echo $_SESSION['success']; ?></p>
		</div>
	<?php } $_SESSION['success'] = ''; ?>
	<?php if(isset($_SESSION['error']) && $_SESSION['error'] !="" ){ ?>
	<div class="callout callout-danger">
			<p><?php echo $_SESSION['error']; ?></p>
		</div>
	<?php } $_SESSION['error'] = ''; ?>
    <form action="<?php echo site_url('login'); ?>" method="post" onsubmit="return login_validate()" novalidate>
      <input type="hidden" name="post_check" value="1" />
      <label><?php echo $this->lang->line('email'); ?></label>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $this->lang->line('email'); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <label><?php echo $this->lang->line('password'); ?></label>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" id="password" placeholder="<?php echo $this->lang->line('password'); ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo $this->lang->line('log_in'); ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo site_url('theme/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url('theme/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

<?php if(isset($js) && $js !=""){ echo $js; } ?>
</body>
</html>
