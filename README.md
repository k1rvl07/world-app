# World App - Laravel

[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-blue.svg)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://www.docker.com/)

Веб-приложение для просмотра информации о странах мира, разработанное на Laravel с использованием Tailwind CSS для стилизации.

## Описание проекта

Это полнофункциональное приложение для просмотра данных о странах мира с возможностями:
- Просмотр списка всех стран с пагинацией
- Детальная информация о стране (население, площадь, континент, регион и др.)
- Просмотр городов страны
- Информация о языках, используемых в стране
- Современный интерфейс с использованием Tailwind CSS
- Docker-контейнеризация для легкого развертывания

## Требования

- Docker и Docker Compose
- Git

## Установка и запуск

### 1. Клонирование репозитория

```bash
git clone https://github.com/k1rvl07/world-app
cd world-app
```

### 2. Запуск с помощью Docker

```bash
# Запуск контейнеров
docker compose up -d

# Установка зависимостей PHP (Composer)
docker compose exec app composer install

# Установка зависимостей Node.js
docker compose exec app npm install

# Сборка frontend-ресурсов
docker compose exec app npm run build

# Генерация ключа приложения
docker compose exec app php artisan key:generate

# Запуск миграций базы данных
docker compose exec app php artisan migrate

# Заполнение базы данными о странах
docker compose exec app php artisan db:seed --class=worldDatabaseSeeder
```

### 3. Доступ к приложению

Приложение будет доступно по адресу: http://localhost:8000

## Использование

### Основные функции

1. **Список стран** - отображает все страны мира с пагинацией
2. **Детали страны** - подробная информация о выбранной стране
3. **Города страны** - список городов с населением

### Структура базы данных

- `countries` таблица содержит:
  - `Code` - код страны (первичный ключ)
  - `Name` - название страны
  - `Continent` - континент
  - `Region` - регион
  - `SurfaceArea` - площадь территории
  - `IndepYear` - год независимости
  - `Population` - население
  - `LifeExpectancy` - ожидаемая продолжительность жизни
  - `GNP` - ВНП
  - `LocalName` - местное название
  - `GovernmentForm` - форма правления
  - `HeadOfState` - глава государства
  - `Capital` - столица

- `cities` таблица содержит:
  - `Name` - название города
  - `CountryCode` - код страны
  - `District` - район/область
  - `Population` - население

- `countrylanguages` таблица содержит:
  - `CountryCode` - код страны
  - `Language` - язык
  - `IsOfficial` - официальный язык (T/F)
  - `Percentage` - процент населения

## Разработка

### Запуск в режиме разработки

```bash
# Для frontend-ресурсов
docker compose exec app npm run dev

# Для PHP-сервера (если не используется nginx)
docker compose exec app php artisan serve
```

### Запуск тестов

```bash
docker compose exec app php artisan test
```

## Архитектура

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade templates + Tailwind CSS
- **Database**: PostgreSQL
- **Web Server**: Nginx
- **Containerization**: Docker + Docker Compose

## Структура проекта

```
├── app/
│   ├── Http/Controllers/CountryController.php
│   └── Models/
│       ├── Country.php
│       ├── City.php
│       └── CountryLanguage.php
├── database/
│   ├── migrations/
│   └── seeders/worldDatabaseSeeder.php
├── resources/
│   ├── css/app.css
│   ├── js/app.js
│   └── views/
│       ├── layouts/app.blade.php
│       ├── world/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── city/index.blade.php
├── routes/web.php
├── docker-compose.yml
└── Dockerfile
```

---

# World App - Laravel

[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-blue.svg)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://www.docker.com/)

A web application for viewing information about countries of the world, built with Laravel and styled with Tailwind CSS.

## Project Description

This is a full-featured application for browsing world country data featuring:
- View list of all countries with pagination
- Detailed country information (population, area, continent, region, etc.)
- View cities of a country
- Information about languages used in a country
- Modern UI using Tailwind CSS
- Docker containerization for easy deployment

## Requirements

- Docker and Docker Compose
- Git

## Installation and Setup

### 1. Clone the Repository

```bash
git clone https://github.com/k1rvl07/world-app
cd world-app
```

### 2. Run with Docker

```bash
# Start containers
docker compose up -d

# Install PHP dependencies
docker compose exec app composer install

# Install Node.js dependencies
docker compose exec app npm install

# Build frontend assets
docker compose exec app npm run build

# Generate application key
docker compose exec app php artisan key:generate

# Run database migrations
docker compose exec app php artisan migrate

# Seed database with world data
docker compose exec app php artisan db:seed --class=worldDatabaseSeeder
```

### 3. Access the Application

The application will be available at: http://localhost:8000

## Usage

### Main Features

1. **Country List** - displays all countries with pagination
2. **Country Details** - detailed information about a selected country
3. **Country Cities** - list of cities with population

### Database Structure

- `countries` table contains:
  - `Code` - country code (primary key)
  - `Name` - country name
  - `Continent` - continent
  - `Region` - region
  - `SurfaceArea` - surface area
  - `IndepYear` - year of independence
  - `Population` - population
  - `LifeExpectancy` - life expectancy
  - `GNP` - gross national product
  - `LocalName` - local name
  - `GovernmentForm` - government form
  - `HeadOfState` - head of state
  - `Capital` - capital city

- `cities` table contains:
  - `Name` - city name
  - `CountryCode` - country code
  - `District` - district
  - `Population` - population

- `countrylanguages` table contains:
  - `CountryCode` - country code
  - `Language` - language
  - `IsOfficial` - official language (T/F)
  - `Percentage` - percentage of population

## Development

### Run in Development Mode

```bash
# For frontend assets
docker compose exec app npm run dev

# For PHP server (if not using nginx)
docker compose exec app php artisan serve
```

### Run Tests

```bash
docker compose exec app php artisan test
```

## Architecture

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade templates + Tailwind CSS
- **Database**: PostgreSQL
- **Web Server**: Nginx
- **Containerization**: Docker + Docker Compose

## Project Structure

```
├── app/
│   ├── Http/Controllers/CountryController.php
│   └── Models/
│       ├── Country.php
│       ├── City.php
│       └── CountryLanguage.php
├── database/
│   ├── migrations/
│   └── seeders/worldDatabaseSeeder.php
├── resources/
│   ├── css/app.css
│   ├── js/app.js
│   └── views/
│       ├── layouts/app.blade.php
│       ├── world/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── city/index.blade.php
├── routes/web.php
├── docker-compose.yml
└── Dockerfile
```
