<?php 
if(!empty($_FILES)){ 
    $i = 0 ;
    foreach($_FILES['file']['name'] as $fileName){
        $uploadDir = "uploads/"; 
        $uploadFilePath = $uploadDir.$fileName; 
        move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);
        $i++ ;
    };
} 
?>