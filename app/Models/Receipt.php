<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use PDF;

class Receipt extends Model
{
    protected $fillable = [
        "transaction_id",
        "receipt_number",
        "status",
        "metadata"
    ];

    protected $casts = [
        "metadata" => "array"
    ];

    /**
     * Obtiene la transacción asociada al recibo.
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Genera el PDF del recibo.
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
