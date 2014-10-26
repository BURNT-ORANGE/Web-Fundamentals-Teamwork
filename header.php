<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $title; echo $title;?></title>       
     <?php
        $variable=$css;
        $js_link;
        $array=explode(',', $variable);
        foreach ($array as  $value) {
            echo $value;
        }       
        if(!empty($js_link)) {
            echo $js_link;
        }
    ?>
</head>
<body>
