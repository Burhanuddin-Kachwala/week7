<?php
$router->get("/","expenses/home.php");
$router->get("/dashboard","expenses/dashboard.php");
$router->post("/add-expense","expenses/store.php");
$router->post("/add-category","expenses/category/store.php");
$router->delete("/destroy","expenses/destroy.php"); 
$router->patch("/edit-expense","expenses/update.php");
$router->patch("/edit-category","expenses/category/update.php");
$router->get('/fetchExpenses', 'expenses/fetchExpense.php');
$router->delete("/destroyCategory","expenses/category/destroy.php"); 



// $router->get("/contact","contact.php");
// $router->get("/about","about.php");

// $router->get("/note/create","notes/create.php");

// $router->post('/note', 'notes/store.php');  
// $router->get("/note","notes/show.php");
// $router->delete("/note","notes/destroy.php"); 
// $router->get("/notes","notes/index.php")->only('auth');

// $router->get('/note/edit', 'notes/edit.php');
// $router->patch('/note', 'notes/update.php');

// $router->get("/register","registration/create.php")->only('guest');
// $router->post("/register","registration/store.php");

// $router->get("/login","sessions/create.php")->only('guest');
// $router->post("/sessions","sessions/store.php")->only('guest');

// $router->delete("/sessions","sessions/destroy.php")->only('auth');


