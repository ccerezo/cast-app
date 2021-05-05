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

    <p class="titulo text-center">LO MÁS VENDIDO</p>

    <table>
        <thead>
            <tr>
                <th class="border" style="width: 5%;">#</th>
                <th class="border" style="width: 10%;">Cantidad</th>
                <th class="border" style="width: 15%;">Código</th>
                <th class="border" style="width: 70%;">Descripción</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp

            @foreach ($productos as $detalle)
                <tr>
                    <td class="border-bottom" style="text-align:center;padding:3px auto;">{{ ++$i }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">{{ $detalle->cantidad }}</td>
                    <td class="border-bottom" style="text-align:center;padding-right:3px;">{{ $detalle->producto->codigo }}</td>
                    <td class="border-bottom" style="text-align:left;padding-left:3px;">{{ $detalle->producto->descripcion }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
