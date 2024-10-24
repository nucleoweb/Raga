<!DOCTYPE html>
<html>

<head>
    <title>RAGA-X AI</title>
    <style>
        body {font-family: 'Arial', sans-serif;font-size: 16px;}
        html, body {margin: 0;padding: 0;}
        p {font-size: 18px;}
        ul li {margin-bottom: 10px;}
        table {
            width: 100%;
            border: 1px solid #E0E5FF;
            background-color: white;
            color: #2E2E2E;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #F2F4F8;
        }
    </style>
</head>

<body>
    <div style="width: 700px;margin: 0px auto;">
        <div style="background-color: #002060; text-align: center; padding: 10px 0px;">
            <img src="https://www.linc-ca.com/img/icon-white.da72e0d5.png" alt="" style="width: 150px">
        </div>

        <div style="padding: 20px;">
            <p>Estimado cliente,</p>
            <p>A continuación, enviamos los detalles de la cotización solicitada: </p>

            <ul style="margin-bottom: 40px">
                <li><strong>Fecha de emisión:  </strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</li>
                <li><strong>Fecha de vigencia: </strong> {{ \Carbon\Carbon::now()->addDays(7)->format('d-m-Y') }}</li>
                <li><strong>Dirección de entrega: </strong> {{ $data['data']['unlocation_id'] ?? '' }}</li>
                <li><strong>Tipo de servicio: </strong> {{ $data['data']['tipo_transporte'] ?? '' }}</li>
                <li><strong>Peso de la carga: </li>
                <ul>
                    <li><strong>Contenedores 40": </strong> {{ $data['data']['cantidad_contenedores_40HC'] ?? 0 }}</li>
                    <li><strong>Contenedores 20": </strong> {{ $data['data']['cantidad_contenedores_20FT'] ?? 0 }}</li>
                </ul>
                <li><strong>Naviera: </strong> {{ $data['data']['carrier'] ?? '' }}</li>
            </ul>

            {!! $response['response'] !!}

            <div>
                <p>Quedamos atentos a sus comentarios</p>
                <p>Para consultas por favor comunicarse al (506) 7039-5587 con Nadia Corea</p>

                <small style="margin-top: 10px;margin-bottom: 10px;">Notas</small>

                <ul style="margin-bottom: 50px">
                    <li>
                        <small>Aplica el 13% de iva a los productos operador en Costa Rica</small>
                    </li>
                    <li>
                        <small>Carga con destino a Zona Franca aplica USD 120 por Documento único aduanero.</small>
                    </li>
                    <li>
                        <small>Carga con destino a Almacén fiscal aplica USD 120 por marchamo electrónico.</small>
                    </li>
                    <li>
                        <small>Recargo por sobrepeso aplica a partir de 21,5 TON</small>
                    </li>
                    <li>
                        <small>Si el HBL es collect en Costa Rica, aplica Collect Fee de 3%, mínimo USD 50.</small>
                    </li>
                    <li>
                        <a href="#">
                            <small>Ver Términos y condiciones</small>
                        </a>
                    </li>
                </ul>

                <p>Saludos cordiales, <br>
                    Grupo Linc <br>
                    Tus asesores logísticos</p>
                <br>
                <br>

                <p style="text-align: center">
                    <img src="https://i.imgur.com/wSgtqz9.jpeg" alt="">
                </p>
            </div>
        </div>
    </div>
</body>
</html>
