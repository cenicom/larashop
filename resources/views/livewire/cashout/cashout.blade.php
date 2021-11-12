<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget-widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>Corte de Caja</b></h4>
            </div>
        </div>
        <div class="widget-content">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Usuario</label>
                        <select wire:model="userid" class="form-control">
                            <option value="0" disabled>Elegir Usuario</option>
                            @foreach ($users as $user )
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('userid') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Fecha Inicial</label>
                        <input type="date" wire:model.lazy="fromDate" class="form-control">
                        @error('fromDate') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Fecha Final</label>
                        <input type="date" wire:model.lazy="toDate" class="form-control">
                        @error('toDate') <span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col sm-12 col-md-3 align-self-center d-flex justify-content-around">
                    @if ($userid > 0 && $fromDate != null && $toDate != null)
                        <button class="btn btn-dark" type="button" wire:click.prevent="Consultar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            Consultar
                        </button>
                    @endif
                    @if ($total > 0)
                        <button class="btn btn-dark" type="button" wire:click.prevent="Print()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                            </svg>
                            Imprimir
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-4 mbmobile">
                <div class="connect-sorting bg-dark">
                   <h5 class="text-white">Ventas Totales: ${{number_format($total,2)  }} </h5>
                   <h5 class="text-white">Total Articulos: {{ $items  }} </h5>
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="text-white" style="background: #3B3F5F">
                            <tr>
                                <th class="table-th text-center text-white">Folio</th>
                                <th class="table-th text-center text-white">Total</th>
                                <th class="table-th text-center text-white">Items</th>
                                <th class="table-th text-center text-white">Fecha</th>
                                <th class="table-th text-center text-white"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($total <= 0)
                                <tr>
                                    <td colspan="4">
                                        <h6 class="text-center">
                                            No Hay Ventas en la Fecha Seleccionada
                                        </h6>
                                    </td>
                                </tr>
                            @endif
                                @foreach ($sales as $rows )
                                    <tr>
                                        <td class="text-center"><h6>{{ $rows }}</h6></td>
                                        <td class="text-center"><h6>${{ number_format($rows,2) }}</h6></td>
                                        <td class="text-center"><h6>{{ $rows->items }}</h6></td>
                                        <td class="text-center"><h6>{{ $rows->created_at }}</h6></td>
                                        <td class="text-center">
                                            <button wire:click.prevent="viewDetails({{ $rows }})"
                                                class="btn btn-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-blockquote-left" viewBox="0 0 16 16">
                                                    <path d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1h-11zm5 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6zm-5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1h-11zm.79-5.373c.112-.078.26-.17.444-.275L3.524 6c-.122.074-.272.17-.452.287-.18.117-.35.26-.51.428a2.425 2.425 0 0 0-.398.562c-.11.207-.164.438-.164.692 0 .36.072.65.217.873.144.219.385.328.72.328.215 0 .383-.07.504-.211a.697.697 0 0 0 .188-.463c0-.23-.07-.404-.211-.521-.137-.121-.326-.182-.568-.182h-.282c.024-.203.065-.37.123-.498a1.38 1.38 0 0 1 .252-.37 1.94 1.94 0 0 1 .346-.298zm2.167 0c.113-.078.262-.17.445-.275L5.692 6c-.122.074-.272.17-.452.287-.18.117-.35.26-.51.428a2.425 2.425 0 0 0-.398.562c-.11.207-.164.438-.164.692 0 .36.072.65.217.873.144.219.385.328.72.328.215 0 .383-.07.504-.211a.697.697 0 0 0 .188-.463c0-.23-.07-.404-.211-.521-.137-.121-.326-.182-.568-.182h-.282a1.75 1.75 0 0 1 .118-.492c.058-.13.144-.254.257-.375a1.94 1.94 0 0 1 .346-.3z"/>
                                                  </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.cashout.modelDetails')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', msg=>{
            $('#modal-details').modal('show')
        })
    })
</script>
