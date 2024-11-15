<?php
    if (!isset($upload)) {
        $upload = "upload.php";
    }
    if (!isset($uploadText)) {
        $uploadText = "Drop your files here or select them.";
    }
?>

<div
    id="drop_zone"
    ondrop="dropHandler(event);"
    ondragover="dragOverHandler(event);"
    ondragleave="dragLeave(event);"
    onclick="fileExplore();">
    <p id="drop_zone_text"><?php echo $uploadText; ?></p>
    <form id="form" enctype="multipart/form-data">
        <input type="file" id="file" name="filesToUpload[]" onchange="selectDone()">
        <?php
            if (isset($fileName)) {
                echo '<input type="hidden" name="id" value="' . $fileName . '">';
            }
        ?>
    </form>
    <p id="poweredby"><b>Powered by</b> Alex Cloud API</p>
</div>

<style>
    #drop_zone {
        border: 3px #CCC dotted;
        border-radius: 10px;
        padding: 20px;
        transition: all 0.2s;
        position: relative;
        width: calc(100% - 40px);
        height: calc(100% - 40px);
    }
    #poweredby {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 12px;
        color: #666;
    }
    .dropOver {
        border-style: solid !important;
    }
    .dropped {
        border: 3px #06d6a0 dotted !important;
        text-align: center;
    }
    #drop_zone a {
        background-color: #06d6a0;
        padding: 10px;
        border-radius: 5px;
        margin: auto;
        color: #FFF;
        text-decoration: none;
    }
    #file {
        display: none;
    }
    .loading-anim {
        padding: 10px;
        border-radius: 5px;
        margin-top: 80px;
        position: relative;
        transform: translate(-15px, -55px);
        z-index: 999;
    }
    .loading-anim svg {
        width: 30px;
        height: 30px;
        fill: #FFF;
    }
    @keyframes rotation {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(359deg);
        }
    }
    #loading1 {
        animation: rotation 0.8s ease-out infinite;
        position: absolute;
        left: 50%;
    }
    #loading2 {
        animation: rotation 0.8s ease-in-out infinite;
        position: absolute;
        left: 50%;
    }
    xmp {
        margin: 0;
        display: inline;
    }
</style>

<script src="https://developer.alexsofonea.com/cloud/jquery.js"></script>

<script>
    function show(el) {
        if (el != "upload_error")
            document.querySelector("#drop_zone").outerHTML += `<a href='/design/demo/${el}' target='_blank'>${el}</a>`;
    }
    function dropHandler(ev) {
        document.getElementById("drop_zone").classList.remove("dropOver");
        document.getElementById("drop_zone").classList.add("dropped");
        document.getElementById("drop_zone_text").innerHTML = "<a href='javascript:upload();'>Start uploading</a>";

        ev.preventDefault();

        const dataTransfer = new DataTransfer();

        if (ev.dataTransfer.items) {
            [...ev.dataTransfer.items].forEach((item, i) => {
            if (item.kind === "file") {
                dataTransfer.items.add(item.getAsFile());
            }
            });
        } else {
            [...ev.dataTransfer.files].forEach((file, i) => {
                dataTransfer.items.add(item.getAsFile());
            });
        }
        document.getElementById('file').files = dataTransfer.files;
    }
    function selectDone() {
        upload();
    }
    function dragOverHandler(ev) {
        document.getElementById("drop_zone").classList.add("dropOver");
        ev.preventDefault();
    }
    function dragLeave(ev) {
        document.getElementById("drop_zone").classList.remove("dropOver");
        ev.preventDefault();
    }
    function fileExplore() {
        if (document.getElementById('file').files.length == 0)
            document.getElementById("file").click();
    }
    function upload() {
        document.getElementById("drop_zone").classList.remove("dropOver");
        document.getElementById("drop_zone_text").innerHTML = '<svg class="loader" viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>';

        var formData = new FormData(document.getElementById("form"));
        $.ajax({
            url: "<?php echo $upload; ?>",
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);
                if (!data.includes("error")) {
                    setTimeout(function () {
                        removeLoading();
                    }, 500);
                    <?php
                        if (isset($otherFunc)) {
                            echo $otherFunc;
                        }
                    ?>
                } else {
                    document.getElementById("drop_zone").classList.remove("dropped");
                    document.getElementById("drop_zone_text").innerHTML = data;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    function removeLoading() {
        document.getElementById("drop_zone_text").innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg> Your files were uploaded.';
        setTimeout(function () {
            document.getElementById("drop_zone").classList.remove("dropped");
            document.getElementById("drop_zone_text").innerHTML = '<?php echo $uploadText; ?>';
        }, 2000);
    }
</script>