<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<style type="text/css">
    body{
        font-size: 18px;
    }
    .container{
        width: auto;
        margin-top: 240px;
    }
    .titulo{
        border-bottom: 1px solid
    }
    p{
        margin: 3px 0px;
    }
    table{
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }
    table thead tr th{
        text-align:center;
        margin: 0;
    }

    .text-right{
        text-align: right;
    }
    .border {
        border: 1px solid #000000;
    }
    .page-break {
        page-break-inside:avoid;
        page-break-after: always;
    }
    </style>
<body>
    <div class="container">
        {{-- <p>Datos de Factura</p> --}}
        {{-- <p>Número: {{ $factura->numero }}</p> --}}
        <p>Fecha: {{ $factura->fecha }}</p>
        <p>Número:  {{ $factura->numero }}</p>
        <p>Cajero:  {{ $factura->user->name }}</p>
        <p>Cliente:  {{ $factura->cliente->nombre }} - {{ $factura->cliente->identificacion }}</p>
        <p>Forma de Pago:  {{ $factura->forma_pago }}</p>
        <p>Observación:  {{ $factura->observacion }}</p>
    </div>

    <table>
        <thead>
            <tr>
            <th class="border" style="width: 61%;">Descripción</th>
            <th class="border" style="width: 10%;">PVP</th>
            <th class="border" style="width: 9%;">Cant.</th>
            <th class="border" style="width: 10%;">Desc.</th>
            <th class="border" style="width: 10%;">Importe</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($facturaDetalle as $item)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{$item->producto->descripcion}} {{ ($item->descuento+0) > 0 ? ' - Desct. '.$item->descuento.'%':'' }}</td>
                    <td style="text-align:right;">
                        @if (strcmp($factura->tipoCliente->codigo, '01') === 0)
                            $ {{number_format($item->precio_produccion,2)}}
                        @else
                            @if (strcmp($factura->tipoCliente->codigo, '02') === 0)
                                $ {{number_format($item->precio_mayorista,2)}}
                            @else
                                @if (strcmp($factura->tipoCliente->codigo, '03') === 0)
                                    $ {{number_format($item->precio_venta_publico,2)}}
                                @endif
                            @endif
                        @endif
                    </td>
                    <td style="text-align:center;">{{$item->cantidad}}</td>
                    <td style="text-align:center;">
                        @if (strcmp($factura->tipoCliente->codigo, '01') === 0)
                            $ {{number_format(($item->precio_produccion * $item->cantidad) * (($item->descuento)/100),2)}}
                        @else
                            @if (strcmp($factura->tipoCliente->codigo, '02') === 0)
                                $ {{number_format(($item->precio_mayorista * $item->cantidad) * (($item->descuento)/100),2)}}
                            @else
                                @if (strcmp($factura->tipoCliente->codigo, '03') === 0)
                                    $ {{number_format(($item->precio_venta_publico * $item->cantidad) * (($item->descuento)/100),2)}}
                                @endif
                            @endif
                        @endif
                    </td>
                    <td style="text-align:right;padding-right:5px">
                        @if (strcmp($factura->tipoCliente->codigo, '01') === 0)
                            $ {{number_format(($item->precio_produccion * $item->cantidad),2)}}
                        @else
                            @if (strcmp($factura->tipoCliente->codigo, '02') === 0)
                                $ {{number_format(($item->precio_mayorista * $item->cantidad),2)}}
                            @else
                                @if (strcmp($factura->tipoCliente->codigo, '03') === 0)
                                    $ {{number_format(($item->precio_venta_publico * $item->cantidad),2)}}
                                @endif
                            @endif
                        @endif
                    </td>
                </tr>
                @if($i % 25 == 0 )
                    <tr><td colspan="5">
	        	    <div class="page-break" style="width: 100%"></div>
                    </td>
                    </tr>
	            @endif
            @endforeach
            <tr>
                <td colspan="2" style="text-align: right;border:1px solid #010101;padding-right:5px">Cantidad de zapatos</td>
                <td style="text-align: center;border:1px solid #010101">{{$cantidad_zapatos}}</td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td class="text-right border">Subtotal:</td>
                <td class="text-right border" style="padding-right:5px">${{number_format($factura->subtotal,2)}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="text-right border">IVA:</td>
                <td class="text-right border" style="padding-right:5px">${{number_format($factura->iva,2)}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="text-right border">Descuento:</td>
                <td class="text-right border" style="padding-right:5px">${{number_format($factura->descuento,2)}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="text-right border"><b>Total:</b></td>
                <td class="text-right border" style="padding:5px 5px 5px 0px"><b>$ {{number_format($factura->total,2)}}</b></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
