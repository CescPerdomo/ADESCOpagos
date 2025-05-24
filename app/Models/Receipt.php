<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Recibos
 * 
 * Este modelo maneja los recibos generados para cada transacción.
 * 
 * Puntos de Integración:
 * - Personalizar el formato de recibos
 * - Agregar campos adicionales para información específica
 * - Implementar nuevos métodos de generación de PDF
 * - Extender con sistemas de facturación
 * 
 * Relaciones:
 * - transaction: Relación con el modelo Transaction
 * 
 * @property int $id ID del recibo
 * @property int $transaction_id ID de la transacción relacionada
 * @property string $receipt_number Número único del recibo
 * @property string $status Estado del recibo
 * @property array $metadata Datos adicionales del recibo
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de actualización
 */
class Receipt extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        "transaction_id",
        "receipt_number",
        "status",
        "metadata"
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        "metadata" => "array"
    ];

    /**
     * Obtiene la transacción asociada al recibo.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Genera un PDF del recibo.
     * 
     * Punto de Integración:
     * Este método puede ser extendido para generar diferentes formatos
     * o estilos de recibos según las necesidades.
     * 
     * @return string Ruta al archivo PDF generado
     */
    public function generatePDF()
    {
        // Implementación de la generación del PDF
    }
}
