<div wire:ignore.self id="modal-details" tabindex="-1" rol="dialog" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>Detalles de la Venta</b>
                </h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="text-white" style="background: #3B3F5F">
                            <tr>
                                <th class="table-th text-center text-white">Producto</th>
                                <th class="table-th text-center text-white">Cant.</th>
                                <th class="table-th text-center text-white">Precio</th>
                                <th class="table-th text-center text-white">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $dets )
                                <tr>
                                    <td class="text-center"><h6>{{ $dets->product }}</h6></td>
                                    <td class="text-center"><h6>{{ $dets->quantity }}</h6></td>
                                    <td class="text-center"><h6>${{ number_format($dets->price,2) }}</h6></td>
                                    <td class="text-center">
                                        <h6>
                                            ${{ number_format($dets->quantity * $dets->price,2) }}
                                        </h6>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <td class="text-right">
                                <h6 class="text-info">
                                    TOTALES:
                                </h6>
                            </td>
                            <td class="text-center">
                                @if ($details)
                                    <h6 class="text-info">
                                        {{ $details->sum('quantity') }}
                                    </h6>
                                @endif
                            </td>
                            @if ($details)
                                @php
                                    $mytotal = 0;
                                @endphp
                                @foreach ($detals as $dtotal )
                                    @php
                                        $mytotal += $dtotal->quantity * $dtotal->price;
                                    @endphp
                                @endforeach
                                <td></td>
                                <td class="text-center">
                                    <h6 class="text-info">
                                        ${{ number_format($mytotal,2) }}
                                    </h6>
                                </td>
                            @endif
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
