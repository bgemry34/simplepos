<div class="container">
<div class="row">
	<div class="col-md-6">
		<h1><?=$title?></h1>
	</div>
	<div class="col-md-6">
	</div>
</div>
<div class="item-container">
<div class="row">
	<div class="col-md-2">
    <p style="text-align: center;"><strong>Receipt Id</strong></p>
    </div>
    <div class="col-md-4">
    <p style="text-align: center;"><strong>Customer Name</strong></p>
    </div>
    <div class="col-md-1">
    <p style="text-align: center;"><strong>Payment Type</strong></p>
    </div>
    <div class="col-md-1">
    <p style="text-align: center;"><strong>Total Price</strong></p>
    </div>
    <div class="col-md-1">
    <p style="text-align: center;"><strong>Cash Recieved</strong></p>
    </div>
</div>
<?php foreach($receipts as $receipt): ?>
<div class="row">
	  <div class="col-md-2 card">
        <p style="text-align: center;"><?=$receipt['receipt_id'];?></p>
    </div>
    <div class="col-md-4 card">
        <p style="text-align: center;"><?=$receipt['customer_name'];?></p>
    </div>
    <div class="col-md-1 card">
        <p style="text-align: center;"><?=$receipt['paymentType'];?></p>
    </div>
    <div class="col-md-1 card">
        <p style="text-align: center;"><?=$receipt['totalPrice'];?></p>
    </div>
    <div class="col-md-1 card">
        <p style="text-align: center;"><?=$receipt['cashReceived'];?></p>
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
          <h4 class="modal-title">Update Receipt</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<?=form_open('receipts/update');?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Item Name</label>
              <select name="item_id" id="" class="form-control">
                  <?php foreach($items as $item):?>
                    <option value="<?=$item['id']?>"><?=$item['name']?></option>
                  <?php endforeach;?>
              </select>
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
          <h4 class="modal-title">Create Receipt</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<?=form_open('receipts/create');?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Item Name</label>
              <select name="item_id" id="" class="form-control">
                  <?php foreach($items as $item):?>
                    <option value="<?=$item['id']?>"><?=$item['name']?></option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group">
              <label>Qty</label>
              <input class="form-control" type="number" name="qty" id="" required> 
            </div>
            <input type="submit" value="Submit" class="form-control btn btn-success">
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
          <h4 class="modal-title">Delete Receipt</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<?=form_open('receipts/delete');?>
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
