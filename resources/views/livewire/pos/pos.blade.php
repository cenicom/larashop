<div>
   <style type="text/css"></style>
   <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <!-- Detalles de la Venta -->
            @include('livewire.pos.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">
            <!-- Totales de la Venta -->
            @include('livewire.pos.partials.total')

            <!-- Denominaciónes -->
            @include('livewire.pos.partials.coins')
        </div>
   </div>
</div>

<script src="{{ asset('js/keypress.js') }}"></script>
<script src="{{ asset('js/onscan.js') }}"></script>

@include('livewire.pos.scripts.shortcuts')
@include('livewire.pos.scripts.events')
@include('livewire.pos.scripts.general')
@include('livewire.pos.scripts.scan')
