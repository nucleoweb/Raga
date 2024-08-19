<!DOCTYPE html>
<html>

<head>
    <title>Raga AI Email</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }
    </style>
</head>

<body>
<br>
Estimado/a [Nombre del Cliente],

Gracias por tu solicitud de cotización. Hemos revisado los detalles de tu pedido y me complace informarte que hemos encontrado la mejor opción para el transporte solicitado.
<br>
Detalles de la cotización:
<br>
<br>
@if(isset($response) && is_array($response) && count($response) > 0)
    <ul>
        @foreach($response as $item)

            <li>Origen: {{ $item['origen'] }}</li><br>
            <li>Destino: {{ $item['destino'] }}</li><br>
            <li>Tipo de Transporte: {{ $item['tipo_de_transporte'] }}</li><br>
            <li>Tarifa de Transporte Base: {{ $item['tarifa_de_transporte_base'] }}</li><br>
            <li>Tarifa USD/KG: {{ $item['tarifa_usd_kg'] ?? 'N/A' }}</li><br>
        @endforeach
    </ul>
@else
    <p>{!! nl2br(e($response)) !!}</p>
@endif
<br>
<br>
Por favor, revisa esta información y háznos saber si necesitas alguna modificación a tu solicitud o alguna información adicional.

<br>
Quedamos atentos a tu respuesta.
<br>
<br>
Raga
</body>

</html>
