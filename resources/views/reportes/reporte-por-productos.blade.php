<!DOCTYPE html>
<html>
<head>
    <title>Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<style type="text/css">
    body{
        font-size: 12px;
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

    <p class="titulo text-center">DETALLE DE PRODUCTOS VENDIDOS</p>

    <table>
        <thead>
            <tr>
                <th class="border" style="width: 4%;">#</th>
                <th class="border" style="width: 10%;">Fecha</th>
                <th class="border" style="width: 20%;">Cliente</th>
                <th class="border" style="width: 43%;">Producto</th>
                <th class="border" style="width: 9%;">Tipo</th>
                <th class="border" style="width: 6%;">Cant.</th>
                <th class="border" style="width: 8%;">Precio</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($productos as $factura)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ ++$i }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ date('Y-m-d', strtotime($factura->fecha)) }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $factura->cliente->nombre }}</td>
                    <td class="border-bottom" style="text-align:left;padding-right:3px">{{ $factura->descripcion }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">{{ $factura->tipoCliente->tipo }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">{{ $factura->cantidad }}</td>
                    @if ($factura->tipoCliente->codigo == '01')
                        <td class="border-bottom" style="text-align:center;padding-right:3px;">$ {{ number_format($factura->precio_produccion,2) }}</td>
                    @else
                        @if ($factura->tipoCliente->codigo == '02')
                            <td class="border-bottom" style="text-align:center;padding-right:3px;">$ {{ number_format($factura->precio_mayorista,2) }}</td>
                        @else
                            <td class="border-bottom" style="text-align:center;padding-right:3px;">$ {{ number_format($factura->precio_venta_publico,2) }}</td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
