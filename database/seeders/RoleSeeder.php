<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Seeder de Roles
 * 
 * Este seeder inicializa los roles básicos del sistema.
 * 
 * Puntos de Integración:
 * 1. Roles Adicionales:
 *    - Agregar nuevos roles según necesidad
 *    - Implementar jerarquías de roles
 *    - Definir permisos por defecto
 *    - Configurar restricciones iniciales
 * 
 * 2. Personalización:
 *    - Extender descripciones de roles
 *    - Agregar metadatos específicos
 *    - Implementar configuraciones por rol
 *    - Definir ámbitos de acceso
 * 
 * 3. Datos de Prueba:
 *    - Crear roles para testing
 *    - Implementar escenarios de prueba
 *    - Generar datos de ejemplo
 *    - Configurar entornos de desarrollo
 * 
 * 4. Integración con Módulos:
 *    - Vincular con nuevos módulos
 *    - Configurar permisos específicos
 *    - Implementar roles especializados
 *    - Definir accesos por módulo
 */
class RoleSeeder extends Seeder
{
    /**
     * Ejecuta el seeder.
     * 
     * Punto de Integración:
     * - Agregar nuevos roles
     * - Configurar permisos iniciales
     * - Implementar relaciones por defecto
     */
    public function run(): void
    {
        // Roles básicos del sistema
        $roles = [
            [
                "name" => "admin",
                "description" => "Administrador del sistema con acceso total"
            ],
            [
                "name" => "user",
                "description" => "Usuario regular con acceso básico"
            ],
            // Punto de integración: Agregar más roles según necesidad
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
