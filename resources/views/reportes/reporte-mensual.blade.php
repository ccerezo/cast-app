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
    <p class="text-center titulo">Reporte Mensual, {{ \Carbon\Carbon::parse("".$vendido->anio."-".$vendido->mes."")->locale('es_ES')->monthName }} - {{$vendido->anio}} </p>
    <p class="titulo text-center">Total de ventas del mes: <br>$ {{$vendido->vendido}}</p>

    <table>
        <thead>
            <tr>
                <th class="border" style="width: 10%;">Fact. #</th>
                <th class="border" style="width: 20%;">Fecha</th>
                <th class="border" style="width: 50%;">Cliente</th>
                <th class="border" style="width: 10%;">Valor</th>
                <th class="border" style="width: 10%;">Saldo</th>
            </tr>
        </thead>
        <tbody>
            {{-- <tr>
                <td style="text-align:center;padding:10px auto; border-left: 1px solid #c7c7c7">Factura #: {{ $factura->numero }}</td>
                <td style="text-align:center;padding:10px auto">{{ date('Y-m-d H:i', strtotime($factura->fecha)) }}</td>
                <td></td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($factura->total,2)}}</td>
            </tr> --}}
            @foreach ($facturas as $factura)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:5px auto;">{{ $factura->numero }}</td>
                    <td class="border-bottom"style="text-align:center;padding:5px auto;">{{ date('Y-m-d H:i', strtotime($factura->fecha)) }}</td>
                    <td class="border-bottom"style="text-align:center;padding:5px auto;">{{ $factura->cliente->nombre }}</td>
                    <td class="border-bottom" class="text-right" style="text-align:right;padding-right:5px">$ {{ number_format($factura->total,2) }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:5px;">$ {{ number_format($factura->total - $factura->recibido,2) }}</td>
                </tr>
            @endforeach
        </tbody>
        {{-- <tfoot>
            <tr>
                <td colspan="3" class="text-right border" style="padding:10px 7px">Saldo:</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($factura->total - $total_pagos ,2)}}</td>
            </tr>
        </tfoot> --}}
    </table>

</body>
</html>
