<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla pivote role_user
 * 
 * Esta migración crea la tabla que gestiona la relación muchos a muchos
 * entre usuarios y roles.
 * 
 * Puntos de Integración:
 * 1. Campos Adicionales:
 *    - Agregar campos de asignación temporal
 *    - Implementar campos de auditoría
 *    - Añadir campos de restricciones
 *    - Incluir campos de permisos específicos
 * 
 * 2. Control de Acceso:
 *    - Extender con niveles de acceso
 *    - Agregar restricciones por departamento
 *    - Implementar jerarquías de roles
 *    - Gestionar herencia de permisos
 * 
 * 3. Auditoría:
 *    - Registrar cambios de roles
 *    - Implementar historial de asignaciones
 *    - Manejar eventos de cambios
 *    - Documentar modificaciones
 * 
 * 4. Optimización:
 *    - Crear índices compuestos
 *    - Implementar caché de roles
 *    - Optimizar consultas frecuentes
 *    - Gestionar permisos en memoria
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * 
     * Punto de Integración:
     * - Agregar campos de control
     * - Implementar triggers
     * - Configurar restricciones
     */
    public function up(): void
    {
        Schema::create("role_user", function (Blueprint $table) {
            $table->id();
            $table->foreignId("role_id")->constrained()->onDelete("cascade");
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->json("metadata")->nullable();
            $table->timestamps();

            // Índices y restricciones
            $table->unique(["role_id", "user_id"]);
            $table->index(["user_id", "role_id"]);
        });
    }

    /**
     * Revierte la migración.
     * 
     * Punto de Integración:
     * - Limpiar datos relacionados
     * - Manejar caché de roles
     * - Gestionar permisos asociados
     */
    public function down(): void
    {
        Schema::dropIfExists("role_user");
    }
};
