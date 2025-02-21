<?php
use core\Response;
function routeToController($url,$routes){   
   
    if(array_key_exists($url,$routes)){        
        require base_path($routes[$url]);
    }else{
        abort();
    }

}
function abort($statusCode =404){
    require base_path("view/{$statusCode}.php");
    die();
}
function dd($value){
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
function authorize($condition,$statustCode = Response::HTTP_FORBIDDEN){
    if(!$condition){
        abort($statustCode);
    }
}
function base_path($path){
    //  just for reference BASE_PATH = __DIR__.'/../';
    return BASE_PATH . $path;
}
function views($path , $data = []){
    extract($data);
    require base_path("view/{$path}");
}
function login($user){
    $_SESSION['user'] = $user;
    session_regenerate_id(true);
}
function logout(){
    session_unset();
    session_destroy();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain']);
   
}
function redirect($path){
    header("location: {$path}");
    exit();

}
function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function groupExpensesByMonth($results) {
    $months = [];
    foreach ($results as $row) {
        if (!isset($row['date'])) {
            continue;
        }
        $month = date('F Y', strtotime($row['date'])); 
        if (!isset($months[$month])) {
            $months[$month] = ['total' => 0, 'expenses' => []];
        }
        $months[$month]['expenses'][] = $row;
        $months[$month]['total'] += $row['amount'];
    }
    return $months;
}

function groupExpensesByCategory($results) {
    $categories = [];
    foreach ($results as $row) {
        if (!isset($row['category'])) {
            continue;
        }
        $category = $row['category'];
        if (!isset($categories[$category])) {
            $categories[$category] = ['total' => 0, 'expenses' => []];
        }
        $categories[$category]['expenses'][] = $row;
        $categories[$category]['total'] += $row['amount'];
    }
    return $categories;
}
function findMax($results) {
    $maxCosts = [];
    foreach ($results as $result) {
        if (!isset($result['date']) || !isset($result['category']) || !isset($result['amount'])) {
            continue;
        }
        
        $month = date('Y-m', strtotime($result['date']));
        $category = $result['category'];
        
        if (!isset($maxCosts[$category])) {
            $maxCosts[$category] = [];
        }
        
        if (!isset($maxCosts[$category][$month])) {
            $maxCosts[$category][$month] = $result['amount'];
        } else {
            $maxCosts[$category][$month] = max($maxCosts[$category][$month], $result['amount']);
        }
    }
    return $maxCosts;
}

?>