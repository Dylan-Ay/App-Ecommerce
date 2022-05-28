<?php 
  session_start();

  // Router (Main controller) calls others controllers
  
  require_once('controllers/controller.php');
  require_once('controllers/account-detailsController.php');

  // Check what page is called according to the URL and send back the view to the user

  if (isset($_GET['page'])){
      switch ($_GET['page']) {

        case 'products':
          listProducts();
        break;

        case 'product':
          product();
        break;

        case 'cart':
          cart();
        break;

        case 'home':
          home();
        break;

        case 'login':
          login();
        break;

        case 'create-account':
          createAccount();
        break;
        
        case 'account':
          account();
        break;
        
        case 'order-page':
          orderPage();
        break;

        case 'delete-account':
          deleteAccount();
        break;

        case 'account-details':
          detailsAccount();
        break;

        case 'account-success':
          accountSuccess();
        break;

        case 'logout':
          logout();
        break;

        default:
          home();
        break;
    }
    
    }else{
      home();
    }