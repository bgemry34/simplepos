<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=<?=base_url()."assets/css/bootstrap.min.css";?>>
    <link rel="stylesheet" href=<?=base_url()."assets/css/all.min.css";?>>
    <link rel="stylesheet" href=<?=base_url()."assets/css/style.css";?>>
    <script src=<?=base_url()."assets/js/jquery.min.js";?>></script>
    <script src=<?=base_url()."assets/js/popper.min.js";?>></script>
    <title>Point of Sale</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="<?=base_url().'items'?>"><i class="fas fa-money-bill-alt"></i> Point of Sale</a>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarCollapse"
    aria-controls="navbarCollapse"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
			<?php if($this->session->userdata('logged_in') && $this->session->userdata('userType')==1):?>
			<li class="nav-item active">
        <a class="nav-link text-center" href="<?=base_url()."items";?>"><i class="fas fa-utensils fa-lg"></i> Items</a>
			</li>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."customers";?>"><i class="fa fa-male"></i></i> Customer Detail</a>
			</li>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."sales";?>"><i class="fas fa-chart-bar"></i> Sales Report</a>
			</li>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."log";?>"><i class="fas fa-book-open"></i> Users Log</a>
			</li>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."itemreturn";?>"><i class="fas fa-share-alt"></i> Item Returns</a>
			</li>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."receipts";?>"><i class="fas fa-scroll"></i> Receipt Records</a>
			</li>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."accounts";?>"><i class="fas fa-users"></i> Account Management</a>
			</li>
      <li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."backupdb";?>"><i class="fas fa-database"></i> Backup Database</a>
			</li>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."logout"?>"><i class="fas fa-sign-out-alt"></i> Log-out</a>
			</li>
			<?php endif;?>
			
			<?php if(!$this->session->userdata('logged_in') || $this->session->userdata('userType')!=1):?>
			<li class="nav-item">
        <a class="nav-link text-center" href="<?=base_url()."users/login"?>"><i class="fas fa-sign-in-alt"></i> Log-in</a>
			</li>
			<?php endif;?>
    </ul>
    <?=form_open('items/search', ['class'=>'form-inline ml-auto mt-2 mt-md-0'])?>
      <input class="form-control mr-sm-2" name="toSearch" type="text" placeholder="Search Item..." aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>
</nav>

<main class="content-wrapper">
  <div class="container-fluid">
  <?php if($this->session->flashdata('user_loggedin')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
   <?php endif; ?>

    
