<?php

if (isset($_POST['submit']) && !empty($_POST['id_user']) && !empty($_POST['MAX_FILE_SIZE']))
{
    if($_FILES['picture']['error'] > 0)
    {
        echo alert_bootstrap("danger", "An <b>error</b> occured during the upload! Please, try again.", "text-align: center;");
        return ;
    }

    if($_FILES['picture']['size'] > $_POST['MAX_FILE_SIZE'])
    {
        echo alert_bootstrap("danger", "<b>Error:</b> The file you select is too big (> 2MB).", "text-align: center;");
        return ;
    }

    $valid_extensions = array('jpg', 'jpeg', 'png');
    $extension_upload = strtolower(substr(strrchr($_FILES['picture']['name'],'.'),1));
    if (!in_array($extension_upload, $valid_extensions))
    {
        echo alert_bootstrap("danger", "<b>Error:</b> File extension is not valid! <b>(Extension authorized: jpg, jpeg, gif, png)</b>", "text-align: center;");
        return ;
    }

    $image_size = getimagesize($_FILES['picture']['tmp_name']);
    $maxwidth = 1000;
    $maxheight = 600;
    if ($image_size[0] > $maxwidth OR $image_size[1] > $maxheight) {
        echo alert_bootstrap("danger", "<b>Error:</b> File dimensions aren't valid! <b>(Max width: 1000/Max height: 600)</b>", "text-align: center;");
        return ;
    }

    $filename = gen_token(40);
    $path = "tmp/{$filename}.{$extension_upload}";
    move_uploaded_file($_FILES['picture']['tmp_name'], $path);
    ?>
    <script>
        var img = document.createElement("img");
        img.setAttribute('src', "<?php echo $path; ?>");
        img.setAttribute('id', 'video');
        img.setAttribute('alt', 'your picture');
        img.setAttribute('class', "col-10 offset-1");

        document.getElementById('video').remove();
        var where = document.getElementById("video-div");
        where.appendChild(img);
    </script>
    <?php
}
?>