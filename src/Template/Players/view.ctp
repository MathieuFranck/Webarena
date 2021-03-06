<div class="row mt-4 justify-content-around">
	<div class="col-12 col-md-4 mb-3">
		<div class="card">
			<div class="card-header">
				Account
			</div>
			<div class="card-body">
				<fieldset disabled class="mt-4 mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">Email</span>
						<input type="text" class="form-control" placeholder="<?= $player->email ?>" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<fieldset class="mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">New email</span>
						<input type="text" id="disabledTextInput" class="form-control" placeholder="New email" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<fieldset class="mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">Confirm email</span>
						<input type="text" id="disabledTextInput" class="form-control" placeholder="Confirm email" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<button class="btn btn-info mt-2 float-right">Modify email</button>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 mb-3">
		<div class="card">
			<div class="card-header">
				Password
			</div>
			<div class="card-body">
				<fieldset class="mt-4 mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">Password</span>
						<input type="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<fieldset class="mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">New password</span>
						<input type="password" class="form-control" placeholder="New password" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<fieldset class="mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">Confirm email</span>
						<input type="password" class="form-control" placeholder="Confirm password" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<button class="btn btn-info mt-2 float-right">Modify password</button>
			</div>
		</div>
	</div>
</div>