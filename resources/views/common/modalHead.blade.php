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
