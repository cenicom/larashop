<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName}} | {{ $pageTitle}}</b>
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
                                <th class="table-th text-white">ID</th>
                                <th class="table-th text-white text-center">Descripción</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permisos as $permiso)
                            <tr>
                                <td><h6>{{$permiso->id}}</h6></td>
                                <td class="text-center">
                                    <h6>{{$permiso->name}}</h6>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)"
                                    wire:click="Edit({{$permiso->id}})"
                                    class="btn btn-info mtmobile" title="Edit Record">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                    onclick="confirm('{{$permiso->id}}')"
                                    class="btn btn-danger" title="Delete Record">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$permisos->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.permissions.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('permiso-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })
        window.livewire.on('permiso-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })
        window.livewire.on('permiso-deleted', msg => {
            noty(msg)
        })
        window.livewire.on('permiso-exist', msg => {
            noty(msg)
        })
        window.livewire.on('permiso-error', msg => {
            noty(msg)
        })
        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        })

    });
</script>
<script>
    function confirm(id) {
        // body...
        Swal({
            title: 'CONFIRMAR BORRADO',
            text: '¿Está Seguro de Querer Eliminar el Registro Seleccionado?',
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


