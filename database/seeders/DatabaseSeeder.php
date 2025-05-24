<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder Principal de la Base de Datos
 * 
 * Este seeder coordina la ejecución de todos los seeders del sistema.
 * 
 * Puntos de Integración:
 * 1. Nuevos Seeders:
 *    - Agregar seeders de nuevos módulos
 *    - Implementar datos de prueba
 *    - Configurar datos iniciales
 *    - Definir orden de ejecución
 * 
 * 2. Datos de Configuración:
 *    - Inicializar configuraciones del sistema
 *    - Agregar parámetros por defecto
 *    - Implementar valores predeterminados
 *    - Definir estados iniciales
 * 
 * 3. Entornos:
 *    - Configurar datos por ambiente
 *    - Implementar perfiles de datos
 *    - Manejar datos de desarrollo
 *    - Gestionar datos de prueba
 * 
 * 4. Relaciones:
 *    - Mantener integridad referencial
 *    - Gestionar dependencias entre datos
 *    - Implementar relaciones complejas
 *    - Coordinar seeders relacionados
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta los seeders de la base de datos.
     * 
     * Punto de Integración:
     * - Agregar nuevos seeders
     * - Configurar orden de ejecución
     * - Implementar lógica condicional
     */
    public function run(): void
    {
        // Roles y Permisos
        $this->call([
            RoleSeeder::class,
            // Punto de integración: Agregar más seeders
        ]);

        // Datos de prueba solo en desarrollo
        if (app()->environment("local", "development")) {
            // Punto de integración: Agregar seeders de prueba
        }
    }
}
