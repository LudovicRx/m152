<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Page qui permet de faire des posts
// Version   :   1.0, 08.02.21, LR, version initiale
define("MAX_IMG_SIZE", 3000000); // Taille maximum de l'image
define("MAX_POST_SIZE", 70000000); // Taille maximum du dossier

require_once(__DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "app.inc.php");

$errors = array();
$comment = "";

//  Si on a appuyé sur le bouton submit
if (filter_input(INPUT_POST, NAME_SUBMIT_POST, FILTER_SANITIZE_STRING)) {
    // Commentaire
    $comment = filter_input(INPUT_POST, NAME_INPUT_COMMENT, FILTER_SANITIZE_STRING);

    // Si le commentaire est valide
    if ($comment) {
        // Si l'insertion du post marche
        if (insertPost($comment)) {
            // Récupère l'id du post
            $idPost = getLastPost();
            // Si l'id du post est valide
            if ($idPost) {
                // Récupère les images
                $images = $_FILES[NAME_INPUT_FILE];
                // Vérifie que les image ne sont pas trop lourdes, et que le total n'est pas trop lourd
                if (canUploadImages($images, MAX_IMG_SIZE, MAX_POST_SIZE)) {
                    // Parcoure chaque image
                    for ($i = 0; $i < count($images['name']); $i++) {
                        // Vérifie que l'image est du bon type
                        if (strpos($images['tmp_name'][$i], "image")) {
                            // Crée un nom unique
                            $uniqueName = createUniqueName("img_", $images["name"][$i]);
                            // Insert le média dans la base de donnée
                            if (insertMedia($images['type'][$i], $uniqueName, $idPost)) {
                                // Si l'insertion dans la base de donnée a réussi, on insert le fichier dans le serveur
                                if (!move_uploaded_file($images['tmp_name'][$i], IMAGE_PATH . $uniqueName)) {
                                }
                            }
                        } else {
                            array_push($errors, "Le type du fichier doit être une image.");
                        }
                    }
                }

                if (count($errors) == 0) {
                    // Fait une redirection sur la page index s'il n'y a a pas eu d'erreur
                    header("Location: index.php?success=1");
                }
            }
        }
    }
}


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
                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        <div class="row form-group">
                                            <textarea class="form-control" name="<?= NAME_INPUT_COMMENT ?>"><?= $comment ?></textarea>
                                        </div>
                                        <div class="row form-group">
                                            Choisissez une image : <input class="form-control" type="file" name="<?= NAME_INPUT_FILE ?>[]" multiple accept="image/*">

                                        </div>
                                        <div class="row form-group">
                                            <input class="form-control" type="submit" name="<?= NAME_SUBMIT_POST ?>">
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