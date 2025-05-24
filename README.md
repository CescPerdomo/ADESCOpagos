# Sistema de Pagos ADESCO PHP+Laravel

Sistema de gestión de pagos desarrollado con Laravel, que incluye procesamiento de pagos, generación de recibos PDF y panel de administración.

## Requisitos del Sistema

- PHP >= 8.1
- Composer
- Node.js >= 16.x
- MySQL >= 8.0
- Git

## IDE Recomendado

Se recomienda usar Visual Studio Code con las siguientes extensiones:
- PHP Intelephense
- Laravel Blade Snippets
- Laravel Snippets
- Laravel Artisan
- DotENV
- EditorConfig
- Git Lens

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/tu-usuario/laravel-payment-system.git
cd laravel-payment-system
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node.js:
```bash
npm install
```

4. Configurar el entorno:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en el archivo `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_payment_system
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

6. Configurar PayPal en el archivo `.env`:
```
PAYPAL_CLIENT_ID=tu_client_id
PAYPAL_CLIENT_SECRET=tu_client_secret
PAYPAL_CURRENCY=USD
PAYPAL_MODE=sandbox  # Cambiar a 'live' en producción
```

7. Ejecutar las migraciones y seeders:
```bash
php artisan migrate --seed
```

## Ejecución del Proyecto

1. Compilar assets:
```bash
npm run dev
```

2. Iniciar el servidor:
```bash
php artisan serve
```

El sistema estará disponible en `http://localhost:8000`

## Características Principales

- Autenticación de usuarios
- Procesamiento de pagos con PayPal
- Generación de recibos en PDF
- Panel de administración
- Sistema completamente en español
- Validación de recibos
- Historial de transacciones

## Estructura del Proyecto

- `app/Models/`: Modelos de la aplicación (Transaction, Receipt, User)
- `app/Http/Controllers/`: Controladores
- `resources/views/`: Vistas Blade
- `database/migrations/`: Migraciones de la base de datos
- `database/seeders/`: Seeders para datos de prueba
- `lang/es/`: Archivos de traducción al español
- `config/`: Archivos de configuración

## Usuarios de Prueba

- Administrador:
  - Email: admin@adesco.org.sv
  - Contraseña: password

- Usuario Regular:
  - Email: usuario@adesco.org.sv
  - Contraseña: password

## Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ejecutar pruebas
php artisan test

# Crear un nuevo usuario
php artisan make:user

# Generar documentación API
php artisan l5-swagger:generate
```

## Mantenimiento

Para poner el sistema en modo mantenimiento:
```bash
php artisan down
```

Para volver a activar el sistema:
```bash
php artisan up
```

## Contribución

1. Fork el repositorio
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request


