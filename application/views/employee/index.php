<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=base_url()."assets/css/bootwatch.css"?>">
    <script src="<?=base_url()."assets/js/jquery.min.js"?>"></script>
    
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
        <hr style="border: 5px solid green;">
                <form id="toSearch">
                    <div class="row">

                    <div class="form-group col-md-7" >
                        <input class="form-control" id="itemName" type="text" placeholder="Search" style="border-radius:0;" name="itemName">
                    </div>
                    <div class="col">
                            <button class="btn btn-dark form-control my-2 my-sm-0" style="border-radius:0;" type="submit">Search</button>
                    </div>

                    </div>
                </form>

                <div class="row">
                    <div class="col-md-4 text-center"><h3>Item Name</h3></div>
					<div class="col-md-3 text-center"><h3>Price</h3></div>
					<div class="col-md-2 text-center"><h3>Stk.</h3></div>
                    <div class="col-md-2 text-center"><h3>Add</h3></div>
                </div>

                <div style="height: 70vh; overflow:auto;">
                    <div class="row" id="itemGen">
                </div>
                    </div>
    </div>

    <div class="col-md-6">
    <hr style="border: 5px solid limegreen;">
    <?php if($this->session->flashdata('receipt_generate')): ?>
        <div class="alert alert-primary" style="padding:0; margin-bottom:0; border-radius:0;">
		<?php echo '<p class="lead text-center" style="padding:10px; margin:0;">'.
		$this->session->flashdata('receipt_generate').'</p>'; ?>
		</div>
		<a href="#" id="toSeeReceipt" data-toggle="modal" data-target="#showReceipt" class="alert alert-info" style="border-radius:0;text-decoration:none; text-align:center; display:block; padding:0; margin:0;">>>Click Show Receipt<<</a>
	<?php endif; ?>
    <?php if($this->session->flashdata('receipt_error')): ?>
        <div class="alert alert-danger" style="padding:0;">
		<?php echo '<p class="lead text-center" style="padding:0; margin:0;">'.
        $this->session->flashdata('receipt_error').'</p>'; ?>
        </div>
	<?php endif; ?>
        <?=form_open('employee/addreceipts');?>
            <div class="form-group" id="addedorders">
                <label><h3>Purchased Items</h3></label>
                <div class="row">
                    <div class="col-md-5 text-center">
                    <h4>Item Name</h4>
                    </div>
                    <div class="col-md-2 text-center">
                    <h4>Qty</h4>
					</div>
					<div class="col-md-3 text-center">
                    <h4>Price</h4>
                    </div>
                    <div class="col-md-2 text-center">
                    </div>
                </div>

                <!-- list of items Purchased -->
                <div id="addedItems">
									
				</div>
				<div id="totalPrice">
				</div>
			</div>
			
			<div class="form-group">
                <Label>Customer Name:</Label>
                <select name="customerId" class="form-control">
                <?php foreach($customers as $customer): ?>
                <option value="<?=$customer['id']?>"><?=$customer['name']?></option>
                <?php endforeach;?>
                </select>
			</div>
			<div class="form-group">
                <Label>Payment Type:</Label>
                <select name="paymentTypeId" class="form-control">
                <?php foreach($paymentTypes as $paymentType): ?>
                <option value="<?=$paymentType['id']?>"><?=ucfirst($paymentType['paymentType'])?></option>
                <?php endforeach;?>
                </select>
			</div>
			<div class="form-group">
				<label for="">Cash Received:</label>
				<input class="form-control" disabled type="number" name="cashReceived" id="cashReceived">
			</div>
			<div class="form-group">
				<input type="submit" disabled value="Generate Receipt" name="toPurchase" id="toPurchase" class="btn btn-success form-control">
			</div>
        </form>
    </div>
</div>
<!-- Receipt Modal -->
<div class="modal" id="showReceipt">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Receipt</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<form>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Receipt Id:</label>
              <h4 id="receiptIdReceipt"></h4>
            </div>
            <div class="form-group">
			  <label>Customer Name:</label>
			  <h4 id="customerNameReceipt"></h4>
			</div>
			<div class="form-group">
			  <label>Payment Type:</label>
			  <h4 id="paymentTypeReceipt" class="text-capitalize"></h4>
            </div>
            <div class="form-group">
			  <label>Item Purchased:</label>
			  	<!-- receipt item list -->
				<div id="itemListContainer" style="display:grid; grid-template-columns: 1fr;">
						
				</div>
			</div>

			<div class="form-group">
			  <label>Cash Received:</label>
			  <h4 id="outputCashReceived"></h4>
			</div>

			<div class="form-group">
			<label>Change:</label>
			<h4 id="cashChange"></h4>
            </div>
			
			<div class="form-group">
			  <label>Total Price:</label>
			  <h4 id="totalPriceReceipt"></h4>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
<script src=<?=base_url().'assets/js/bootstrap.min.js'?>></script>
<script src="<?=base_url()."assets/js/employee.js"?>"></script>
</body>
</html>

  <!-- search item -->
  
    