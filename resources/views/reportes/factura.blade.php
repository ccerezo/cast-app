<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
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
        border-bottom: 1px solid
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
    <div class="container">
        <p>Datos de Factura</p>

        <p>Número: {{ $factura->numero }}</p>
        <p>Fecha: {{ $factura->fecha }}</p>
        <p>Vendedor:  {{ $factura->vendedor->nombre }}</p>
        <p>Cliente:  {{ $factura->cliente->nombre }} - {{ $factura->cliente->identificacion }}</p>
        <p>Forma de Pago:  {{ $factura->forma_pago }}</p>
    </div>

        <table>
            <thead>
              <tr>
                <th class="border-bottom" style="width: 60%;">Descripción</th>
                <th class="border-bottom" style="width: 10%;">PVP</th>
                <th class="border-bottom" style="width: 10%;">Cant.</th>
                <th class="border-bottom" style="width: 10%;">Desc.</th>
                <th class="border-bottom" style="width: 10%;">Importe</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($facturaDetalle as $item)
                    <tr>
                        <td>{{$item->producto->descripcion}} {{ ($item->descuento+0) > 0 ? ' - Desct. '.$item->descuento.'%':'' }}</td>
                        <td style="text-align:right;">$ {{number_format($item->precio_venta_publico,2)}}</td>
                        <td style="text-align:center;">{{$item->cantidad}}</td>
                        <td style="text-align:center;">$ {{number_format(($item->precio_venta_publico * $item->cantidad) * (($item->descuento)/100),2)}}</td>
                        <td style="text-align:right;padding-right:5px">$ {{number_format(($item->precio_venta_publico * $item->cantidad),2)}}</td>
                  </tr>
                @endforeach
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
                    <td class="text-right border">Total:</td>
                    <td class="text-right border" style="padding-right:5px"><b>$ {{number_format($factura->total,2)}}</b></td>
                </tr>
            </tfoot>
          </table>
    </div>

</body>
</html>
