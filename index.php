<!DOCTYPE html>
<html>

<head>
    <title> Multiple Image upload using dropzone.js in PHP </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <style>
        input.position-absolute.btn.btn-primary.fs-5.px-5 {
            left: 41%;
            bottom: -16px;
        }

        .cstm-buttons-bar {
            margin-top: 8px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row align-items-center justify-content-center" style="height:100vh;">
            <div class="col-md-6 border pb-2 shadow-lg rounded-3">
                <div class="pb-2 pt-2 position-relative">
                    <h2 class="text-center text-primary">DropZone Image Uploader</h2>
                    <form action="display.php" method="post" enctype="multipart/form-data">
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

        let customTemplate = `
        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img style="transform: rotate(0deg);" data-dz-thumbnail rotated="0"></div>
            <div class="dz-details">
                <div class="dz-size" data-dz-size></div>
                <div class="dz-filename">
                <span data-dz-name></span>
                </div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
            <div class="dz-success-mark"><span>✔</span></div>
            <div class="dz-error-mark"><span>✘</span></div>
            <div class="mt-1 d-flex justify-content-between px-2">
                <button type="button" role="button" style="width: 30px; height: 30px;" class="border-0 text-white text-center d-flex align-items-center justify-content-center bg-danger rounded-circle" data-dz-remove>
                    <i role="button" class="fa fa-trash fs-5" aria-hidden="true"></i>
                </button>
                <button type="button" role="button" style="width: 30px; height: 30px;" class="border-0 text-white text-center d-flex align-items-center justify-content-center bg-primary rounded-circle rotate" >
                    <i role="button" class="fa fa-repeat" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        `;

        let imagesNames = [];
        index = 0 ;
        Dropzone.autoDiscover = false;
        var myDropZone = new Dropzone("#image-upload", {
            url: 'upload.php',
            parallelUploads: 500,
            uploadMultiple: true,
            autoProcessQueue: false,
            previewTemplate: customTemplate
        });
        myDropZone.on("sending", function (file, xhr, formdata) {
            rotationDeg = $(file.previewElement.children[0].children[0]).attr('rotated') ;
            formdata.append(file.name, rotationDeg);
            console.log("Sending Called");
        });

        myDropZone.on("complete", function (file) {
            console.log("complete Called");
            !imagesNames.includes(file.name) ? imagesNames.push(file.name) : ""
            $('[type="hidden"]').val(imagesNames.join(","));
            myDropZone.getUploadingFiles().length==0?document.querySelectorAll("#submit-final")[0].click():"";
        });

        $(document).ready(function () {

            $("#submit").on("click", function (e) {
                e.preventDefault();
                myDropZone.processQueue();
            })

            $(document).on("click" , ".rotate" , function(){
                let RotatedAngle  = parseInt($(this).parent().parent().find('.dz-image img').attr('rotated'));
                console.log(RotatedAngle)
                if(RotatedAngle < 270){
                    console.log(`${RotatedAngle+90}`)
                    $(this).parent().parent().find('.dz-image img').css(`transform` , `rotate(${RotatedAngle+90}deg)`).attr('rotated' , `${RotatedAngle+90}`);
                }else{
                    $(this).parent().parent().find('.dz-image img').css(`transform` , `rotate(0deg)`).attr('rotated' , `0}`);
                }
            })



        })





    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>