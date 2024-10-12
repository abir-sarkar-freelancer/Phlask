<?php
// src/Core/Database.php

namespace Phlask\Core;

// The Database class is responsible for handling database connections and executing queries.
class Database {
    // Holds the singleton instance of the Database class.
    private static $instance = null;

    // Holds the PDO connection instance.
    private $pdo;

    /**
     * Private constructor for the Database class.
     *
     * @param array $config The database configuration array, which includes 'host', 
     * 'database', 'username', and 'password'.
     *
     * This constructor initializes the PDO connection using the provided configuration.
     * It sets the character set to UTF-8 and configures PDO to throw exceptions on errors.
     */
    private function __construct($config) {
        // Create a DSN (Data Source Name) string for the PDO connection.
        $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4";
        
        // Initialize the PDO connection using the DSN and provided credentials.
        $this->pdo = new \PDO(
            $dsn,
            $config['username'],
            $config['password']
        );
        
        // Set the PDO error mode to throw exceptions on errors.
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get the singleton instance of the Database class.
     *
     * @param array $config The database configuration array.
     * @return Database The singleton instance of the Database class.
     *
     * This static method returns the single instance of the Database class.
     * If the instance is not already created, it initializes it with the provided configuration.
     */
    public static function getInstannce($config) {
        // Check if the instance is null, and if so, create a new one.
        if (self::$instance == null) {
            self::$instance = new self($config);
        }

        // Return the singleton instance.
        return self::$instance;
    }

    /**
     * Execute a SQL query with optional parameters.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params An optional array of parameters to bind to the SQL query.
     * @return \PDOStatement The result of the executed query.
     *
     * This method prepares and executes a SQL query using PDO. It allows for
     * parameterized queries to avoid SQL injection. The result is returned as
     * a PDOStatement object.
     */
    public function query($sql, $params = []) {
        // Prepare the SQL statement using the PDO connection.
        $stmt = $this->pdo->prepare($sql);
        
        // Execute the statement with the bound parameters (if any).
        $stmt->execute($params);
        
        // Return the resulting PDO statement.
        return $stmt;
    }
}
