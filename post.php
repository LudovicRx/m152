<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Page qui permet de faire des posts
// Version   :   1.0, 01.02.21, LR, version initiale

require_once(__DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "app.inc.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">

                <!-- main right col -->
                <div class="column col-md-12 col-sm-12" id="main">

                    <?php include_once(VIEW_PATH . "topNav.inc.php") ?>

                    <div class="padding">
                        <div class="full col-sm-9">

                            <!-- content -->
                            <div class="row">
                                <div class="well">
                                    <h2>
                                        Ajouter un post
                                    </h2>
                                    <form action="" enctype="multipart/form-data">
                                        <div class="row form-group">
                                            <textarea class="form-control" name="text"></textarea>
                                        </div>
                                        <div class="row form-group">
                                            Choisissez une image : <input class="form-control" type="file" name="img[]" multiple accept="image/*">

                                        </div>
                                        <div class="row form-group">
                                            <input class="form-control" type="submit">
                                            <div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php include_once(VIEW_PATH . "footer.inc.php") ?>

                </div>
            </div>
        </div>
        <?php include_once(VIEW_PATH . "js.inc.php") ?>

</body>

</html>