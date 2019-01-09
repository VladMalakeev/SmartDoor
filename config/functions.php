<?php
if(!defined('KEY'))
{
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('../404.html'));
}
function showErrorMessage($errors){
$data = "<ul class='errors'>";
    foreach ($errors as  $error){
        $data .= '<li>'.$error.'</li>';
    }
   $data .= "</ul>";
    return  $data;
}