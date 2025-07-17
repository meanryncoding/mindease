# ReCrud Web Interface - Usage Guide

## Overview

The ReCrud web interface allows you to generate CakePHP CRUD files through a web browser instead of using command line interface (CLI).

## How to Access

1. Start your CakePHP development server:

    ```bash
    php -S localhost:8000 -t webroot webroot/index.php
    ```

2. Open your browser and navigate to:
    ```
    http://localhost:8000/bake
    ```

## How to Use

### Step 1: Access the Web Interface

-   Navigate to `http://localhost:8000/bake`
-   You'll see the ReCrud Web Bake Interface

### Step 2: Enter Table Information

1. **Table Name**: Enter the name of your database table (e.g., "books", "users", "products")

    - The interface provides suggestions for common table names
    - You can type any table name that exists in your database

2. **Bake Command**: Choose what you want to generate:

    - **Bake All**: Generates Controller + Model + Templates (recommended)
    - **Bake Controller**: Generates only the controller file
    - **Bake Model**: Generates only the model files (Table and Entity)
    - **Bake Templates**: Generates only the view template files

3. **Force Overwrite**: Check this if you want to overwrite existing files
    - ⚠️ **Warning**: This will overwrite existing files without prompting!

### Step 3: Execute the Command

-   Click the "Execute Bake Command" button
-   The system will run the equivalent CLI command: `bin/cake bake [command] [table_name]`
-   You'll see the command output and results

### Step 4: View Results

After successful execution, you'll see:

-   Command output showing what files were created
-   File locations for generated files
-   A link to test your newly created CRUD interface

## Example: Generating CRUD for "books" Table

1. **Input**:

    - Table Name: `books`
    - Command: `Bake All`
    - Force: ✓ (checked)

2. **Generated Files**:

    - Controller: `src/Controller/BooksController.php`
    - Model Table: `src/Model/Table/BooksTable.php`
    - Model Entity: `src/Model/Entity/Book.php`
    - Templates:
        - `templates/Books/index.php` (list view)
        - `templates/Books/view.php` (detail view)
        - `templates/Books/add.php` (create form)
        - `templates/Books/edit.php` (edit form)

3. **Access Generated CRUD**:
    - Browse to: `http://localhost:8000/books`
    - You'll have a fully functional CRUD interface!

## Requirements

1. **Database Table**: The table must exist in your database
2. **Table Naming**: Follow CakePHP conventions (plural table names)
3. **Database Connection**: Ensure your database is properly configured in `config/app.php`

## Benefits of Web Interface vs CLI

### Web Interface Advantages:

-   ✅ No need to open terminal/command prompt
-   ✅ User-friendly interface with helpful hints
-   ✅ Visual feedback and results
-   ✅ Works on any device with a web browser
-   ✅ Great for developers who prefer GUI tools

### CLI Advantages:

-   ✅ Faster for experienced developers
-   ✅ Can be scripted and automated
-   ✅ Works in headless environments

## Troubleshooting

### Common Issues:

1. **"Table not found" error**:

    - Ensure the table exists in your database
    - Check your database connection in `config/app.php`

2. **Permission errors**:

    - Ensure the web server has write permissions to your project directories

3. **Plugin not accessible**:

    - Ensure the ReCrud plugin is loaded in your application
    - Check that routes are properly configured

4. **Type error with force parameter**:
    - This has been fixed in the latest version
    - If you encounter boolean/string type errors, ensure you're using the updated BakeController

### Getting Help:

-   Check the command output for detailed error messages
-   Verify your table name spelling and existence
-   Ensure CakePHP conventions are followed

## Advanced Usage

### Custom Bake Commands:

The web interface currently supports the main bake commands. For advanced options, you might still need to use CLI.

### Batch Operations:

To generate CRUD for multiple tables, you'll need to run the command for each table individually through the web interface.

## Security Notes

-   This tool executes system commands, so ensure it's only accessible in development environments
-   Do not expose this interface in production environments
-   The force option will overwrite files without backup - use with caution

## Conclusion

The ReCrud web interface makes CakePHP development more accessible by providing a user-friendly way to generate CRUD files. It's perfect for developers who prefer graphical interfaces or work in environments where CLI access is limited.

Happy coding! 🚀
