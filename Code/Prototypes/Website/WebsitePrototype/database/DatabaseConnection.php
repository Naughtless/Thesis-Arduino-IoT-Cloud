<?php

class DatabaseConnection {
    /*
     * Properties
     */
    private $connection;

    /*
     * Constructor
     */
    public function __construct($host, $username, $password, $schema) {
        $this->connection = new mysqli($host, $username, $password, $schema);

        if($this->connection->connect_error) {
            die("ERROR - Failed to establish connection with the specified database server.");
        }
    }

    /*
     * Functions
     */

    // Update
    public function executeUpdate($query) {
        if($this->connection->query($query) === TRUE) {
            return "INFO - Successfully performed executeUpdate()!";
        }
        else {
            return "ERROR - Failed to perform executeUpdate()!";
        }
    }

    // Query
    public function executeQuery($query) {
        $result = $this->connection->query($query);
        if($result->num_rows > 0) {
            #var_dump($result);
            return $result;
        }
        else {
            return null;
        }
    }

    // Procedure
    public function runProcedure($query) {}

    /*
     * Close Connection
     */
    public function close() {
        $this->connection->close();
    }
}