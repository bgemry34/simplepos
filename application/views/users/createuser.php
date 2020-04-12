<h3 class="text-center">Create User</h3>
<?=form_open('users/createAccount')?>
	<div class="form-group">
		<label for="">Username:</label>
		<input class="form-control" type="text" name="username" id="" required>
	</div>
	<div class="form-group">
		<label for="">Password:</label>
		<input class="form-control" type="password" name="userPass" id=""  required>
	</div>
	<div class="form-group">
		<label for="">User Type:</label>
		<select class="form-control" name="usertype" id="">
			<option value="1">Admin</option>
			<option value="2">Employee</option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" value="Create User" class="form-control btn btn-primary">
	</div>
</form>
