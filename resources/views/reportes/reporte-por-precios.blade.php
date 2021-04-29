<!DOCTYPE html>
<html>
<head>
    <title>Reporte</title>
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
    hr {
        page-break-after: always;
        border: 0;
        margin: 0;
        padding: 0;
        color: #ffffff;
        background: #ffffff;
    }

</style>
<body>

    <p class="titulo text-center">Ventas a Precio de Producción</p>

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
            @php
                $saldo_vendedor_total = 0;
            @endphp
            @foreach ($vendedor as $factura)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $factura->numero }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ date('Y-m-d H:i', strtotime($factura->fecha)) }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $factura->cliente->nombre }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px">$ {{ number_format($factura->total,2) }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px;">$ {{ number_format($factura->total - $factura->recibido,2) }}</td>
                </tr>
                @php
                    $saldo_vendedor_total = $saldo_vendedor_total + $factura->total - $factura->recibido;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right border" style="padding:10px 7px">Total:</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($vendedor_total ,2)}}</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($saldo_vendedor_total ,2)}}</td>
            </tr>
        </tfoot>
    </table>

    <hr>

    <p class="titulo text-center">Ventas a Precio de Mayorista</p>

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
            @php
                $saldo_mayorista_total = 0;
            @endphp
            @foreach ($mayorista as $factura)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $factura->numero }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ date('Y-m-d H:i', strtotime($factura->fecha)) }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $factura->cliente->nombre }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px">$ {{ number_format($factura->total,2) }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px;">$ {{ number_format($factura->total - $factura->recibido,2) }}</td>
                </tr>
                @php
                    $saldo_mayorista_total = $saldo_mayorista_total + $factura->total - $factura->recibido;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right border" style="padding:10px 7px">Total:</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($mayorista_total ,2)}}</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($saldo_mayorista_total ,2)}}</td>
            </tr>
        </tfoot>
    </table>

    <hr>

    <p class="titulo text-center">Ventas a Precio de Venta al Público</p>

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
            @php
                $saldo_final_total = 0;
            @endphp
            @foreach ($final as $factura)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $factura->numero }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ date('Y-m-d H:i', strtotime($factura->fecha)) }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $factura->cliente->nombre }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px">$ {{ number_format($factura->total,2) }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px;">$ {{ number_format($factura->total - $factura->recibido,2) }}</td>
                </tr>
                @php
                    $saldo_final_total = $saldo_final_total + $factura->total - $factura->recibido;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right border" style="padding:10px 7px">Total:</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($final_total ,2)}}</td>
                <td class="text-right border" style="padding:10px 5px">$ {{number_format($saldo_final_total ,2)}}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
