<div class="ng-container password-change">
	<div class="page-heading">
		<h1><i class='icon-cog'></i> Change Password</h1>
		<h3>Change your password for better security.</h3>            	
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<div class="messages">
					<i class='fa fa-warning fa-2x'></i>
					<span class="e-unexpected">Unexpected error, please contact customer support.</span>
					<span class="e-api-not-found">Api service is down, please contact customer support.</span>

					<span class="require-password">Password cannot be empty.</span>
					<span class="invalid-password">Password must be more than 6 characters.</span>
					<span class="password-not-confirm">New password not confirm.</span>
					<span class="password-not-correct">Old password not correct.</span>
				</div>
			</div>	

			<div class="profile panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">&nbsp;</h3>
			  </div>
			  <div class="panel-body">
			    <form>
			        <div class="form-group"> 
			        	<label>Old Password</label> 
			        	<input type="password" class="form-control" ng-model="vm.passwords.old"> 
			        </div>
			        <div class="form-group"> 
			        	<label>New Password</label> 
			        	<input type="password" class="form-control" ng-model="vm.passwords.new"> 
			        </div>
			        <div class="form-group"> 
			        	<label>Confirm New Password</label> 
			        	<input type="password" class="form-control" ng-model="vm.passwords.newConfirm"> 
			        </div>			        
			        <div class="form-group"> 
			        	<button class="btn btn-success" ng-click="vm.change(vm.passwords)">Submit</button>
			        </div>
			    </form>
			  </div>
			</div>

		</div>
	</div>


</div>