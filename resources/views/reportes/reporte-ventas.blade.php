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
    <table>
        <thead>
            <tr>
            <th class="border-bottom" style="width: 25%;">Método de Pago</th>
            <th class="border-bottom" style="width: 15%;">Fecha</th>
            <th class="border-bottom" style="width: 50%;">Descripción</th>
            <th class="border-bottom" style="width: 10%;">Monto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;padding:10px auto">{{ $pago->metodoPago->nombre }}</td>
                <td style="text-align:center;padding:10px auto">{{ date('Y-m-d H:i', strtotime($pago->fecha)) }}</td>
                <td style="text-align:center;padding:10px auto">{{ $pago->descripcion }}</td>
                <td style="text-align:right;padding-right:5px">$ {{ number_format($pago->monto,2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right border" style="padding:10px 5px">Saldo:</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($factura->total - $total_pagos - $pago->monto,2)}}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
