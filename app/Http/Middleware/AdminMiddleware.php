<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware de Administración
 * 
 * Este middleware controla el acceso a las rutas administrativas,
 * verificando que el usuario tenga los permisos necesarios.
 * 
 * Puntos de Integración:
 * 1. Control de Acceso:
 *    - Implementar validaciones adicionales
 *    - Agregar verificación de permisos específicos
 *    - Integrar con sistemas de autenticación externos
 *    - Personalizar reglas de acceso
 * 
 * 2. Auditoría:
 *    - Registrar intentos de acceso
 *    - Implementar sistema de logs
 *    - Monitorear actividades sospechosas
 *    - Generar alertas de seguridad
 * 
 * 3. Personalización:
 *    - Agregar redirecciones personalizadas
 *    - Implementar mensajes específicos
 *    - Configurar respuestas por tipo de usuario
 *    - Manejar excepciones particulares
 * 
 * 4. Integración con Servicios:
 *    - Conectar con servicios de autenticación
 *    - Validar tokens externos
 *    - Verificar roles en sistemas terceros
 *    - Implementar Single Sign-On (SSO)
 */
class AdminMiddleware
{
    /**
     * Maneja la solicitud entrante.
     * 
     * Punto de Integración:
     * Este método puede ser extendido para agregar:
     * - Validaciones adicionales de seguridad
     * - Verificación de permisos específicos
     * - Logging de accesos
     * - Integración con servicios externos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->hasRole("admin")) {
            return redirect("/dashboard")->with("error", "Acceso no autorizado.");
        }

        return $next($request);
    }
}
