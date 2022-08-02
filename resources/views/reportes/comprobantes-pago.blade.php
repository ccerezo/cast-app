<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<style type="text/css">
    body{
        font-size: 14px;
    }
    .container{
        width: auto;
        margin: 0 10px;
    }
    .titulo{
        font-size: 16px;
        font-weight: bold;
    }
    p{
        margin: 3px 0px;
    }
    table{
        width: 100%;
        margin-top: 10px;
    }
    table thead tr th{
        text-align:center;
    }
    .text-right{
        text-align: right;
    }

</style>
<body>
    <br />
    <p class="text-center titulo">Comprobante de Pago</p>
    <br />

    <table>
        <thead>
            <tr>
            <th class="border-bottom" style="width: 20%;"></th>
            <th class="border-bottom" style="width: 20%;"></th>
            <th class="border-bottom" style="width: 50%;"></th>
            <th class="border-bottom" style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody>
            @php
                $aux_id = 0;
                $monto_pagado = 0;
            @endphp

            @foreach ($pagos as $pago)
                @if ($aux_id !== $pago->factura_id)
                    @php
                        $monto_pagado = 0;
                    @endphp
                    <tr>
                        <td style="padding:10px; border-left: 1px solid #c7c7c7; border-top: 1px solid #c7c7c7">
                            Factura #: {{ $pago->factura->numero}}
                        </td>
                        <td style="padding:10px; border-top: 1px solid #c7c7c7">
                            {{ date('Y-m-d H:i', strtotime($pago->factura->fecha)) }}
                        </td>
                        <td style="padding:10px; border-top: 1px solid #c7c7c7">
                            Cliente:  {{ $pago->factura->cliente->nombre }} - {{ $pago->factura->cliente->identificacion }}
                        </td>
                        <td class="text-right border" style="padding:10px 5px">$ {{number_format($pago->factura->total,2)}}</td>
                    </tr>
                @endif
                <tr>
                    <td style="padding:10px;border-left: 1px solid #c7c7c7">{{ $pago->metodoPago->nombre }}</td>
                    <td style="padding:10px;">{{ date('Y-m-d H:i', strtotime($pago->fecha)) }}</td>
                    <td style="padding:10px;">{{ $pago->descripcion }}</td>
                    <td class="text-right border" style="text-align:right;padding-right:5px">$ {{ number_format($pago->monto,2) }}</td>
                </tr>
                @php
                    $monto_pagado = $monto_pagado + $pago->monto;
                @endphp
                @if ($pago->factura->total - $monto_pagado <= 0)
                    <tr>
                        <td colspan="3" class="text-right" style="padding:10px 7px;border-top: 1px solid #c7c7c7">Saldo:</td>
                        <td class="text-right border" style="padding:10px 5px">$ {{number_format($pago->factura->total - $monto_pagado ,2)}}</td>
                    </tr>
                @endif

                @php
                    $aux_id = $pago->factura_id;
                @endphp
            @endforeach
        </tbody>

    </table>

</body>
</html>
