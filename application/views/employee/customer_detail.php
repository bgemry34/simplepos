<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=base_url()."assets/css/bootwatch.css"?>">
    <link rel="stylesheet" href=<?=base_url()."assets/css/all.min.css";?>>
    <script src=<?=base_url()."assets/js/jquery.min.js";?>></script>
    <script src=<?=base_url()."assets/js/popper.min.js";?>></script>
    <title>Employee</title>
</head>
<body>

<div class="bs-component">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">POS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="<?=base_url().'employee'?>">Sales <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=base_url().'employee/itemreturn'?>">Item Return</a>
        </li>
        <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url();?>users/logout">Log-out</a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    </nav>
</div>
<br><br>

<div class="container">
<div class="row">
	<div class="col-md-6">
		<h1><?=$title?></h1>
	</div>
	<div class="col-md-6">
    <div class="" style="display:grid; grid-template-coloumn: 1fr;">
    <div class="" style="margin-bottom:5px;">
    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal">
		<i class="fas fa-plus"></i> Add Customer
		</button>
    </div>
    </div>
	</div>
</div>
<div class="item-container">
<div class="" style="position:relative; left:50px;">
<div class="row">
	<div class="col-md-3">
    <p style="text-align: center;"><strong>Customer Name</strong></p>
    </div>
    <div class="col-md-4">
    <p style="text-align: center;"><strong>Address</strong></p>
    </div>
    <div class="col-md-2">
    <p style="text-align: center;"><strong>Contact no.</strong></p>
	  </div>
    <div class="col-md-1">
    <p style="text-align: center;"><strong>Edit</strong></p>
    </div>
    <div class="col-md-1">
        <p style="text-align: center;"><strong>Delete</strong></p>
    </div>
</div>

<?php foreach($customers as $customer): ?>
<div class="row">
	<div class="col-md-3 card">
        <p style="text-align: center;"><?=$customer['name'];?></p>
    </div>
    <div class="col-md-4 card">
        <p style="text-align: center;"><?=$customer['address'];?></p>
		</div>
    <div class="col-md-2 card">
        <p style="text-align: center;"><?=$customer['contactno'];?></p>
		</div>
		<!-- edit -->
    <div class="col-md-1" style="padding:0; margin-left:5px;">
        <button type="button" onclick="customerFunction(<?=$customer['id'];?>)" class="btn btn-success w-100" data-toggle="modal" data-target="#editModal">
        <i class="far fa-edit"></i>
        </button>
		</div>  
		<!-- delete -->
		<div class="col-md-1" style="padding:0; margin-left:2.5px;">
        <button class="btn btn-danger w-100"  onclick="customerFunction(<?=$customer['id'];?>)" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </div>
</div>
<?php endforeach; ?>
</div>
</div>
</div>
<div class="pagination-links text-center">
		<?php echo $this->pagination->create_links(); ?>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Customer</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
					<div id="validation_error">

					</div>
				<?=form_open('customers/edit', ['id' => 'create_customer_form']);?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="Edited_name" id="Edited_name" required>
            </div>
            <div class="form-group">
              <label>Address</label>
              <input class="form-control" type="text" name="Edited_address" id="Edited_address" required> 
            </div>
            <div class="form-group">
              <label>Contact Number</label>
              <input class="form-control" type="text" name="Edited_contact" id="Edited_contact" required> 
						</div>
            <input type="submit" id="createSubmit" value="Submit" class="form-control btn btn-success">
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Create Modal -->
<div class="modal" id="createModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Customer</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
					<div id="validation_error">

					</div>
				<?=form_open('customers/create', ['id' => 'create_customer_form']);?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="Created_name" id="Created_name" required>
            </div>
            <div class="form-group">
              <label>Address</label>
              <input class="form-control" type="text" name="Created_address" id="Created_position" required> 
            </div>
            <div class="form-group">
              <label>Contact Number</label>
              <input class="form-control" type="text" name="contactno" id="contactno" required> 
						</div>
            <input type="submit" id="createSubmit" value="Submit" class="form-control btn btn-success">
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Create Company Modal -->
<div class="modal" id="createCompanyModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Company</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
					<div id="validation_error_company">
					</div>
				  <?=form_open('customers/create_company', ['id' => 'create_company_form']);?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Company Name</label>
              <input class="form-control" type="text" name="Created_name" id="Created_company_name" required>
            </div>
            <input type="submit" id="createSubmit" value="Submit" class="form-control btn btn-success">
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Delete Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              <?=form_open('customers/delete');?>
              <input type="hidden" name="customer_id">
              <div class="d-block">
              <label for="" class="float-left">Are you sure you want to delete?</label>
              </div>
              <div class="float-right d-inline-block">
              <input type="submit" value="Yes" class="btn btn-link">
              <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <script src=<?=base_url().'assets/js/bootstrap.min.js'?>></script>
<script src=<?=base_url().'assets/js/script.js'?>></script>
</body>
</html>

  
    