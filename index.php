<?php 
  session_start();

  //Router (Controler frontal)
  require_once('controller/controller.php');
  include('controller/account-detailsController.php');

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

        default:
          home();
        break;
    }
    
    }else{
      home();
    }