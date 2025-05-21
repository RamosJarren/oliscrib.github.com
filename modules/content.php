<?php 
$page = ""; 
if (isset($_GET['page'])) { 
    $page = $_GET['page']; 
} 

$isLoggedIn = isset($_SESSION['loginok']); 

$restrictedPages = ['checkout', 'admin'];

if ($isLoggedIn || !in_array($page, $restrictedPages)) { 
    switch ($page) { 
        case "home": 
            include("home.php"); 
            break;
        case "products": 
            include("products.php"); 
            break;
        case "about": 
            include("about.php"); 
            break;
        case "contact": 
            include("contact.php"); 
            break;
        case "checkout": 
            include("checkout.php"); 
            break;
        case "checkout_payment":
            include("payment.php");
            break;
        case "admin": 
            include("admin_dashboard.php"); 
            break;
         case "inventory":
            include("inventory.php");
            break;
        case "items": 
            include("admin_items.php"); 
            break; 
        case "accounts": 
            include("admin_accounts.php"); 
            break;
        case "payment": 
            include("admin_payment.php"); 
            break;
        case "results": 
            include("results.php"); 
            break; 
        case "views": 
            include("views.php"); 
            break;
        case "user":
            include("user.php");
            break;
        case "items_add": 
            include("items_add.php"); 
            break;
        case "items_edit": 
            include("items_edit.php"); 
            break;
        case "deliveries":
            include("deliveries.php");
            break;
        case "stocks_edit": 
            include("stocks_edit.php"); 
            break; 
        case "accounts_add": 
            include("accounts_add.php"); 
            break;
        case "accounts_edit": 
            include("accounts_edit.php"); 
            break;
        case "template":
            include("template.php");
            break;
        default: 
            include("error.php"); 
    } 
} else { 
    include("login.php");   
} 
?>