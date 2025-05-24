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

## Estructura del Proyecto

### Directorios Principales

```
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Controladores de la aplicación
│   │   ├── Middleware/     # Middleware personalizado
│   │   └── Requests/       # Solicitudes de formularios y validación
│   └── Models/            # Modelos Eloquent
├── database/
│   ├── migrations/        # Migraciones de base de datos
│   └── seeders/          # Sembradores de base de datos
├── resources/
│   ├── css/              # Hojas de estilo
│   ├── js/               # Archivos JavaScript
│   └── views/            # Plantillas Blade
│       ├── admin/        # Vistas del panel de administración
│       ├── components/   # Componentes UI reutilizables
│       └── layouts/      # Plantillas de diseño
└── routes/
    └── web.php          # Rutas web
```

### Características Principales

1. **Sistema de Autenticación**
   - Registro y inicio de sesión de usuarios
   - Funcionalidad de restablecimiento de contraseña
   - Verificación de correo electrónico

2. **Control de Acceso Basado en Roles**
   - Roles de Administrador y Usuario
   - Rutas protegidas y middleware
   - Paneles específicos por rol

3. **Gestión de Pagos**
   - Procesamiento de pagos
   - Historial de transacciones
   - Generación de recibos (PDF)

4. **Componentes de UI**
   - Diseño moderno y responsivo
   - Soporte para modo oscuro
   - Componentes Blade reutilizables:
     - Formularios y campos
     - Botones
     - Tarjetas
     - Modales
     - Tablas
     - Alertas
     - Insignias
     - Indicadores de carga

## Rutas Disponibles

- `/` - Página de bienvenida
- `/login` - Inicio de sesión
- `/register` - Registro de usuario
- `/dashboard` - Panel de usuario
- `/admin/dashboard` - Panel de administrador
- `/profile` - Gestión de perfil

## Esquema de Base de Datos

### Tabla Users (Usuarios)
- id (clave primaria)
- name (nombre)
- email (correo)
- password (contraseña)
- created_at
- updated_at

### Tabla Roles
- id (clave primaria)
- name (nombre)
- created_at
- updated_at

### Tabla Transactions (Transacciones)
- id (clave primaria)
- user_id (clave foránea)
- amount (monto)
- description (descripción)
- status (estado)
- created_at
- updated_at

### Tabla Receipts (Recibos)
- id (clave primaria)
- transaction_id (clave foránea)
- receipt_number (número de recibo)
- created_at
- updated_at

## Seguridad

- Protección CSRF habilitada
- Prevención de inyección SQL
- Protección XSS
- Hash seguro de contraseñas
- Limitación de tasa en rutas de autenticación

## Desarrollo

### Agregar Nuevas Funcionalidades

1. Crear migraciones necesarias:
```bash
php artisan make:migration crear_nombre_de_tu_tabla
```

2. Crear modelos:
```bash
php artisan make:model TuModelo
```

3. Crear controladores:
```bash
php artisan make:controller TuControlador
```

### Ejecutar Pruebas

```bash
php artisan test
```

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
2. Crea tu rama de características (`git checkout -b feature/caracteristica-asombrosa`)
3. Haz commit de tus cambios (`git commit -m 'Agregar alguna característica asombrosa'`)
4. Haz push a la rama (`git push origin feature/caracteristica-asombrosa`)
5. Abre un Pull Request

## Licencia

Este proyecto está licenciado bajo la Licencia MIT.
