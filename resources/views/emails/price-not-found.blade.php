<!DOCTYPE html>
<html>

<head>
    <title>RAGA-X AI</title>
    <style>
        body {font-family: 'Arial', sans-serif;font-size: 16px;}
        html, body {margin: 0;padding: 0;}
        p {font-size: 18px;}
        ul li {margin-bottom: 10px;}
    </style>
</head>

<body>
<div style="width: 700px;margin: 0px auto;">
    <div style="background-color: #004e7d; text-align: center; padding: 10px 0px;">
        <img src="https://www.linc-ca.com/img/icon-white.da72e0d5.png" alt="" style="width: 150px">
    </div>

    <div style="padding: 20px;">
        <p>Estimado cliente,</p>
        <p>Soy Raga X, tu asistente de inteligencia artificial para cotizaciones. Me encantaría poder ayudarte con la solicitud que nos has enviado. Sin embargo, he notado que faltan algunos datos importantes para generar la cotización completa:</p>

        <ul>
            @if(!$data)
                <li style="text-transform: capitalize;">Ciudad de destino</li>
            @else
                @foreach($data as $key => $item)
                    <li style="text-transform: capitalize;">{{ $item }}</li>
                @endforeach
            @endif
        </ul>

        <div>
            <p>Quedamos atentos a sus comentarios</p>
            <p>Para consultas por favor comunicarse al (506) 7039-5587 con Nadia Corea</p>

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
