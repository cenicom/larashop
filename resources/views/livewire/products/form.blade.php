@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-8">
		<div class="form-group">
			<label>Categorias:</label>
			<select wire:model='category_id' class="form-control">
				<option value="Elegir">Seleccionar Categoria:</option>
				@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
				@error('category_id') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
    </div>
	<div class="col-sm-12 col-md-8">
		<div class="form-group">
			<label>Nombre:</label>
			<input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Curso Laravel" />
			@error('name') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="form-group">
			<label>Código Barras:</label>
			<input type="text" wire:model.lazy="barcode" class="form-control" placeholder="ej: 770852963214" />
				@error('barcode') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="form-group">
			<label>Costo:</label>
			<input type="text" data-type="currency" wire:model.lazy="cost" class="form-control"
                    placeholder="ej: $0.00"/>
				@error('cost') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="form-group">
			<label>Precio:</label>
			<input type="text" data-type="currency" wire:model.lazy="price" class="form-control"
                    placeholder="ej: $0.00"/>
				@error('price') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="form-group">
			<label>Stock:</label>
			<input type="number" wire:model.lazy="stock" class="form-control" placeholder="ej: 30.00"/>
				@error('stock') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-4">
		<div class="form-group">
			<label>Inventario Mínimo:</label>
			<input type="number" wire:model.lazy="alert" class="form-control" placeholder="ej: 10.00"/>
				@error('alert') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
	</div>
	<div class="col-sm-12 col-md-8">
		<label>Imagen Producto:</label>
		<div class="form-group custom-file">
			<input type="file" class="custom-file-input form-control" wire:model="image"
                    accept="image/x-png, image/gif, image/jpeg"/>
			<label class="custom-file-label">Imagén {{$image}}</label>
				@error('image') <span class="text-danger er">{{ $message}}</span>@enderror
		</div>
    </div>
</div>





@include('common.modalFooter')
