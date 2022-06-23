<?php 

class AccountController{

    // Display the account menu
    public function accountMenu()
    {
        //Call user controller in order to get its functions
        global $userController;
        require('views/account/accountMenu.php');
    }
    
    // Display the users's details account
    public function detailsAccount()
    {
        global $userController;
        require('views/account/accountUserInfos.php');
    }

    // Display the delete account confirmation page
    public function deleteAccount()
    {
        global $userController;
        $userController->delete_user();

        if ( isset($_SERVER['HTTP_COOKIE']) || isset($_SESSION['email-login']) ){
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
            unset($_SESSION);
        }
        require('views/account/accountDelete.php');
    }

    // Display the account success confirmation page
    public function accountSuccess()
    {
        require('views/account/accountSuccess.php');
    }

    // Display the login page
    public function logIn()
    {
        global $userController;
        
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
            if ( empty($_POST["email-login"] || empty($_POST["password-login"])) ){
                $_SESSION['wrong-id'] = 
                '<div class="alert alert-danger text-center" role="alert">
                    Veuillez remplir les champs du formulaire.
                </div>';
            }
            if (!empty($_POST['website'])){
                header('Location: index.php?page=login');
                exit();
            }
            else{
                $email = htmlentities(trim($_POST['email-login']));
                $password = $_POST["password-login"];
                
                if (isset($_SESSION['wrong-id']) || isset($_SESSION['error-form'])){
                    unset($_SESSION['wrong-id']);
                    unset($_SESSION['error-form']);
                }
    
                // On récupère l'objet user qui correspond au mail en paramètre
                $user = $userController->get_user($email);
                // On vérifie que le password reçu en $_POST corresponde au password de l'user récupéré
                if (password_verify($password, $user['pswd'])){
                    $_SESSION['email-login'] = $email;
                    
                    header('Location: index.php?page=account-menu');
                    unset($_SESSION['wrong-id']);
                }
                else{
                    $_SESSION['wrong-id'] = 
                    '<div class="alert alert-danger text-center" role="alert">
                        Erreur : aucun résultat ne correspond à cette adresse électronique et/ou mot de passe.
                        Merci de réessayer.
                    </div>';
                    header('Location: index.php?page=login');
                }
            }
        }
        require('views/account/accountLogin.php');
    }

    // Display the logout confirmation page
    public function logOut()
    {
        unset($_SESSION['email-login']);
        setcookie('firstname', '', time()-1000);
        setcookie('lastname', '', time()-1000);
        require('views/account/accountLogout.php');
    }

    // Display the account creation page
    public function accountCreation()
    {
        require('views/account/accountCreation.php');
    }

    // Display order page account
    public function accountOrder()
    {
        require('views/account/accountOrder.php');
    }

}