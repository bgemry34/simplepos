<div class="container">
<div class="row">
	<div class="col-md-6">
		<h1><?=$title?></h1>
	</div>
	<div class="col-md-6">
		<button class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal">
		<i class="fas fa-plus"></i> Add Item
		</button>
		<a href="<?=base_url().'items/itemsArchived'?>">
		<button class="btn btn-primary float-right mr-1">
		<i class="fas fa-archive"></i> Items Archived
		</button>
		</a>
	</div>
</div>
<div class="item-container">
<div class="row">
	<div class="col-md-3">
    <p style="text-align: center;"><strong>Name</strong></p>
    </div>
    <div class="col-md-2">
    <p style="text-align: center;"><strong>Price</strong></p>
    </div>
    <div class="col-md-1">
    <p style="text-align: center;"><strong>Discount</strong></p>
		</div>
		<div class="col-md-1">
    <p style="text-align: center;"><strong>Qty</strong></p>
    </div>
    <div class="col-md-2">
    <p style="text-align: center;"><strong>Price w/ discount</strong></p>
    </div>
    <div class="col-md-1">
    <p style="text-align: center;"><strong>Edit</strong></p>
    </div>
    <div class="col-md-1">
        <p style="text-align: center;"><strong>Delete</strong></p>
    </div>
</div>
<?php foreach($items as $item): ?>
<div class="row">
	<div class="col-md-3 card">
        <p style="text-align: center;"><?=$item['name'];?></p>
    </div>
    <div class="col-md-2 card">
        <p style="text-align: center;"><?=$item['price'];?></p>
		</div>
    <div class="col-md-1 card">
        <p style="text-align: center;"><?=$item['discount'];?></p>
		</div>
		<div class="col-md-1 card">
        <p style="text-align: center;"><?=$item['qty'];?></p>
    </div>
    <div class="col-md-2 card">
        <p style="text-align: center;"><?=$item['price'] - ($item['price']*($item['discount']/100));?></p>
		</div>	
		<!-- edit -->
    <div class="col-md-1" style="padding:0; margin-left:5px;">
        <button type="button" onclick="itemFunction(<?=$item['id'];?>)" class="btn btn-success w-100" data-toggle="modal" data-target="#myModal">
        <i class="far fa-edit"></i>
        </button>
		</div>
		<!-- delete -->
		<div class="col-md-1" style="padding:0; margin-left:2.5px;">
        <button class="btn btn-danger w-100"  onclick="itemFunction(<?=$item['id'];?>)" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </div>
</div>
<?php endforeach; ?>
</div>
</div>
<div class="pagination-links text-center">
		<?php echo $this->pagination->create_links(); ?>
</div>

<!-- Edit Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<?=form_open('items/update');?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="name" id="" required>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input class="form-control" type="text" name="price" id="" required>
            </div>
            <div class="form-group">
              <label>Discount</label>
              <input class="form-control" type="text" name="discount" id="" required>
						</div>
						<div class="form-group">
              <label>Qty</label>
              <input class="form-control" type="text" name="qty" id="" required>
            </div>
            <input type="submit" value="Submit" class="form-control btn btn-success" required>
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
          <h4 class="modal-title">Create Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
					<div id="validation_error">

					</div>
				<?=form_open('items/create', ['id' => 'create_form']);?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="Created_name" id="Created_name" required>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input class="form-control" type="number" name="Created_price" id="Created_price" required> 
            </div>
            <div class="form-group">
              <label>Discount</label>
              <input class="form-control" type="number" name="Created_discount" id="Created_discount" required>
						</div>
						<div class="form-group">
              <label>Qty</label>
              <input class="form-control" type="number" name="Created_qty" id="Created_qty" required>
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
				<?=form_open('items/delete');?>
            <input type="hidden" name="id">
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
