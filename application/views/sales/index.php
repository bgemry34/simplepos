<div class="container-fluid">
		<?php if($this->session->flashdata('invalid_date')): ?>
		<?php echo '<p class="alert alert-danger text-center">'.
		$this->session->flashdata('invalid_date').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('sales_added')): ?>
		<?php echo '<p class="alert alert-success text-center">'.
		$this->session->flashdata('sales_added').'</p>'; ?>
		<?php endif; ?>
</div>
<div class="container">
<div class="row">
	<div class="col-md-6">
		<h1><?=$title?></h1>
	</div>
	<div class="col-md-6">
		<button class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal">
		<i class="fas fa-plus"></i> Generate Sales Report
		</button>
	</div>
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-md-2">
    <p style="text-align: center;"><strong>Starting Date</strong></p>
    </div>
    <div class="col-md-2">
    <p style="text-align: center;"><strong>Ending Date</strong></p>
    </div>
    <div class="col-md-1">
    <p style="text-align: center;"><strong>Customer Count/day</strong></p>
		</div>
		<div class="col-md-1">
    <p style="text-align: center;"><strong>Customer Count/month</strong></p>
		</div>
		<div class="col-md-2">
    <p style="text-align: center;"><strong>Revenue/Day</strong></p>
		</div>
		<div class="col-md-3">
    <p style="text-align: center;"><strong>Revenue/Month</strong></p>
		</div>
    <div class="col-md-1">
        <p style="text-align: center;"><strong>Delete</strong></p>
    </div>
</div>
</div>
<div class="container-fluid">
<?php foreach($sales as $sale): ?>
<div class="row">
	<div class="col-md-2 card">
        <p style="text-align: center;"><?=$sale['starting_date'];?></p>
    </div>
    <div class="col-md-2 card">
        <p style="text-align: center;"><?=$sale['ending_date'];?></p>
    </div>
    <div class="col-md-1 card">
        <p style="text-align: center;"><?=number_format($sale['customerCount']/$sale['days'], 0)?></p>
		</div>
		<div class="col-md-1 card">
        <p style="text-align: center;"><?=number_format($sale['customerCount']/$sale['days']*30, 0)?></p>
		</div>
		<div class="col-md-2 card">
        <p style="text-align: center;"><?=number_format($sale['revenue']/$sale['days'], 2)?></p>
		</div>
		<div class="col-md-3 card">
        <p style="text-align: center;"><?=number_format(($sale['revenue']/$sale['days'])*30, 2);?></p>
		</div>
		<!-- delete -->
	<div class="col-md-1">
        <button class="btn btn-danger w-100"  onclick="salesFunction(<?=$sale['id'];?>)" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </div>
</div>
<?php endforeach; ?>
</div>
</div>
<div class="pagination-links text-center">
		<?php echo $this->pagination->create_links(); ?>
</div>

<!-- Create Modal -->
<div class="modal" id="createModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Sales</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<?=form_open('sales/create');?>
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Starting Date</label>
              <input type="date" name="startingDate" class="form-control" required>
						</div>
						<div class="form-group">
              <label>Ending Date</label>
              <input type="date"  class="form-control" name="endingDate" required>
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
          <h4 class="modal-title">Delete Sales</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<?=form_open('sales/delete');?>
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
