<!DOCTYPE html>
<html>
<head>
    <title>Reporte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<style>
    body{ font-size: 0.90 rem }
    .container{ width: 100%; margin: 0 auto }
    .w-10{ width: 10%;display:inline-block;float:left }
    .w-20{ width: 20%;display:inline-block;float:left }
    .w-25{ width: 25%;display:inline-block;float:left }
    .w-50{ width: 50%;display:inline-block;float:left }
    .w-60{ width: 60%;display:inline-block;float:left }
    .w-75{ width: 75%;display:inline-block;float:left }
    .w-80{ width: 80%;display:inline-block;float:left }
    .w-full{ width: 100%;display:inline-block;float:left }
    .text-right{ text-align: right;}
    .text-center{ text-align: center;}
    .text-white{ color: #ffffff; }
    .text-blue-600{ color: #1f82c8;}
    .text-red-600{ color: #c81f6e;}
    .text-bold{ font-weight: bold }
    .text-xs{ font-size: 0.75 rem }
    .text-md{ font-size: 1 rem }
    .text-justify { text-align: justify }
    .text-capitalize { text-transform: capitalize; }
    .uppercase{ text-transform: uppercase;}
    .border-blue{border: 1px solid #1f82c8;}
    .border-t-blue{border-top: 1px solid #1f82c8;}
    .relative { position: relative; }
    .absolute { position: absolute; }
    .t-150 { top: 150px; }
    .m-0{ margin: 0}
    .ml-10{ margin-left: 10px}
    .mt-20{ margin-top: 20px}
    .pl-10{ padding-left: 10px}
    .px-10{ padding-left: 10px; padding-right: 10px;}
    .py-10{ padding-top: 10px; padding-bottom: 10px;}
    .clear{ clear: both; margin: 0 }
    .table{ border-collapse: collapse; }
    .page-break { page-break-after: always; }
    #footer, #footer-1{ position:fixed; right: 0; bottom: 0;text-align: right; border-top: 0.1pt solid #aaa;}
    .page{ counter-reset: page; }
    .page-number:after {content: "Pág " counter(page)}
</style>
<body>
    <p class="text-center text-md">REPORTE GENERAL INVENTARIO</p>
    <br>
    <table class="container">
        <thead>
            <tr>
                <th class="border-blue">PRODUCTOS REGISTRADOS</th>
                <th class="border-blue">PRODUCTOS EN STOCK</th>
                <th class="border-blue">PRECIO PRODUCCION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center border-blue text-md">
                    {{$productos_registrados}} <br>
                    <span class="text-xs">Items registrados dentro del sistema</span>
                </td>
                <td class="text-center border-blue text-md">
                    {{$productos_en_stock}} <br>
                    <span class="text-xs">Total de pares de zapatos en stock</span>
                </td>
                <td class="text-center border-blue text-md">
                    $ {{number_format($precio_produccion[0],2)}}<br>
                    <span class="text-xs">Valor calculado del total de los items en stock</span>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
