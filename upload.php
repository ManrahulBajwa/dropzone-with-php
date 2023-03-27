<?php 
$rotations = [];
foreach($_POST as $rotaion){
    array_push($rotations , $rotaion);
}
print_r($rotations);


if(!empty($_FILES)){ 
    $i = 0 ;
    foreach($_FILES['file']['name'] as $fileName){
        $filePath = "uploads/".basename($fileName); 
        $fileTemp = $_FILES['file']['tmp_name'][0]; 
        $fileType = $_FILES['file']['type'][0]; 
        $rotation = -$rotations[$i];


        switch($fileType){ 
            case 'image/png': 
                $source = imagecreatefrompng($fileTemp); 
                break; 
            case 'image/gif': 
                $source = imagecreatefromgif($fileTemp); 
                break; 
            default: 
                $source = imagecreatefromjpeg($fileTemp); 
        } 
        $imageRotate = imagerotate($source, $rotation, 0); 

        switch($fileType){ 
            case 'image/png': 
                $upload = imagepng($imageRotate, $filePath); 
                break; 
            case 'image/gif': 
                $upload = imagegif($imageRotate, $filePath); 
                break; 
            default: 
                $upload = imagejpeg($imageRotate, $filePath); 
        } 






        // $uploadFilePath = $uploadDir.$fileName; 
        // move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);
        $i++ ;
    };
} 
?>