<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla de roles
 * 
 * Esta migración crea la tabla que almacena los roles del sistema.
 * 
 * Puntos de Integración:
 * 1. Campos Adicionales:
 *    - Agregar nuevos campos según necesidades
 *    - Implementar metadatos personalizados
 *    - Añadir campos para jerarquías
 *    - Incluir campos de auditoría
 * 
 * 2. Relaciones:
 *    - Extender relaciones con otras tablas
 *    - Agregar claves foráneas adicionales
 *    - Implementar relaciones polimórficas
 * 
 * 3. Índices:
 *    - Crear índices personalizados
 *    - Optimizar búsquedas específicas
 *    - Mejorar rendimiento de consultas
 * 
 * 4. Restricciones:
 *    - Agregar validaciones a nivel de BD
 *    - Implementar reglas de integridad
 *    - Definir valores por defecto
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * 
     * Punto de Integración:
     * - Agregar nuevos campos
     * - Modificar tipos de datos
     * - Implementar índices adicionales
     */
    public function up(): void
    {
        Schema::create("roles", function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("description")->nullable();
            $table->timestamps();
            
            // Índices para optimizar búsquedas
            $table->index("name");
        });
    }

    /**
     * Revierte la migración.
     * 
     * Punto de Integración:
     * - Personalizar proceso de reversión
     * - Manejar datos relacionados
     * - Implementar limpieza adicional
     */
    public function down(): void
    {
        Schema::dropIfExists("roles");
    }
};
