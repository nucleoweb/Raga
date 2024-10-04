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
        <div style="background-color: #004e7d; text-align: center; padding: 10px 0px;">
            <img src="https://www.linc-ca.com/img/icon-white.da72e0d5.png" alt="" style="width: 150px">
        </div>

        <div style="padding: 20px;">
            <p>Estimado cliente,</p>
            <p>A continuación, enviamos los detalles de la cotización solicitada: </p>

            <ul style="margin-bottom: 40px">
                <li><strong>Destino: </strong> {{ $data['data']['unlocation_id'] ?? '' }}</li>
                <li><strong>Carrier: </strong> {{ $data['data']['carrier'] ?? '' }}</li>
                <li><strong>Tipo de transporte: </strong> {{ $data['data']['tipo_transporte'] ?? '' }}</li>
                <li><strong>Contenedores 40HC: </strong> {{ $data['data']['cantidad_contenedores_40HQ'] ?? '' }}</li>
                <li><strong>Origen: </strong> {{ $data['data']['pod'] ?? '' }}</li>
                <li><strong>Contenedores 20": </strong> {{ $data['data']['cantidad_contenedores_20FT'] ?? '' }}</li>
            </ul>

            {!! $response['response'] !!}

            <div>
                <p>Quedamos atentos a sus comentarios</p>
                <p>Para consultas por favor comunicarse al (506) 7039-5587 con Nadia Corea</p>

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
