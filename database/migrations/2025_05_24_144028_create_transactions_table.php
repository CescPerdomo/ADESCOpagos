<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla de transacciones
 * 
 * Esta migración crea la tabla que almacena todas las transacciones de pago.
 * 
 * Puntos de Integración:
 * 1. Campos Personalizados:
 *    - Agregar campos para nuevos métodos de pago
 *    - Implementar campos para facturación
 *    - Añadir campos de seguimiento
 *    - Incluir campos para impuestos
 * 
 * 2. Metadatos:
 *    - Extender el campo metadata para casos específicos
 *    - Agregar campos JSON adicionales
 *    - Implementar campos para auditoría
 *    - Incluir datos de geolocalización
 * 
 * 3. Estados y Flujos:
 *    - Agregar nuevos estados de transacción
 *    - Implementar flujos personalizados
 *    - Añadir campos de control de tiempo
 *    - Manejar reintentos y cancelaciones
 * 
 * 4. Optimización:
 *    - Crear índices específicos
 *    - Implementar particionamiento
 *    - Optimizar consultas frecuentes
 *    - Gestionar archivado de datos
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * 
     * Punto de Integración:
     * - Agregar nuevos campos según necesidad
     * - Implementar índices adicionales
     * - Configurar restricciones personalizadas
     */
    public function up(): void
    {
        Schema::create("transactions", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->decimal("amount", 10, 2);
            $table->string("currency", 3)->default("USD");
            $table->string("status");
            $table->string("payment_method");
            $table->json("metadata")->nullable();
            $table->timestamps();
            
            // Índices para optimizar búsquedas comunes
            $table->index(["user_id", "created_at"]);
            $table->index(["status", "created_at"]);
            $table->index("payment_method");
        });
    }

    /**
     * Revierte la migración.
     * 
     * Punto de Integración:
     * - Implementar limpieza de datos relacionados
     * - Manejar archivos adjuntos
     * - Gestionar registros de auditoría
     */
    public function down(): void
    {
        Schema::dropIfExists("transactions");
    }
};
