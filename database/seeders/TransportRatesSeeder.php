<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['origen' => 'CR-Limon', 'destino' => 'USA-Los Ángeles', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1045, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 396, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'CR-Caldera', 'destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1850, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 397, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'CR-Puntarenas', 'destino' => 'BR-Santos', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 610, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 398, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'PA-Colón', 'destino' => 'CN-Shanghai', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 2365, 'tarifa_usd_kg' => null, 'margen_aplicado' => 18, 'id_del_envio' => 399, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'PA-Balboa', 'destino' => 'USA-Miami', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1320, 'tarifa_usd_kg' => null, 'margen_aplicado' => 18, 'id_del_envio' => 400, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'PA-Cristóbal', 'destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 5500, 'tarifa_usd_kg' => null, 'margen_aplicado' => 18, 'id_del_envio' => 401, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'GT-Santo Tomás', 'destino' => 'BR-Santos', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1595, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => 402, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'GT-Puerto Quetzal', 'destino' => 'CN-Shanghai', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 2365, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => 403, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'GT-Puerto Barrios', 'destino' => 'USA-Los Ángeles', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 912, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => 404, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'Limon', 'destino' => 'Savannha, GA Port, USA', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1012, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 405, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'CR-Caldera', 'destino' => 'USA-Miami', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1320, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 406, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'CR-Puntarenas', 'destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1815, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 407, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'PA-Colón', 'destino' => 'BR-Sao Paulo', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 6, 'tarifa_usd_kg' => null, 'margen_aplicado' => 18, 'id_del_envio' => 408, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'PA-Balboa', 'destino' => 'CN-Beijing', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 7, 'tarifa_usd_kg' => null, 'margen_aplicado' => 18, 'id_del_envio' => 409, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'PA-Cristóbal', 'destino' => 'USA-New York', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 5, 'tarifa_usd_kg' => null, 'margen_aplicado' => 18, 'id_del_envio' => 410, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'GT-Santo Tomás', 'destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 9, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => 411, 'fecha_de_vigencia' => '2024-01-01'],
            ['origen' => 'GT-Puerto Quetzal', 'destino' => 'CN-Shanghai', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 6, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => 412, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'GT-Puerto Barrios', 'destino' => 'USA-Los Ángeles', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 4, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => 413, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'SJO', 'destino' => 'USA-Miami', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 4, 'tarifa_usd_kg' => 4, 'margen_aplicado' => 15, 'id_del_envio' => 414, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'LIR', 'destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 8, 'tarifa_usd_kg' => 8, 'margen_aplicado' => 15, 'id_del_envio' => 415, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'PTY', 'destino' => 'BR-Sao Paulo', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 6, 'tarifa_usd_kg' => 6, 'margen_aplicado' => 18, 'id_del_envio' => 416, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'BLB', 'destino' => 'CN-Beijing', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 7, 'tarifa_usd_kg' => 7, 'margen_aplicado' => 18, 'id_del_envio' => 417, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'GUA', 'destino' => 'USA-New York', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 5, 'tarifa_usd_kg' => 5, 'margen_aplicado' => 20, 'id_del_envio' => 418, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'FRS', 'destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 9, 'tarifa_usd_kg' => 9, 'margen_aplicado' => 20, 'id_del_envio' => 419, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'BR', 'destino' => 'CR-Moin/Limón', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 2000, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 420, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'Aeropuerto de Panamá (PTY)', 'destino' => 'Corregimiento 24 de Diciembre, Zona Franca', 'tipo_de_transporte' => 'Terrestre', 'tarifa_de_transporte_base' => 150, 'tarifa_usd_kg' => null, 'margen_aplicado' => 18, 'id_del_envio' => 421, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['origen' => 'Guatemala', 'destino' => 'México', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 808, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Guatemala', 'destino' => 'México', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1173, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'India (Mumbai)', 'destino' => 'Guatemala', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 9708, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'India (Mumbai)', 'destino' => 'Guatemala', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 9939, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Vietnam', 'destino' => 'Costa Rica', 'tipo_de_transporte' => 'LCL', 'tarifa_de_transporte_base' => 2213, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Brasil (Guarulhos)', 'destino' => 'Guatemala', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 398, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Ningbo, China', 'destino' => 'Puerto Barrios, Guatemala', 'tipo_de_transporte' => 'LCL', 'tarifa_de_transporte_base' => 2213, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Limón, Costa Rica', 'destino' => 'Port Everglades, Miami, USA', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 3200, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Puerto Moin, Costa Rica', 'destino' => 'Packaging Santa Ana S.A., Alajuela, Costa Rica', 'tipo_de_transporte' => 'Terrestre', 'tarifa_de_transporte_base' => 450, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Guatemala', 'destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1200, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Guatemala', 'destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 1500, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Guatemala', 'destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 2500, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'Guatemala', 'destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 3500, 'tarifa_usd_kg' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['origen' => 'AR-Buenos Aires', 'destino' => 'CR-San José', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 2500, 'tarifa_usd_kg' => 0.2, 'margen_aplicado' => 15, 'id_del_envio' => 401, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['origen' => 'IN-Mumbai', 'destino' => 'PA-Ciudad de Panamá', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 4000, 'tarifa_usd_kg' => 0.25, 'margen_aplicado' => 18, 'id_del_envio' => 402, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['origen' => 'CN-Beijing', 'destino' => 'GT-Guatemala City', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 1500, 'tarifa_usd_kg' => 5, 'margen_aplicado' => 20, 'id_del_envio' => 403, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['origen' => 'USA-Los Ángeles', 'destino' => 'CR-San José', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 2000, 'tarifa_usd_kg' => 4.5, 'margen_aplicado' => 18, 'id_del_envio' => 404, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['origen' => 'CO-Bogotá', 'destino' => 'CR-San José', 'tipo_de_transporte' => 'Terrestre', 'tarifa_de_transporte_base' => 1200, 'tarifa_usd_kg' => 1, 'margen_aplicado' => 15, 'id_del_envio' => 405, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['origen' => 'Santiago de Chile', 'destino' => 'San José', 'tipo_de_transporte' => 'Marítimo', 'tarifa_de_transporte_base' => 2651, 'tarifa_usd_kg' => null, 'margen_aplicado' => 15, 'id_del_envio' => 401, 'fecha_de_vigencia' => '2024-07-01'],
            ['origen' => 'Santiago de Chile', 'destino' => 'San José', 'tipo_de_transporte' => 'Aéreo', 'tarifa_de_transporte_base' => 19000, 'tarifa_usd_kg' => 0.95, 'margen_aplicado' => 20, 'id_del_envio' => 402, 'fecha_de_vigencia' => '2024-07-01'],
        ];

        DB::table('transport_rates')->insert($data);
    }
}
