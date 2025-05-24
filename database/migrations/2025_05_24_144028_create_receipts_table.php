<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla de recibos
 * 
 * Esta migración crea la tabla que almacena los recibos de las transacciones.
 * 
 * Puntos de Integración:
 * 1. Campos de Facturación:
 *    - Agregar campos para información fiscal
 *    - Implementar campos para impuestos
 *    - Añadir campos para descuentos
 *    - Incluir información de envío
 * 
 * 2. Personalización:
 *    - Extender campos para formatos específicos
 *    - Agregar campos para plantillas
 *    - Implementar numeración personalizada
 *    - Incluir campos para firmas digitales
 * 
 * 3. Documentación:
 *    - Agregar campos para archivos adjuntos
 *    - Implementar control de versiones
 *    - Manejar múltiples formatos
 *    - Gestionar copias digitales
 * 
 * 4. Optimización:
 *    - Crear índices para búsquedas
 *    - Implementar particionamiento
 *    - Optimizar almacenamiento
 *    - Gestionar archivado
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * 
     * Punto de Integración:
     * - Agregar campos personalizados
     * - Implementar restricciones específicas
     * - Configurar relaciones adicionales
     */
    public function up(): void
    {
        Schema::create("receipts", function (Blueprint $table) {
            $table->id();
            $table->foreignId("transaction_id")->constrained()->onDelete("cascade");
            $table->string("receipt_number")->unique();
            $table->string("status")->default("generated");
            $table->json("metadata")->nullable();
            $table->timestamps();
            
            // Índices para optimizar búsquedas
            $table->index("receipt_number");
            $table->index(["status", "created_at"]);
        });
    }

    /**
     * Revierte la migración.
     * 
     * Punto de Integración:
     * - Implementar limpieza de archivos
     * - Manejar datos relacionados
     * - Gestionar copias de respaldo
     */
    public function down(): void
    {
        Schema::dropIfExists("receipts");
    }
};
