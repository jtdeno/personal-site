<?php

class Base {
    protected static $db;
    protected $_db;

    public function __construct() {
        if (!$this->_db instanceof Database) {
            $this->_db = new Database();
        }

        if (!self::$db instanceof Database) {
            self::$db = $this->_db;
        }
    }

    public function __get($name) {
        if (method_exists($this, 'get_' . ucfirst($name))) {
            return call_user_func(array($this, 'get_' . ucfirst($name)));
        } elseif (property_exists($this, $name)) {
            return $this->$name;
        } elseif (property_exists($this, '_' . $name)) {
            $private_var = '_' . $name;
            return $this->$private_var;
        } else {
            echo 'Error executing the __get() method';
        }
    }

    public function __set($name, $value) {
        if (method_exists($this, 'set' . $name)) {
            return call_user_func(array($this, 'set' . ucfirst($name)));
        } elseif (property_exists($this, $name)) {
            $this->$name = $value;
        } elseif (property_exists($this, '_' . $name)) {
            $private_var = '_' . $name;
            $this->$private_var = $value;
        } else {
            echo 'Error executing the __set() method';
        }
    }

	public function __isset($name) {
		return isset($this->$name);
	}
}