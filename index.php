<?php 
    session_start();
    //Router

    require('controller/controller.php');

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

          default:
            home();
            break;
        }
      }else{
        home();
      }