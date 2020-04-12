<div class="container">
<div class="row">
	<div class="col-md-6">
		<h1><?=$title?></h1>
	</div>
</div>
<div class="sales-container" style="margin-top: 25px; margin-left: 150px;">
<div class="row">
	<div class="col-md-2">
    <p style="text-align: center;"><strong>Username</strong></p>
    </div>
    <div class="col-md-2">
    <p style="text-align: center;"><strong>Date</strong></p>
    </div>
    <div class="col-md-2">
    <p style="text-align: center;"><strong>Action</strong></p>
    </div>
</div>
<?php foreach($logs as $log): ?>
<div class="row">
	<div class="col-md-2 card">
        <p style="text-align: center;"><?=$log['username'];?></p>
    </div>
    <div class="col-md-2 card">
        <p style="text-align: center;"><?=$log['date_created'];?></p>
    </div>
    <div class="col-md-2 card">
        <p style="text-align: center;"><?=$log['action'];?></p>
    </div>

</div>
<?php endforeach; ?>
</div>
</div>
<div class="pagination-links text-center">
		<?php echo $this->pagination->create_links(); ?>
</div>
