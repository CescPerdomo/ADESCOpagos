<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Transacciones
 * 
 * Este modelo maneja todas las transacciones de pago en el sistema.
 * 
 * Puntos de Integración:
 * - Agregar nuevos métodos de pago
 * - Implementar procesadores de pago adicionales
 * - Extender con sistemas de facturación
 * - Agregar validaciones personalizadas
 * - Implementar webhooks para notificaciones
 * 
 * Relaciones:
 * - user: Relación con el modelo User
 * - receipt: Relación con el modelo Receipt
 * 
 * @property int $id ID de la transacción
 * @property int $user_id ID del usuario que realizó la transacción
 * @property float $amount Monto de la transacción
 * @property string $currency Moneda de la transacción
 * @property string $status Estado de la transacción
 * @property string $payment_method Método de pago utilizado
 * @property array $metadata Datos adicionales de la transacción
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de actualización
 */
class Transaction extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        "user_id",
        "amount",
        "currency",
        "status",
        "payment_method",
        "metadata"
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        "amount" => "float",
        "metadata" => "array"
    ];

    /**
     * Obtiene el usuario que realizó la transacción.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el recibo asociado a la transacción.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    /**
     * Procesa el pago de la transacción.
     * 
     * Punto de Integración:
     * Este método puede ser extendido para soportar diferentes
     * pasarelas de pago y métodos de procesamiento.
     * 
     * @param array $paymentDetails Detalles del pago
     * @return bool
     */
    public function processPayment(array $paymentDetails)
    {
        // Implementación del procesamiento de pago
    }

    /**
     * Genera el recibo después de una transacción exitosa.
     * 
     * Punto de Integración:
     * Personalizar la generación de recibos según necesidades específicas.
     * 
     * @return Receipt
     */
    public function generateReceipt()
    {
        // Implementación de la generación de recibo
    }
}
