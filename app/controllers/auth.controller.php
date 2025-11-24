<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';

class AuthController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function showRegister() {
        $this->view->showRegister();
    }

    public function auth() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // busco el usuario
        $user = $this->model->getByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            // ACA LO AUTENTIQUE
            
            AuthHelper::login($user);
            
            header('Location: ' . BASE_URL . 'listar');
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }

    public function register() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->view->showRegister('Faltan completar datos');
            return;
        }

        // Verifico si el usuario ya existe
        $user = $this->model->getByEmail($email);
        if ($user) {
            $this->view->showRegister('El email ya está registrado.');
            return;
        }

        // Hasheo la contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Inserto el usuario en la DB
        $id = $this->model->insert($email, $hash);

        header('Location: ' . BASE_URL . '/login');
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }
}