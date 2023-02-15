<?php
session_start();

function cors()
{
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        }

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        }

        exit(0);
    }
}
cors();

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

var_dump($input);

// $titleErr = $annotationErr = $contentErr = $emailErr = $viewsErr = $dateErr = $publishInIndexErr = $categoryErr = "";
// $title = $annotation = $content = $email = $views = $date = $publishInIndex = $category = "";
// $valid = true;
// if (isset($_POST['submit'])) {

//     if (empty($_POST['title'])) {
//         $valid = false;
//         $titleErr = "Поле заголовок не повинно бути порожнім";
//     } else {
//         $title = $_POST["title"];
//         if (strlen($title) < 3) {
//             $valid = false;
//             $titleErr = "Поле заголовок повинно мати не менше трьох символів";
//         }
//         if (strlen($title) > 255) {
//             $valid = false;
//             $titleErr = "Поле заголовок повинно мати не більше ніж 255 символів";
//         }
//     }

//     if (isset($_POST["annotation"])) {
//         $annotation = $_POST["annotation"];
//         if (strlen($annotation) > 500) {
//             $valid = false;
//             $annotationErr = "Поле анотація не повинне перевищувати 500 символів";
//         }
//     }

//     if (isset($_POST["content"])) {
//         $content = $_POST["content"];
//         if (strlen($content) > 30000) {
//             $valid = false;
//             $contentErr = "Поле контенту не повинно перевищувати 30 000 символів";
//         }
//     }

//     if (empty($_POST["email"])) {
//         $valid = false;
//         $emailErr = "Поле email не повинно бути порожнім";
//     } else {
//         $email = $_POST["email"];
//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $valid = false;
//             $emailErr = "Поле email має бути валідним email";
//         }
//     }
    
//     if (isset($_POST["views"])) {
//         $views = $_POST["views"];
//         if (!filter_var($views, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0 , "max_range"=> 2147483647]]) !== false) {
//             $valid = false;
//             $viewsErr = "Кількість переглядів має бути числом, не повинно бути негативним і в межах розміру UNSIGNED INT";
//         }
//     }
   
//     if (isset($_POST["date"])) {
//         $date = $_POST["date"];
//         if (strtotime($date) < time()) {
//             echo strtotime($date) . '<br>';
//             echo time() . '<br>';
//             $valid = false;
//             $dateErr = "Дата публікації не повинна бути раніше поточної дати";
//         }
//     }

//     if (empty($_POST["publish_in_index"])) {
//         $valid = false;
//         $publishInIndexErr = "Поле публікувати на головній має бути обов'язковим";
//     }
//      else {
//         $publishInIndex = $_POST["publish_in_index"];
//         if ($publishInIndex !== 'yes' && $publishInIndex !== 'no') {
//             $valid = false;
//             $publishInIndexErr = "Поле публікувати на головній має містити значення 'yes' або 'no'";
//         }
//     }

//     if ($valid === true && isset($_POST['submit'])) {
//         $title = $_POST["title"] ?  $_POST["title"]: '';
//         $annotation = $_POST['annotation'] ?  $_POST["annotation"]: '';
//         $content = $_POST['content'] ? $_POST["content"] : '';
//         $email = $_POST['email'] ? $_POST["email"]: '';
//         $views = $_POST['views'] ? $_POST["views"]: '';
//         $date = $_POST['date'] ? $_POST["date"]: '';
//         $publishInIndex = $_POST['publish_in_index'] ? $_POST["publish_in_index"]: '';
//         $category = $_POST['category'] ? $_POST["category"]: '';

//         echo $title . '<br>';
//         echo $annotation . '<br>';
//         echo $content . '<br>';
//         echo $email . '<br>';
//         echo $views . '<br>';
//         echo $date . '<br>';
//         echo $publishInIndex . '<br>';
//         echo $category . '<br>';
//     }

// }



?>