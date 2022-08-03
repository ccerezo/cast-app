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
    <p class="titulo text-center">INFORME DE INGRESO DESDE: {{$inicio}} - HASTA: {{$fin}}</p> <br>
    <div style="width: 100%;">
    <div style="width: 33%;float:left;border:1px solid #c7c7c7;">
        <p class="titulo text-center border-bottom">Facturado como PRODUCCIÓN</p>
        @if (count($total_metodos_vendedor) > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 60%;">Metodo Pago</th>
                    <th style="width: 40%;">Total Ingresos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total_metodos_vendedor as $item)
                    <tr>
                        <td style="text-align:center;padding:3px auto;">{{ $item->metodoPago->nombre }}</td>
                        <td style="text-align:right;padding-right:10px;">$ {{ number_format($item->total,2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No hay ingresos facturados como PRODUCCIÓN</p>
        @endif
    </div>
    <div style="width: 33%;float:left;border:1px solid #c7c7c7;margin: 0 10px">
        <p class="titulo text-center border-bottom">Facturado como <b>MAYORISTA</b></p>
        @if (count($total_metodos_mayorista) > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 60%;">Metodo Pago</th>
                        <th style="width: 40%;">Total Ingresos</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($total_metodos_mayorista as $item)
                        <tr>
                            <td style="text-align:center;padding:3px auto;">{{ $item->metodoPago->nombre }}</td>
                            <td style="text-align:right;padding-right:10px;">$ {{ number_format($item->total,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay ingresos facturados como Mayorista</p>
        @endif
    </div>
    <div style="width: 33%;float:left;border:1px solid #c7c7c7;">
    <p class="titulo text-center border-bottom">Facturado como <b>PVP</b></p>
        @if (count($total_metodos_pvp) > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 60%;">Metodo Pago</th>
                    <th style="width: 40%;">Total Ingresos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total_metodos_pvp as $item)
                    <tr>
                        <td style="text-align:center;padding:3px auto;">{{ $item->metodoPago->nombre }}</td>
                        <td style="text-align:right;padding-right:10px;">$ {{ number_format($item->total,2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No hay ingresos facturados como PVP</p>
        @endif
    </div>
    </div>
    <hr>

    <table>
        <thead>
            <tr>
                <th class="border" style="width: 20%;">Método Pago</th>
                <th class="border" style="width: 18%;">Fecha Pago</th>
                <th class="border" style="width: 33%;">Cliente</th>
                <th class="border" style="width: 10%;">Tipo</th>
                <th class="border" style="width: 9%;">N° Fac</th>
                <th class="border" style="width: 10%;">Valor</th>
            </tr>
        </thead>
        <tbody>
            @php
                //$saldo_vendedor_total = 0;
            @endphp
            @foreach ($pagos as $pago)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $pago->metodoPago->nombre }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ date('Y-m-d H:i', strtotime($pago->fecha)) }}</td>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ $pago->factura->cliente->nombre }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px">{{ $pago->factura->tipoCliente->tipo }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px">{{ $pago->factura->numero }}</td>
                    <td class="border-bottom" style="text-align:right;padding-right:3px;">$ {{ number_format($pago->monto,2) }}</td>
                </tr>
                @php
                    //$saldo_vendedor_total = $saldo_vendedor_total + $factura->total - $factura->recibido;
                @endphp
            @endforeach
        </tbody>

    </table>


</body>
</html>
