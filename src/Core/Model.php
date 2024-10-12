<?php
// src/Core/Model.php

namespace Phlask\Core;

// Abstract class Model that serves as the base for database models.
abstract class Model {
    // The name of the database table associated with the model.
    protected static $table;

    // An array of fillable fields that can be mass-assigned when creating a record.
    protected static $fillable = [];

    /**
     * Retrieve all records from the model's database table.
     *
     * @return array An associative array of all rows in the table.
     *
     * This method runs a `SELECT *` query on the model's associated table and fetches
     * all the results as an associative array using PDO's `fetchAll()` method.
     */
    public static function all() {
        // Get an instance of the database connection using the configuration file.
        $db = Database::getInstannce(require __DIR__ . '/../Config/config.php');
        
        // Prepare and execute the query to select all records from the table.
        $stmt = $db->query("SELECT * FROM " . static::$table);
        
        // Fetch and return all rows as an associative array.
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Find a record by its ID from the model's database table.
     *
     * @param int $id The ID of the record to find.
     * @return array|null The associative array of the record, or null if not found.
     *
     * This method runs a `SELECT * FROM table WHERE id = ?` query, binding the provided
     * ID to retrieve a specific record by its primary key. If found, it returns the record.
     */
    public static function find($id) {
        // Get an instance of the database connection using the configuration file.
        $db = Database::getInstannce(require __DIR__ . '/../Config/config.php');
        
        // Prepare and execute the query to select the record by ID.
        $stmt = $db->query("SELECT * FROM " . static::$table . " WHERE id = ?", [$id]);
        
        // Fetch and return the record as an associative array, or null if not found.
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Create a new record in the model's database table.
     *
     * @param array $data An associative array of data to be inserted.
     *
     * This method inserts a new row into the database table using the provided data.
     * It ensures that only fields listed in the `$fillable` array are inserted, protecting
     * against mass assignment vulnerabilities.
     */
    public static function create($data) {
        // Get an instance of the database connection using the configuration file.
        $db = Database::getInstannce(require __DIR__ . '/../Config/config.php');
        
        // Join the $fillable array into a comma-separated string for the SQL fields.
        $fields = implode(', ', static::$fillable);
        
        // Create a string of placeholders (e.g., "?, ?, ?") for the SQL query.
        $placeholders = implode(', ', array_fill(0, count(static::$fillable), '?'));
        
        // Filter the input data to only include fields listed in $fillable.
        $values = array_intersect_key($data, array_flip(static::$fillable));

        // Prepare the SQL query to insert a new record with the given data.
        $sql = "INSERT INTO " . static::$table . " ($fields) VALUES ($placeholders)";
        
        // Execute the query with the filtered data.
        $db->query($sql, array_values($values));
    }
}
