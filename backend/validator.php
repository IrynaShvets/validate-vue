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


header('Content-Type: application/json');

// echo json_encode($input);


$titleErr = $annotationErr = $contentErr = $emailErr = $viewsErr = $dateErr = $publishInIndexErr = $categoryErr = "";
$title = $annotation = $content = $email = $views = $date = $publishInIndex = $category = "";
$valid = true;

    if (empty($input['title'])) {
        $valid = false;
        $titleErr = "Поле заголовок не повинно бути порожнім";
    } else {
        $title = $input["title"];
        if (strlen($title) < 3) {
            $valid = false;
            $titleErr = "Поле заголовок повинно мати не менше трьох символів";
        }
        if (strlen($title) > 255) {
            $valid = false;
            $titleErr = "Поле заголовок повинно мати не більше ніж 255 символів";
        }
    }

    if (isset($input["annotation"])) {
        $annotation = $input["annotation"];
        if (strlen($annotation) > 500) {
            $valid = false;
            $annotationErr = "Поле анотація не повинне перевищувати 500 символів";
        }
    }

    if (isset($input["content"])) {
        $content = $input["content"];
        if (strlen($content) > 30000) {
            $valid = false;
            $contentErr = "Поле контенту не повинно перевищувати 30 000 символів";
        }
    }

    if (empty($input["email"])) {
        $valid = false;
        $emailErr = "Поле email не повинно бути порожнім";
    } else {
        $email = $input["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $emailErr = "Поле email має бути валідним email";
        }
    }
    
    if (isset($input["views"])) {
        $views = $input["views"];

        if (!filter_var($views, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0 , "max_range"=> 2147483647]]) !== false) {
            $valid = false;
            $viewsErr = "Кількість переглядів має бути числом, не повинно бути негативним і в межах розміру UNSIGNED INT";
        };
    }
   
    // if (isset($input["date"])) {
    //     $date = $input["date"];
    //     $current = date('Y-m-d');
    //     echo $date;
    //     echo $current;
    //     if ($date < $current) {
    //         $dateErr = "Дата публікації не повинна бути раніше поточної дати";
    //     }
    // }

    if (empty($input["publish_in_index"])) {
        $valid = false;
        $publishInIndexErr = "Поле публікувати на головній має бути обов'язковим";
    }
     else {
        $publishInIndex = $input["publish_in_index"];
        if ($publishInIndex === true || $publishInIndex === false) {
            $valid = false;
            $publishInIndexErr = "Поле публікувати на головній має містити значення 'yes' або 'no'";
        }
    }

    if (isset($input["category"])) {
        $selectArr = [1, 2, 3];
       if (!in_array($input["category"], $selectArr)) {
        $valid = false;
        $categoryErr = "Поле категрія має бути одним із значень [1, 2, 3]";
       }
    } else {
        if (is_integer($input["category"])) {
            $valid = false;
        $categoryErr = "Поле категрія має бути числом";
        }
    }

    if ($valid === true && isset($input)) {
        $title = $input["title"] ?  $input["title"]: '';
        $annotation = $input['annotation'] ?  $input["annotation"]: '';
        $content = $input['content'] ? $input["content"] : '';
        $email = $input['email'] ? $input["email"]: '';
        $views = $input['views'] ? $input["views"]: '';
        $date = $input['date'] ? $input["date"]: '';
        $publishInIndex = $input['publish_in_index'] ? $input["publish_in_index"]: '';
        $category = $input['category'] ? $input["category"]: '';
    }

    $errorsArr = [
       1 => ['valid' => $valid,],
       2 => ['title' => $titleErr, 'annotation' => $annotationErr, 'content' => $contentErr, 'email' => $emailErr, 'views' => $viewsErr, 'date' => $dateErr, 'publishInIndex' => $publishInIndexErr, 'category' => $categoryErr]
    ];
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['errors' => $errorsArr], JSON_UNESCAPED_UNICODE);
    die();
   

?>