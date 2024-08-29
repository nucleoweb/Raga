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
            ['puerto_origen' => 'CR-Limon', 'ciudad_destino' => 'USA-Los Ángeles', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1045, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 396, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'CR-Caldera', 'ciudad_destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1850, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 397, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'CR-Puntarenas', 'ciudad_destino' => 'BR-Santos', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 610, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 398, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'PA-Colón', 'ciudad_destino' => 'CN-Shanghai', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 2365, 'transport_fee' => null, 'margen_aplicado' => 18, 'id_del_envio' => 399, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'PA-Balboa', 'ciudad_destino' => 'USA-Miami', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1320, 'transport_fee' => null, 'margen_aplicado' => 18, 'id_del_envio' => 400, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'PA-Cristóbal', 'ciudad_destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 5500, 'transport_fee' => null, 'margen_aplicado' => 18, 'id_del_envio' => 401, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'GT-Santo Tomás', 'ciudad_destino' => 'BR-Santos', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1595, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => 402, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'GT-Puerto Quetzal', 'ciudad_destino' => 'CN-Shanghai', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 2365, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => 403, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'GT-Puerto Barrios', 'ciudad_destino' => 'USA-Los Ángeles', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 912, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => 404, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'Limon', 'ciudad_destino' => 'Savannha, GA Port, USA', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1012, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 405, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'CR-Caldera', 'ciudad_destino' => 'USA-Miami', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1320, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 406, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'CR-Puntarenas', 'ciudad_destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1815, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 407, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'PA-Colón', 'ciudad_destino' => 'BR-Sao Paulo', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 6, 'transport_fee' => null, 'margen_aplicado' => 18, 'id_del_envio' => 408, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'PA-Balboa', 'ciudad_destino' => 'CN-Beijing', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 7, 'transport_fee' => null, 'margen_aplicado' => 18, 'id_del_envio' => 409, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'PA-Cristóbal', 'ciudad_destino' => 'USA-New York', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 5, 'transport_fee' => null, 'margen_aplicado' => 18, 'id_del_envio' => 410, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'GT-Santo Tomás', 'ciudad_destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 9, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => 411, 'fecha_de_vigencia' => '2024-01-01'],
            ['puerto_origen' => 'GT-Puerto Quetzal', 'ciudad_destino' => 'CN-Shanghai', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 6, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => 412, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'GT-Puerto Barrios', 'ciudad_destino' => 'USA-Los Ángeles', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 4, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => 413, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'SJO', 'ciudad_destino' => 'USA-Miami', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 4, 'transport_fee' => 4, 'margen_aplicado' => 15, 'id_del_envio' => 414, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'LIR', 'ciudad_destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 8, 'transport_fee' => 8, 'margen_aplicado' => 15, 'id_del_envio' => 415, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'PTY', 'ciudad_destino' => 'BR-Sao Paulo', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 6, 'transport_fee' => 6, 'margen_aplicado' => 18, 'id_del_envio' => 416, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'BLB', 'ciudad_destino' => 'CN-Beijing', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 7, 'transport_fee' => 7, 'margen_aplicado' => 18, 'id_del_envio' => 417, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'GUA', 'ciudad_destino' => 'USA-New York', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 5, 'transport_fee' => 5, 'margen_aplicado' => 20, 'id_del_envio' => 418, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'FRS', 'ciudad_destino' => 'IN-Mumbai', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 9, 'transport_fee' => 9, 'margen_aplicado' => 20, 'id_del_envio' => 419, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'BR', 'ciudad_destino' => 'CR-Moin/Limón', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 2000, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 420, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'Aeropuerto de Panamá (PTY)', 'ciudad_destino' => 'Corregimiento 24 de Diciembre, Zona Franca', 'tipo_de_transporte' => 'Terrestre', 'port_fee' => 150, 'transport_fee' => null, 'margen_aplicado' => 18, 'id_del_envio' => 421, 'fecha_de_vigencia' => '2024-01-01 00:00:00'],
            ['puerto_origen' => 'Guatemala', 'ciudad_destino' => 'México', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 808, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Guatemala', 'ciudad_destino' => 'México', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1173, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'India (Mumbai)', 'ciudad_destino' => 'Guatemala', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 9708, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'India (Mumbai)', 'ciudad_destino' => 'Guatemala', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 9939, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Vietnam', 'ciudad_destino' => 'Costa Rica', 'tipo_de_transporte' => 'LCL', 'port_fee' => 2213, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Brasil (Guarulhos)', 'ciudad_destino' => 'Guatemala', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 398, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Ningbo, China', 'ciudad_destino' => 'Puerto Barrios, Guatemala', 'tipo_de_transporte' => 'LCL', 'port_fee' => 2213, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Limón, Costa Rica', 'ciudad_destino' => 'Port Everglades, Miami, USA', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 3200, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Puerto Moin, Costa Rica', 'ciudad_destino' => 'Packaging Santa Ana S.A., Alajuela, Costa Rica', 'tipo_de_transporte' => 'Terrestre', 'port_fee' => 450, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Guatemala', 'ciudad_destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1200, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Guatemala', 'ciudad_destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 1500, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Guatemala', 'ciudad_destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 2500, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'Guatemala', 'ciudad_destino' => 'Caucedo, República Dominicana', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 3500, 'transport_fee' => null, 'margen_aplicado' => 20, 'id_del_envio' => null, 'fecha_de_vigencia' => '2024-07-16 00:00:00'],
            ['puerto_origen' => 'AR-Buenos Aires', 'ciudad_destino' => 'CR-San José', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 2500, 'transport_fee' => 0.2, 'margen_aplicado' => 15, 'id_del_envio' => 401, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['puerto_origen' => 'IN-Mumbai', 'ciudad_destino' => 'PA-Ciudad de Panamá', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 4000, 'transport_fee' => 0.25, 'margen_aplicado' => 18, 'id_del_envio' => 402, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['puerto_origen' => 'CN-Beijing', 'ciudad_destino' => 'GT-Guatemala City', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 1500, 'transport_fee' => 5, 'margen_aplicado' => 20, 'id_del_envio' => 403, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['puerto_origen' => 'USA-Los Ángeles', 'ciudad_destino' => 'CR-San José', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 2000, 'transport_fee' => 4.5, 'margen_aplicado' => 18, 'id_del_envio' => 404, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['puerto_origen' => 'CO-Bogotá', 'ciudad_destino' => 'CR-San José', 'tipo_de_transporte' => 'Terrestre', 'port_fee' => 1200, 'transport_fee' => 1, 'margen_aplicado' => 15, 'id_del_envio' => 405, 'fecha_de_vigencia' => '2024-07-17 00:00:00'],
            ['puerto_origen' => 'Santiago de Chile', 'ciudad_destino' => 'San José', 'tipo_de_transporte' => 'Marítimo', 'port_fee' => 2651, 'transport_fee' => null, 'margen_aplicado' => 15, 'id_del_envio' => 401, 'fecha_de_vigencia' => '2024-07-01'],
            ['puerto_origen' => 'Santiago de Chile', 'ciudad_destino' => 'San José', 'tipo_de_transporte' => 'Aéreo', 'port_fee' => 19000, 'transport_fee' => 0.95, 'margen_aplicado' => 20, 'id_del_envio' => 402, 'fecha_de_vigencia' => '2024-07-01'],
        ];

        DB::table('transport_rates')->insert($data);
    }
}
