@include('common.modalHead')

<div class="row">
	<div class="col-sm-12 col-md-8">
		<div class="form-gropup">
			<label>Nombre</label>
			<input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Luis Eduardo" autofocus>
			@error('name')
				<span class="text-danger er">{{ $message}}</span>
			@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="form-gropup">
			<label>Contacto</label>
			<input type="text" wire:model.lazy="phone" class="form-control" placeholder="ej: 313 353 2295" maxlength="10">
			@error('phone')
				<span class="text-danger er">{{ $message}}</span>
			@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="form-gropup">
			<label>Email</label>
			<input type="text" wire:model.lazy="email" class="form-control" placeholder="ej: luedgova1967@gmail.com">
			@error('email')
				<span class="text-danger er">{{ $message}}</span>
			@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="form-gropup">
			<label>Password</label>
			<input type="text" wire:model.lazy="password" class="form-control" placeholder="ej: Luis1234&">
			@error('password')
				<span class="text-danger er">{{ $message}}</span>
			@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="form-gropup">
			<label>Status</label>
			<select wire:lazy="status" class="form-control">
				<option value="Elegir" selected>Elegir</option>
				<option value="Active" selected>Active</option>
				<option value="Locked" selected>Locked</option>
			</select>
			@error('status')
				<span class="text-danger er">{{ $message}}</span>
			@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="form-gropup">
			<label>Asignar Role</label>
			<select wire:lazy="role" class="form-control">
				<option value="Elegir" selected>Elegir</option>
				@foreach($roles as $role)
					<option value="{{$role->id}}" selected>{{$role->name}}</option>
				@endforeach
			</select>
			@error('role')
				<span class="text-danger er">{{ $message}}</span>
			@enderror
		</div>
	</div>
	<div class="col-sm-12">
		<label>Imagen:</label>
		<div class="form-group custom-file">
			<input type="file" class="custom-file-input form-control" wire:model="image" accept="image/x-png, image/gif/, image/jpg">
			<label class="custom-file-label">Imágen {{$image}}</label>
			@error('image') <span class="text-danger er">{{ $message }}</span>@enderror
		</div>
	</div>
</div>

@include('common.modalFooter')