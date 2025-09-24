<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Auth extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
    }

    public function test()
    {
        $this->call->view('login');
    }

    public function login()
    {
        // Check for remember me cookie first
        if (!isset($_SESSION['logged_in']) && isset($_COOKIE['remember_user'])) {
            $cookie_data = json_decode($_COOKIE['remember_user'], true);
            if ($cookie_data && isset($cookie_data['email']) && isset($cookie_data['token'])) {
                $user = $this->StudentsModel->find_by_email($cookie_data['email']);
                if ($user && $user['active'] == 1) {
                    // Create a simple token based on user data (in production, use more secure method)
                    $expected_token = md5($user['email'] . $user['password'] . 'remember_salt');
                    if ($cookie_data['token'] === $expected_token) {
                        // Auto-login from cookie
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_email'] = $user['email'];
                        $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                        $_SESSION['logged_in'] = true;
                        redirect('/users');
                    }
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $remember = isset($_POST['remember']);

            $user = $this->StudentsModel->find_by_email($email);

            if ($user && $password === $user['password']) {
                if ($user['active'] == 1) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                    $_SESSION['logged_in'] = true;

                    // Handle remember me functionality
                    if ($remember) {
                        $token = md5($user['email'] . $user['password'] . 'remember_salt');
                        $cookie_data = json_encode([
                            'email' => $user['email'],
                            'token' => $token
                        ]);
                        
                        // Set cookie for 30 days
                        setcookie('remember_user', $cookie_data, time() + (30 * 24 * 60 * 60), '/');
                    } else {
                        // Clear remember cookie if unchecked
                        if (isset($_COOKIE['remember_user'])) {
                            setcookie('remember_user', '', time() - 3600, '/');
                        }
                    }

                    redirect('/users');
                } else {
                    $data['error'] = 'Your account is inactive. Please contact administrator.';
                    $data['old_email'] = $email;
                }
            } else {
                $data['error'] = 'Invalid email or password.';
                $data['old_email'] = $email;
            }
        }

        $this->call->view('login', $data ?? []);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $existing_user = $this->StudentsModel->find_by_email($_POST['email']);
            if ($existing_user) {
                $data['error'] = 'Email address already exists.';
                $data['old_first_name'] = $_POST['first_name'];
                $data['old_last_name'] = $_POST['last_name'];
                $data['old_email'] = $_POST['email'];
            } else {
                $data = [
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'active' => 0
                ];

                try {
                    $this->StudentsModel->insert($data);
                    redirect('auth/login?registered=1');
                } catch (Exception $e) {
                    $data['error'] = 'Registration failed. Please try again.';
                    $data['old_first_name'] = $_POST['first_name'];
                    $data['old_last_name'] = $_POST['last_name'];
                    $data['old_email'] = $_POST['email'];
                }
            }
        }

        $this->call->view('register', $data ?? []);
    }

}