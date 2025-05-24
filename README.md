# Sistema de Pagos ADESCO

Un sistema integral de gestión de pagos construido con Laravel, que incluye control de acceso basado en roles, procesamiento de pagos, generación de recibos y una interfaz moderna con soporte para modo oscuro.

## Requisitos

- PHP >= 8.1
- Composer
- Node.js >= 16.x
- MySQL >= 8.0
- Git

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/CescPerdomo/ADESCOpagos.git
cd ADESCOpagos
```

2. Instalar dependencias PHP:
```bash
composer install
```

3. Instalar dependencias JavaScript:
```bash
npm install
```

4. Configuración del entorno:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar el archivo `.env` con tus credenciales de base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

6. Ejecutar migraciones y sembrar la base de datos:
```bash
php artisan migrate
php artisan db:seed
```

7. Compilar assets:
```bash
npm run dev
```

8. Iniciar el servidor de desarrollo:
```bash
php artisan serve
```

## Puntos de Integración

### 1. Sistema de Pagos
Ubicación: `app/Http/Controllers/PaymentController.php`

Puedes integrar:
- Nuevos métodos de pago
- Pasarelas de pago adicionales
- Sistemas de facturación
- Procesadores de transacciones personalizados

Ejemplo:
```php
// Agregar nuevo método de pago
public function procesarPagoPersonalizado(Request $request)
{
    // Tu implementación aquí
}
```

### 2. Panel de Administración
Ubicación: `app/Http/Controllers/AdminController.php`

Áreas de extensión:
- Nuevos widgets para el dashboard
- Reportes personalizados
- Herramientas de análisis
- Gestión de usuarios extendida

### 3. Gestión de Usuarios
Ubicación: `app/Models/User.php`

Puntos de extensión:
- Campos de perfil adicionales
- Nuevos roles y permisos
- Integraciones con servicios externos
- Sistema de notificaciones personalizado

### 4. Interfaz de Usuario
Ubicación: `resources/views/components/`

Componentes personalizables:
- Nuevos componentes Blade
- Temas personalizados
- Layouts adicionales
- Elementos de interfaz específicos

### 5. API y Webhooks
Ubicación: `routes/api.php`

Integraciones posibles:
- Endpoints para servicios externos
- Webhooks para notificaciones
- APIs para aplicaciones móviles
- Integraciones con otros sistemas

## Estructura del Proyecto

### Directorios Principales y Sus Usos

```
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Controladores - Agregar nueva lógica de negocio
│   │   ├── Middleware/     # Middleware - Implementar nuevas validaciones
│   │   └── Requests/       # Requests - Agregar validaciones personalizadas
│   └── Models/            # Modelos - Extender funcionalidades de datos
├── database/
│   ├── migrations/        # Migraciones - Agregar nuevas tablas
│   └── seeders/          # Seeders - Datos de prueba personalizados
├── resources/
│   ├── css/              # Estilos - Personalización visual
│   ├── js/               # JavaScript - Funcionalidades frontend
│   └── views/            # Vistas - Nuevas interfaces y componentes
└── routes/
    └── web.php          # Rutas - Agregar nuevos endpoints
```

## Guías de Integración

### 1. Agregar Nuevo Método de Pago

1. Crear el controlador:
```bash
php artisan make:controller NuevoPagoController
```

2. Implementar la lógica de pago
3. Agregar rutas en `routes/web.php`
4. Crear vistas necesarias

### 2. Extender el Panel de Administración

1. Crear nuevos componentes en `resources/views/components/`
2. Agregar rutas en el grupo admin
3. Implementar lógica en AdminController
4. Actualizar permisos si es necesario

### 3. Agregar Nuevos Reportes

1. Crear nueva clase de reporte
2. Implementar lógica de generación
3. Agregar rutas de descarga
4. Integrar en el panel admin

## Mejores Prácticas

1. **Código**
   - Seguir PSR-12
   - Documentar métodos nuevos
   - Usar tipos de retorno
   - Implementar pruebas

2. **Base de Datos**
   - Usar migraciones para cambios
   - Documentar relaciones
   - Optimizar consultas
   - Mantener índices

3. **Seguridad**
   - Validar todas las entradas
   - Usar middleware de autenticación
   - Implementar CSRF
   - Sanitizar salidas

## Solución de Problemas

### Problemas Comunes

1. **Dependencias de Composer**
```bash
composer dump-autoload
```

2. **Problemas de Base de Datos**
```bash
php artisan migrate:fresh --seed
```

3. **Problemas de Caché**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Contribuir

1. Haz un fork del repositorio
2. Crea tu rama de características
3. Haz commit de tus cambios
4. Asegúrate de que las pruebas pasen
5. Abre un Pull Request

### Proceso de Pull Request

1. Actualiza tu fork
2. Crea una rama descriptiva
3. Implementa tus cambios
4. Documenta las modificaciones
5. Envía el PR

## Licencia

Este proyecto está licenciado bajo la Licencia MIT.
