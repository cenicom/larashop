<div>
   <style type="text/css"></style>
   <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <!-- Detalles de la Venta -->
            @include('livewire.ventas.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">
            <!-- Totales de la Venta -->
            @include('livewire.ventas.partials.total')

            <!-- Denominaciónes -->
            @include('livewire.ventas.partials.coins')
        </div>
   </div>
</div>

<script src="{{ asset('js/keypress.js') }}"></script>
<script src="{{ asset('js/onscan.js') }}"></script>

@include('livewire.ventas.scripts.shortcuts')
@include('livewire.ventas.scripts.events')
@include('livewire.ventas.scripts.general')
@include('livewire.ventas.scripts.scan')