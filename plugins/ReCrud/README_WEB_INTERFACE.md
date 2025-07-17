# ReCrud Web Bake Interface

A CakePHP plugin that provides a web-based interface for executing bake commands without using the command line.

## Features

-   **Web-based Interface**: Generate CRUD files through a user-friendly web interface
-   **Multiple Bake Options**: Support for baking all files, controllers only, models only, or templates only
-   **Force Override**: Option to force overwrite existing files
-   **Real-time Output**: Display command output and results
-   **Bootstrap UI**: Modern, responsive interface using Bootstrap 5

## Installation

The plugin is already installed and configured in your CakePHP application.

## Usage

### Access the Web Interface

1. Start your CakePHP development server:

    ```bash
    php bin/cake.php server
    ```

2. Open your browser and navigate to:
    ```
    http://localhost:8765/bake
    ```

### Using the Interface

1. **Enter Table Name**: Type the name of your database table (e.g., "posts", "users", "products")
2. **Select Bake Command**: Choose what you want to generate:
    - **Bake All**: Creates controller, model, and template files
    - **Bake Controller**: Creates only the controller file
    - **Bake Model**: Creates only the model files (Table and Entity)
    - **Bake Templates**: Creates only the view template files
3. **Force Override** (Optional): Check this option to overwrite existing files without prompting
4. **Click Execute**: The command will run and show you the results

### Generated Files

After successful execution, files will be created in:

-   **Controllers**: `src/Controller/[TableName]Controller.php`
-   **Models**:
    -   `src/Model/Table/[TableName]Table.php`
    -   `src/Model/Entity/[EntityName].php`
-   **Templates**:
    -   `templates/[TableName]/index.php`
    -   `templates/[TableName]/view.php`
    -   `templates/[TableName]/add.php`
    -   `templates/[TableName]/edit.php`

## Requirements

-   CakePHP 4.x or 5.x
-   PHP 8.1+
-   Database connection properly configured
-   Tables must exist in the database before baking

## Notes

-   This interface executes the same commands as `bin/cake bake [command] [table_name]`
-   Make sure your database is properly configured in `config/app.php`
-   Table names should follow CakePHP naming conventions
-   Use singular form for entity names (CakePHP will pluralize automatically)

## Troubleshooting

### Common Issues

1. **Table not found**: Ensure the table exists in your database and is spelled correctly
2. **Permission errors**: Make sure CakePHP has write permissions to the `src/` and `templates/` directories
3. **Database connection errors**: Verify your database configuration in `config/app.php`

### Error Messages

If you encounter errors, check:

-   The error output displayed in the web interface
-   CakePHP error logs in `logs/error.log`
-   Database connectivity

## Advanced Usage

### Custom Commands

You can extend the interface by modifying the `BakeController` to support additional bake commands or options.

### API Access

The interface also provides programmatic access via POST requests to `/re-crud/bake/execute` with the following parameters:

-   `table_name`: The name of the table
-   `command`: The bake command (all, controller, model, template)
-   `force`: Boolean for force override

## Plugin Structure

```
plugins/ReCrud/
├── src/
│   ├── Controller/
│   │   ├── AppController.php
│   │   └── BakeController.php
│   └── Plugin.php
└── templates/
    ├── Bake/
    │   ├── index.php
    │   └── execute.php
    └── layout/
        └── default.php
```

## Contributing

This plugin is part of the ReCrud project. Feel free to submit issues and pull requests.

## License

This plugin follows the same license as the main CakePHP framework.
