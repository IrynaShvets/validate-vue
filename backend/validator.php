<?php


if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $annotation = $_POST['annotation'];
    $content = $_POST['content'];
    $email = $_POST['email'];
    $views = $_POST['views'];
    $date = $_POST['date'];
    $isPublish = $_POST['is_publish'];
    $publishInIndex = $_POST['publish_in_index'];
    $category = $_POST['category'];

    echo $title . '<br>';
    echo $annotation . '<br>';
    echo $content . '<br>';
    echo $email . '<br>';
    echo $views . '<br>';
    echo $date . '<br>';
    echo $isPublish . '<br>';
    echo $publishInIndex . '<br>';
    echo $category . '<br>';

}

header('Location: http://localhost:8080/');

?>