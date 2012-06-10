<?php
class User extends Base {
    protected $_id;
    protected $_email;
    protected $_loggedIn = false;
    protected $_role;

    public function __construct($userInfo = array()) {
        parent::__construct();
        if (count($userInfo) > 0) {
            foreach ($userInfo as $key => $value) {
                $protected_var = '_' . $key;
                $this->$protected_var = $value;
            }
        }
    }

    public function createFromSession() {
        $this->_id          = $_SESSION['user']['id'];
        $this->_email       = $_SESSION['user']['email'];
        $this->_role        = $_SESSION['user']['role'];
        $this->_loggedIn   = true;
    }

    public function getUsers($limits = array()) {
        $query = '  SELECT u.id, u.email
                    FROM users u';

        if (count($limits > 0)) {
            if (array_key_exists('role', $limits)) {
                $query .= ' JOIN user_roles ur ON u.user_role_id = ur.id
                            WHERE ur.title = ?';
            }
        }
    }

    public function isLoggedIn() {
        if (isset($_SESSION['user'])) {
            return true;
        } return false;
    }

    public function login($email, $password) {
        $password = sha1(PASSWORD_SALT . $password);

        $this->_db->query(' SELECT u.id, u.email, ur.title as role
                            FROM users u
                              JOIN user_roles ur ON u.user_role_id = ur.id
                            WHERE u.email = ?
                                AND u.password = ?');
        $this->_db->bind(1, $email);
        $this->_db->bind(2, $password);
        $results = $this->_db->resultset();

        if ($results) {
            $this->_setSessions($results[0]);
            $this->createFromSession();
            $this->_logUserLogin();
        } else {
            $this->_logFailedUserLogin($email);
            return false;
        }
    }

    public function logout() {
        if (session_destroy()) {
            return true;
        } return false;
    }

    private function _logFailedUserLogin($attempted_email) {
        $this->_db->query(' INSERT INTO user_failed_login_log
                            (attempted_email, failed_login_ip_address)
                            VALUES (?, INET_ATON(?))');
        $this->_db->bind(1, $attempted_email);
        $this->_db->bind(2, $_SERVER['REMOTE_ADDR']);

        if (!$this->_db->execute()) {
            // Log error and send email
        }
    }

    private function _logUserLogin() {
        $this->_db->query(' INSERT INTO user_login_log
                            (user_id, login_ip_address)
                            VALUES (?, INET_ATON(?))');
        $this->_db->bind(1, $this->_id);
        $this->_db->bind(2, $_SERVER['REMOTE_ADDR']);
        if (!$this->_db->execute()) {
            // Log error and send email
        }
    }

    private function _setSessions($user_info) {
        foreach ($user_info as $key => $value) {
            $_SESSION['user'][$key] = $value;
        }
    }
}