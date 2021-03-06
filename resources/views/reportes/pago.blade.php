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
    <div class="container">
        <p>Factura #: {{ $factura->numero }}</p>
        <p>Cliente:  {{ $factura->cliente->nombre }} - {{ $factura->cliente->identificacion }}</p>
        {{-- <p>Estado Factura:  {{ $factura->estadoFactura->nombre }}</p> --}}
    </div>

    <table>
        <thead>
            <tr>
            <th class="border-bottom" style="width: 25%;"></th>
            <th class="border-bottom" style="width: 15%;"></th>
            <th class="border-bottom" style="width: 50%;"></th>
            <th class="border-bottom" style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;padding:10px auto; border-left: 1px solid #c7c7c7">Factura #: {{ $factura->numero }}</td>
                <td style="text-align:center;padding:10px auto">{{ date('Y-m-d H:i', strtotime($factura->fecha)) }}</td>
                <td></td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($factura->total,2)}}</td>
            </tr>
            @foreach ($pagos as $pago)
                <tr>
                    <td style="text-align:center;padding:10px auto;border-left: 1px solid #c7c7c7">{{ $pago->metodoPago->nombre }}</td>
                    <td style="text-align:center;padding:10px auto">{{ date('Y-m-d H:i', strtotime($pago->fecha)) }}</td>
                    <td style="text-align:center;padding:10px auto">{{ $pago->descripcion }}</td>
                    <td class="text-right border" style="text-align:right;padding-right:5px">$ {{ number_format($pago->monto,2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right border" style="padding:10px 7px">Saldo:</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($factura->total - $total_pagos ,2)}}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
