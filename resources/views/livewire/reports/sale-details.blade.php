<div wire:ignore.self class="modal fade" style="background: #3b3f5c" id="getDetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3b3f5c">
                <h5 class="modal-title text-white" >
                    <b>Detalles de la Venta{{ $saleId }}</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>-- POR FAVOR ESPERAR --</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                            <tr>
                                <th class="table-th text-center text-white">Folio</th>
                                <th class="table-th text-center text-white">Producto</th>
                                <th class="table-th text-center text-white">Precio</th>
                                <th class="table-th text-center text-white">Cant.</th>
                                <th class="table-th text-center text-white">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $dets )
                                <tr>
                                    <td class="text-center">
                                        <h6>{{ $dets->id }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $dets->product }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>${{ number_format($dets->price,2) }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $dets->quantity }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>
                                            ${{ number_format($dets->quantity * $dets->price,2) }}
                                        </h6>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <h5 class="text-center font-weight-bold">Totales</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">{{ $countDetails }}</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">
                                        ${{ number_format($sumDetails,2) }}
                                    </h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark close-btn text-info"
                    data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
