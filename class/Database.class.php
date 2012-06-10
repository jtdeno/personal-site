<?php

class Database extends Base
{
    private $_dbh;
    private $_stmt;
    private $_queryCounter = 0;

    public function __construct($user = DB_USER, $pass = DB_PASS, $dbname = DB_NAME)
    {
        $dsn = 'mysql:host=localhost;dbname=' . $dbname;
        //$dsn = 'sqlite:myDatabase.sq3';
        //$dsn = 'sqlite::memory:';
        $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_PERSISTENT => true,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    );
        try {
            $this->_dbh = new PDO($dsn, $user, $pass, $options);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function query($query)
    {
		try {
			$this->_stmt = $this->_dbh->prepare($query);
		} catch (PDOException $e) { echo $e->getMessage(); }
        
		return $this;
    }

    public function bind($pos, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

		try {
        	$this->_stmt->bindValue($pos, $value, $type);
		} catch (PDOException $e) { echo $e->getMessage(); }
		
        return $this;
    }

    public function execute()
    {
		try {
			$this->_queryCounter++;
			$return = $this->_stmt->execute();
		} catch (PDOException $e) {
			// TODO: Add better error logging on failed queries.
			mail('jim@jimdeno.com', 'Query Execution Error', 'Error:' . $e->getMessage());
			echo $e->getMessage();
		}

		return $return;
    }

    public function resultset()
    {
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_ASSOC);
    }

    // returns last insert ID
    //!!!! if called inside a transaction, must call it before closing the transaction!!!!!!
    public function lastInsertId()
    {
        return $this->_dbh->lastInsertId();
    }

    // begin transaction // must be innoDatabase table
    public function beginTransaction()
    {
        return $this->_dbh->beginTransaction();
    }

    // end transaction
    public function endTransaction()
    {
        return $this->_dbh->commit();
    }

    // cancel transaction
    public function cancelTransaction()
    {
        return $this->_dbh->rollBack();
    }

    // returns number of rows updated, deleted, or inserted
    public function rowCount()
    {
        return $this->_stmt->rowCount();
    }

    // returns number of queries executed
    public function queryCounter()
    {
        return $this->_queryCounter;
    }

    public function debugDumpParams()
    {
        return $this->_stmt->debugDumpParams();
    }

    public function getErrorInfo() {
        return $this->_stmt->errorInfo();
    }

}