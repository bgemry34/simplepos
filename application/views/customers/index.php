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
