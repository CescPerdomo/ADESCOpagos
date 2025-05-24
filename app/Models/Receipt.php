<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use PDF;

/**
 * Modelo de Recibos
 * 
 * Este modelo maneja los recibos generados para cada transacción.
 * 
 * @property int $id ID del recibo
 * @property int $transaction_id ID de la transacción asociada
 * @property string $receipt_number Número único del recibo
 * @property string $status Estado del recibo (generated, error)
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación con la transacción
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Genera el PDF del recibo y lo guarda en el almacenamiento.
     * 
     * Este método:
     * - Carga los datos necesarios de la transacción y el usuario
     * - Genera el PDF usando una plantilla blade
     * - Guarda el archivo en el sistema de almacenamiento
     * - Actualiza el estado y metadata del recibo
     * 
     * @return bool Verdadero si se generó correctamente, falso en caso de error
     */
    public function generatePDF(): bool
    {
        try {
            // Cargar datos necesarios para el PDF
            $this->load("transaction.user");

            // Generar el PDF usando la vista
            $pdf = PDF::loadView("pdf.receipt", [
                "receipt" => $this,
                "transaction" => $this->transaction,
                "user" => $this->transaction->user
            ]);

            // Guardar el PDF
            $pdfPath = "receipts/{$this->receipt_number}.pdf";
            Storage::put($pdfPath, $pdf->output());

            // Actualizar el estado del recibo
            $this->update([
                "status" => "generated",
                "metadata" => array_merge($this->metadata ?? [], [
                    "pdf_generated_at" => now()->toDateTimeString(),
                    "pdf_path" => $pdfPath
                ])
            ]);

            return true;

        } catch (\Exception $e) {
            \Log::error("Error generando PDF para recibo {$this->receipt_number}: " . $e->getMessage());
            
            // Actualizar el estado del recibo
            $this->update([
                "status" => "error",
                "metadata" => array_merge($this->metadata ?? [], [
                    "pdf_error" => $e->getMessage(),
                    "pdf_error_at" => now()->toDateTimeString()
                ])
            ]);

            return false;
        }
    }
}
