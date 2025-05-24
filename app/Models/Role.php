<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Roles
 * 
 * Este modelo gestiona los roles de usuario en el sistema.
 * 
 * Puntos de Integración:
 * - Agregar nuevos roles mediante el seeder RoleSeeder
 * - Extender con permisos específicos
 * - Implementar niveles de acceso personalizados
 * 
 * Relaciones:
 * - users: Relación muchos a muchos con el modelo User
 * 
 * @property int $id ID del rol
 * @property string $name Nombre del rol
 * @property string $description Descripción del rol
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de actualización
 */
class Role extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        "name",
        "description"
    ];

    /**
     * Obtiene los usuarios que tienen este rol.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
