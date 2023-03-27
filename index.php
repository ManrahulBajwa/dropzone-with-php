<!DOCTYPE html>  
<html>  
<head>  
    <title> Multiple Image upload using dropzone.js in PHP </title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>  
    <style>
        input.position-absolute.btn.btn-primary.fs-5.px-5 {
            left: 41%;
            bottom: -16px;
        }
    </style>
</head>  
<body>  
  
    <div class="container">  
        <div class="row align-items-center justify-content-center" style="height:100vh;">  
            <div class="col-md-6 border pb-2 shadow-lg rounded-3">  
            <div class="pb-2 pt-2 position-relative">  
                <h2 class="text-center text-primary">DropZone Image Uploader</h2>  
                <form action="display.php" method="post" enctype="multipart/form-data" >  
                    <div class="dropzone rounded-3" id="image-upload">  
                    </div>  
                    <input name="images" type="hidden" value="" />
                    <input type="submit" id="submit-final" style="display:none;" />
                    <input id="submit" class="btn btn-primary fs-5 px-5 w-100 mt-3" type="submit" value="Submit" />
                </form>  
            </div>
            </div>  
        </div>  
    </div>  
  
    <script type="text/javascript">  

        let imagesNames = [] ;
        Dropzone.autoDiscover = false;
        var myDropZone = new Dropzone("#image-upload", {
            url:'upload.php',
            addRemoveLinks: true,
            parallelUploads: 500,
            uploadMultiple: true,
            autoProcessQueue : false
        });
        document.querySelectorAll("#submit")[0].addEventListener("click" , function(e){
            e.preventDefault();
            myDropZone.processQueue();
        })
        myDropZone.on("complete", function(file) {
            !imagesNames.includes(file.name)?imagesNames.push(file.name):""
            document.querySelectorAll('[type="hidden"]')[0].value = imagesNames.join(",");
            myDropZone.getUploadingFiles().length==0?document.querySelectorAll("#submit-final")[0].click():"";
        });
    </script>  
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>  
</html>  