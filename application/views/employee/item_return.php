<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=base_url()."assets/css/bootwatch.css"?>">
    <script src="<?=base_url()."assets/js/jquery.min.js"?>"></script>
    <script src="<?=base_url()."assets/js/employee.js"?>"></script>
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
            <a class="nav-link" href="#">Sales <span class="sr-only">(current)</span></a>
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
    <br>
    <div class="container">
    <h2 class="text-center">Item Return</h2>
    <?=form_open('employee/addItemReturn')?>
    <div class="form-group">
    <label for="">Select Item:</label>
                <select name="itemId" class="form-control">
                <?php foreach($items as $item): ?>
                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                <?php endforeach;?>
                </select>
    </div>
    <div class="form-group">
    <label for="">Comment:</label>
        <textarea name="comment" required id="" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Submit" name="itemReturnSubmit" class="btn btn-primary form-control">
    </div>
</form>
    </div>

</body>
</html>

  
    