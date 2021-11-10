<div wire:ignore.self class="modal fade" style="background: #3b3f5c" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #3b3f5c">
          <h5 class="modal-title text-white" >
              <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
            </h5>
          <h6 class="text-center text-warning" wire:loading>-- POR FAVOR ESPERAR --</h6>
        </div>
        <div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<label>Nombre Permiso:</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
							</span>
						</div>
						<input type="text" wire:model.lazy="permissionName" class="form-control" placeholder="ej: Admin">
					</div>
					@error('permissionName') <span class="text-danger er">{{ $message }}</span>@enderror
				</div>
			</div>



</div>
    <div class="modal-footer">
        <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info"
            data-dismiss="modal">
            Cerrar
        </button>
        @if ($selected_id < 1)
            <button type="button" wire:click.prevent="createPermission()"
                class="btn btn-primary close-modal">
                Guardar
            </button>
        @else
            <button type="button" wire:click.prevent="updatePermission()"
                class="btn btn-dark close-modal">
                Actualizar
            </button>
        @endif

    </div>
</div>
</div>
</div>
