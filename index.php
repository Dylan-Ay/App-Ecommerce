<?php 
  session_start();

  // Router (Main controller) calls others controllers
  
  require_once('controllers/controller.php');
  require_once('controllers/AccountController.php');
  require_once('controllers/UserController.php');
  require_once('controllers/HomeController.php');

  $accountController = new AccountController();
  $userController = new UserController();
  $productController = new ProductController();
  $homeController = new HomeController();

  // Functions
  require_once('service/functions.php');

  // Check what page is called according to the URL and send back the view to the user

  if (isset($_GET['page'])){
      switch ($_GET['page']) {

        // Products cases
        case 'products':
          listProducts();
        break;

        case 'product':
          product();
        break;

        case 'cart':
          $productController->cart();
        break;

        case 'home':
          $homeController->getHomePage();
        break;
        
        // Account cases
        case 'login':
          $accountController->login();
        break;
        
        case 'logout':
          $accountController->logOut();
        break;

        case 'account-menu':
          $accountController->accountMenu();
        break;

        case 'delete-account':
          $accountController->deleteAccount();
        break;

        case 'account-details':
          $accountController->detailsAccount();
        break;

        case 'account-success':
          $accountController->accountSuccess();
        break;

        case 'create-account':
          $accountController->accountCreation();
        break;
        
        case 'order-page':
          $accountController->accountOrder();
        break;

        default:
          $homeController->getHomePage();
        break;
    }
    
    }else{
      $homeController->getHomePage();
    }