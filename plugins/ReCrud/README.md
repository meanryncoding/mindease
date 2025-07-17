# ReCrud Plugin - Web CRUD Generator

## What We've Built

I've successfully created a complete web interface for your ReCrud plugin that allows you to generate CakePHP CRUD files through a web browser instead of using the command line.

## Key Features

### 🌐 Web Interface

-   **URL**: `http://localhost:8000/bake`
-   User-friendly form with dropdown options
-   Real-time suggestions for table names
-   Visual feedback and results

### 🎯 Functionality

-   **Bake All**: Generate Controller + Model + Templates
-   **Bake Controller**: Generate only controller files
-   **Bake Model**: Generate only model files (Table + Entity)
-   **Bake Templates**: Generate only view templates
-   **Force Overwrite**: Option to overwrite existing files

### 📁 Generated Files

```
├── src/Controller/[Table]Controller.php
├── src/Model/Table/[Table]Table.php
├── src/Model/Entity/[Singular].php
└── templates/[Table]/
    ├── index.php
    ├── view.php
    ├── add.php
    └── edit.php
```

## How to Use

### 1. Start Development Server

```bash
php -S localhost:8000 -t webroot webroot/index.php
```

### 2. Access Web Interface

-   Open browser: `http://localhost:8000/bake`

### 3. Generate CRUD

1. Enter table name (e.g., "books")
2. Select bake command type
3. Check "Force" if you want to overwrite existing files
4. Click "Execute Bake Command"

### 4. Test Your CRUD

-   After generation, visit: `http://localhost:8000/[table-name]`
-   Example: `http://localhost:8000/books`

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/re-crud
```
