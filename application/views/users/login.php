<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="<?=base_url()."assets/css/style.css"?>">
	<link rel="stylesheet" href="<?=base_url()."assets/css/bootstrap.min.css"?>">
	<link rel="stylesheet" href="<?=base_url()."assets/css/all.min.css"?>">
	<script src="<?=base_url()."assets/js/bootstrap.min.js"?>"></script>
	<script src="<?=base_url()."assets/js/script.js"?>"></script>
	<title>Log-in</title>
</head>
<body class=login-body>
	<div class="login-container">
		<div style="width: 80%; padding-top:2rem; margin: auto;">
		<h1><strong>Login</strong></h3><br>
		<?php if($this->session->flashdata('login_failed')): ?>
		<?php echo '<p class="alert alert-danger text-center">'.
		$this->session->flashdata('login_failed').'</p>'; ?>
		<?php endif; ?>
		  
		<?php if($this->session->flashdata('user_loggedout')): ?>
		<?php echo '<p class="alert alert-success text-center">'.
		$this->session->flashdata('user_loggedout').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('not_login')): ?>
		<?php echo '<p class="alert alert-danger text-center">'.
		$this->session->flashdata('not_login').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('alreadyLogged')): ?>
		<?php echo '<p class="alert alert-danger text-center">'.
		$this->session->flashdata('alreadyLogged').'</p>'; ?>
		<?php endif; ?>
		  
		<?=form_open('users/login', ['class'=>'form-container'])?>
			<div class="form-group" style="margin-bottom: 30px;">
			<label style="float:left; font-size:1rem">Log in as:</label>
				<select name="userType" class="form-control">
				<?php foreach($usertypes as $usertype):?>
                    <option value="<?=$usertype['id']?>"><?=ucfirst($usertype['usertype'])?></option>
                  <?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
			<input class="form-control" type="text" name="username" id="" placeholder="Username...">
			</div>
			<div class="form-group">
			<input class="form-control" type="password" name="password" placeholder="Password...">
			</div>
			<div class="form-group float-right">
			<input class="btn btn-primary" type="submit" name="submit" value="Login">
			</div>
		</form>
		</div>
	</div>
</body>
</html>
