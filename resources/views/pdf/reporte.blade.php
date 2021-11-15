<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reporte de Ventas</title>
        <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}">

    </head>
    <body>
        <section style="top: -287px" class="header">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td class="text-center" colspan="2">
                        <span style="font-size: 25px; font-weight: bold">
                            Sistema Ventas LWPOS
                        </span>
                    </td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative">
                        <img src="{{ asset('template/images/photo_2021.jpg') }}" alt="" class="invoice-logo">
                    </td>
                    <td width="70%" class="text-left text-company" style="
                            vertical-align: top; padding-top: 10px">
                        @if ($reportType == 0)
                            <span style="font-size: 16px">
                                <strong> Reporte de las Ventas del Día </strong>
                            </span>
                        @else
                            <span style="font-size: 16px">
                                <strong> Reporte de las Ventas por Fecha </strong>
                            </span>
                        @endif
                        <br>
                        @if ($reportType != o)
                            <span style="font-size: 16px">
                                <strong> Fecha de Consulta: {{ $dateFrom }} al {{ $dateTo }} </strong>
                            </span>
                        @else
                            <span style="font-size: 16px">
                                <strong> Fecha de Consulta: {{ \Carbon\Carbon::now()->format('d-M-Y') }} </strong>
                            </span>
                        @endif
                        <br>
                        <span style="font-size: 16px">
                            Usuario: {{ $user }}
                        </span>
                    </td>
                </tr>
            </table>
        </section>
        <section style="margin-top: -110px">
            <table cellpadding="0" cellspacing="0" class="table table-items">
                <thead>
                    <th width="10%">Folio</th>
                    <th width="15%">Importe</th>
                    <th width="10%">Items</th>
                    <th width="15%">Status</th>
                    <th>Usuario</th>
                    <th width="20%">Fecha</th>
                </thead>
                <tbody>
                    @foreach ($data as $item )
                        <td align="center">{{ $item->id }}</td>
                        <td align="center">${{ number_format($item->total,2) }}</td>
                        <td align="center">{{ $item->items }}</td>
                        <td align="center">{{ $item->status }}</td>
                        <td align="center">{{ $item->user }}</td>
                        <td align="center">{{ $item->created_at }}</td>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center">
                            <span><b>Totales:</b></span>
                        </td>
                        <td class="text-center" colspan="1">
                            <span>
                                <strong>
                                    ${{ number_format($data->sum('total'),2) }}
                                </strong>
                            </span>
                        </td>
                        <td class="text-center">
                            {{ $data->sum('items') }}
                        </td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section>
            <tr>
                <td width="20%">
                    <span>
                        Sistema LWPOS v1.0
                    </span>
                </td>
                <td width="20%" class="text-center">
                    cenicom.com
                </td>
                <td width="20%" class="text-center">
                    <span>
                        Página <span class="pagenum"></span>
                    </span>
                </td>
            </tr>
        </section>
    </body>
</html>
