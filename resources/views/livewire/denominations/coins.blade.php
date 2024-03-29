<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)"
                        class="tabMenu bg-dark text-white" data-toggle="modal" data-target="#theModal">Agregar Registro</a>
                    </li>
                </ul>
            </div>
            @include('common.searchBox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table-bordered table-hover table striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                            <tr>
                                <th class="table-th text-center text-white">Tipo Moneda</th>
                                <th class="table-th text-center text-white">Descripción</th>
                                <th class="table-th text-center text-white">Imagen</th>
                                <th class="table-th text-center text-white">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($denominations as $denomination)
                            <tr>
                                <td><h6>{{$denomination->type}}</h6></td>
                                <td class="text-left"><h6>${{($denomination->value)}}</h6></td>
                                <td class="text-center">
                                    <span>
                                        <img src="{{ asset('storage/denominations/' .$denomination->image) }}" alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)"
                                    wire:click.prevent="Edit({{ $denomination->id }})"
                                    class="btn btn-info mtmobile" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>

                                    <a href="javascript:void(0)" onclick="confirm('{{$denomination->id}}')"
                                    class="btn btn-danger" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $denominations->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.denominations.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('item-added' , msg =>{
            $('#theModal').modal('hide')
        });
        window.livewire.on('item-updated' , msg =>{
            $('#theModal').modal('hide')
        });
         window.livewire.on('item-delete' , msg =>{
            //noty---**
        });
         window.livewire.on('modal-show' , msg =>{
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide' , msg =>{
            $('#theModal').modal('hide')
        });
        $('#theModal').on('hidden.bs.modal' , function(){
            $('.er').css('display', 'none')
        });
        $('#theModal').on('hidden.bs.modal' , function(e){
            $('.er').css('display', 'none')
        });

    });

</script>

<script>
    function confirm(id) {
        // body...


                Swal({
                title: 'CONFIRMAR BORRADO',
                text: '¿Está Seguro de Querer Eliminar la Demonimación Seleccionada?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
                }).then(function(result) {
                // body...
                    if(result.value){
                        window.livewire.emit('deleteRow', id)
                        Swal.close()
                        }
                    })
                }



</script>



