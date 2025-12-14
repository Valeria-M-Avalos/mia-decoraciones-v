#!/bin/bash
set -e

echo "=========================================="
echo "🚀 Mía Decoraciones - Azure Deployment"
echo "=========================================="

# Instalar dependencias de Composer (sin paquetes de desarrollo)
echo "📦 Instalando dependencias de Composer..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Instalar dependencias de NPM
echo "📦 Instalando dependencias de NPM..."
npm ci --legacy-peer-deps

# Compilar assets con Vite (CSS, JS)
echo "🎨 Compilando assets con Vite..."
npm run build

# Crear directorios necesarios para Laravel
echo "📁 Creando directorios de storage..."
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Dar permisos a directorios
echo "🔐 Configurando permisos..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Optimizaciones de Laravel (cache de config, rutas, vistas)
echo "⚡ Optimizando Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimizar Filament (panel de admin)
echo "🎨 Optimizando Filament..."
php artisan filament:optimize

# Crear enlace simbólico para storage público (imágenes)
echo "🔗 Creando storage link..."
php artisan storage:link --force

echo "✅ Deployment completado exitosamente!"
echo "=========================================="