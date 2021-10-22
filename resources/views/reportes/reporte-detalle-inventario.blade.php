<!DOCTYPE html>
<html>
<head>
    <title>Reporte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<style type="text/css">
    body{
        font-size: 11px;
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
    .page-break {
        age-break-before: always;
    }
</style>
<body>

    <p class="text-center titulo">DETALLE DE PRODUCTOS INGRESADOS</p>

    <table>
        <thead>
            <tr>
                <th class="border" style="width: 4%;">#</th>
                <th class="border" style="width: 10%;">Fecha</th>
                <th class="border" style="width: 44%;">Producto</th>
                <th class="border" style="width: 5%;">Cant.</th>
                <th class="border" style="width: 13%;">Elaborado Por</th>
                <th class="border" style="width: 8%;">P. Prod.</th>
                <th class="border" style="width: 8%;">P. May.</th>
                <th class="border" style="width: 8%;">P. PVP</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
                $total = 0;
            @endphp
            @foreach ($items as $item)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ ++$i }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ date('Y-m-d', strtotime($item->ultima_entrada)) }}</td>
                    <td class="border-bottom" style="padding:3px auto;">{{ $item->producto->descripcion }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">{{ $item->entradas }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px">{{ $item->descripcion }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">$ {{ number_format($item->producto->precio_produccion,2) }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">$ {{ number_format($item->producto->precio_mayorista,2) }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">$ {{ number_format($item->producto->precio_venta_publico,2) }}</td>
                </tr>
                @php
                    $total = $total + $item->entradas;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td class="border" style="text-align:center;">{{ number_format($total,0) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
