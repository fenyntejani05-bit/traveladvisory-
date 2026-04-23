<?php

/**
 * Database Class
 * 
 * Provides a PDO-based database abstraction layer with prepared statements.
 * Handles database connections, queries, and result fetching.
 * 
 * @package Core
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Database
{
    /**
     * Database host
     * 
     * @var string
     */
    private $host;

    /**
     * Database username
     * 
     * @var string
     */
    private $user;

    /**
     * Database password
     * 
     * @var string
     */
    private $pass;

    /**
     * Database name
     * 
     * @var string
     */
    private $dbName;

    /**
     * PDO database handler
     * 
     * @var PDO
     */
    private $dbh;

    /**
     * PDO statement handler
     * 
     * @var PDOStatement
     */
    private $stmt;

    /**
     * Database constructor
     * 
     * Establishes a PDO connection to the database using configuration
     * constants. Uses persistent connections and exception error mode.
     * 
     * @throws PDOException If connection fails
     */
    public function __construct()
    {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->dbName = DB_NAME;

        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    /**
     * Prepares a SQL query for execution
     * 
     * @param string $query SQL query string
     * @return void
     */
    public function query(string $query): void
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Binds a value to a parameter in the prepared statement
     * 
     * Automatically determines the parameter type if not specified.
     * 
     * @param string $param Parameter name (with or without colon)
     * @param mixed $value Value to bind
     * @param int|null $type PDO parameter type (optional)
     * @return void
     */
    public function bind(string $param, $value, ?int $type = null): void
    {
        if (is_null($type)) {
            $type = $this->getParameterType($value);
        }

        $param = ltrim($param, ':');
        $this->stmt->bindValue(':' . $param, $value, $type);
    }

    /**
     * Determines the appropriate PDO parameter type for a value
     * 
     * @param mixed $value Value to determine type for
     * @return int PDO parameter type constant
     */
    protected function getParameterType($value): int
    {
        switch (true) {
            case is_int($value):
                return PDO::PARAM_INT;
            case is_bool($value):
                return PDO::PARAM_BOOL;
            case is_null($value):
                return PDO::PARAM_NULL;
            default:
                return PDO::PARAM_STR;
        }
    }

    /**
     * Executes the prepared statement
     * 
     * @return bool True on success, false on failure
     */
    public function execute(): bool
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            error_log("Database Execute Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Executes the statement and returns all results as an array
     * 
     * @return array Array of associative arrays
     */
    public function resultSet(): array
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executes the statement and returns a single row
     * 
     * @return array|false Associative array or false if no result
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Returns the number of rows affected by the last statement
     * 
     * @return int Number of affected rows
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Returns the ID of the last inserted row
     * 
     * @return string Last insert ID
     */
    public function lastInsertId(): string
    {
        return $this->dbh->lastInsertId();
    }

    /**
     * Begins a database transaction
     * 
     * @return bool True on success, false on failure
     */
    public function beginTransaction(): bool
    {
        return $this->dbh->beginTransaction();
    }

    /**
     * Commits a database transaction
     * 
     * @return bool True on success, false on failure
     */
    public function commit(): bool
    {
        return $this->dbh->commit();
    }

    /**
     * Rolls back a database transaction
     * 
     * @return bool True on success, false on failure
     */
    public function rollBack(): bool
    {
        return $this->dbh->rollBack();
    }
}
