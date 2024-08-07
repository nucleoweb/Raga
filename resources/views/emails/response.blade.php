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
Estimado cliente, adjunto cotización en base a su requerimiento.
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
            <li>Margen Aplicado: {{ $item['margen_aplicado'] }}</li><br>
        @endforeach
    </ul>
@else
    <p>No data available.</p>
@endif
<br>
<br>
Saludos cordiales,
<br>
<br>
Raga AI
</body>

</html>
