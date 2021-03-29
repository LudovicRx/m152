<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Page qui permet de faire des posts
// Version   :   1.0, 08.02.21, LR, version initiale
define("MAX_MEDIA_SIZE", 7000000); // Taille maximum du media 
define("MAX_POST_SIZE", 70000000); // Taille maximum du dossier

require_once(__DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "app.inc.php");

$errors = array();
$comment = "";
$idPost = 0;
$medias = array();
$insertedMedias = array();
$selectedMedias = array();
if (filter_input(INPUT_GET, "idPost", FILTER_VALIDATE_INT)) {
    $idPost = intval(filter_input(INPUT_GET, "idPost", FILTER_SANITIZE_NUMBER_INT));
}

if ($idPost !== 0) {
    $comment = getCommentFromPost($idPost);
    $insertedMedias = getMediasFromPost($idPost);
}

//  Si on a appuyé sur le bouton submit
if (filter_input(INPUT_POST, NAME_SUBMIT_POST, FILTER_SANITIZE_STRING)) {
    // Commentaire
    $comment = filter_input(INPUT_POST, NAME_INPUT_COMMENT, FILTER_SANITIZE_STRING);


    // Si le commentaire est valide
    if ($comment) {

        $selectedMedias = filter_input(INPUT_POST, "media", FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

        // Si l'insertion du post marche
        if (dbStartTransaction() && updatePost($idPost, $comment)) {
            // Si l'id du post est valide
            if ($idPost) {

                $mediasToDelete = getMediasToDelete($medias, $selectedMedias);
                for ($i = 0; $i < count($mediasToDelete); $i++) {
                    if (!deleteMedia($mediasToDelete[$i])) {
                        array_push($errors, "Echec du delete d'un media dans la base de donnée");
                    }
                }

                // Récupère les medias
                $medias = $_FILES[NAME_INPUT_FILE];
                // Vérifie que les medias ne sont pas trop lourdes, et que le total n'est pas trop lourd
                // L'erreur 4 indique qu'aucun fichier n'a été téléchargé, alors on vérifie s'il y a des medias qui ont été téléchargées
                if ($medias["error"][0] != 4 && canUploadMedias($medias, MAX_MEDIA_SIZE, MAX_POST_SIZE)) {
                    // Parcoure chaque media
                    for ($i = 0; $i < count($medias['name']); $i++) {
                        // Vérifie que l'image ou la vidéo est du bon type
                        if (IsImage($medias['type'][$i]) || IsVideo($medias['type'][$i]) || IsAudio($medias["type"][$i])) {
                            // Crée un nom unique
                            $uniqueName = createUniqueName("media_", $medias["name"][$i]);
                            // Insert le média dans la base de donnée
                            if (insertMedia($medias['type'][$i], $uniqueName, $idPost)) {
                                // Si l'insertion dans la base de donnée a réussi, on insert le fichier dans le serveur
                                if (!move_uploaded_file($medias['tmp_name'][$i], MEDIA_PATH . $uniqueName)) {
                                    array_push($errors, "Echec lors de l'importation du média sur le serveur.");
                                }
                            } else {
                                array_push($errors, "Echec lors de l'importation du média dans la base de données.");
                            }
                        } else {
                            array_push($errors, "Le type du fichier doit être un media.");
                        }
                    }
                }

                // S'il y a eu des errurs, il fait un rollback
                if (count($errors) == 0) {
                    // Fait une redirection sur la page index s'il n'y a a pas eu d'erreur
                    dbCommitTransaction();
                    for ($i = 0; $i < count($mediasToDelete); $i++) {
                        // https://stackoverflow.com/questions/4742903/php-find-entry-by-object-property-from-an-array-of-objects
                        $media = $insertedMedias[array_search($mediasToDelete[$i], array_column($insertedMedias, "idMedia"))];
                        unlink(MEDIA_PATH . $media["nomFichierMedia"]);
                    }

                    header("Location: index.php?success=1");
                    exit();
                } else {
                    dbRollBack();
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
    <link href="assets/css/post.css" rel="stylesheet">
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
                                        Modifier un post
                                    </h2>
                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        <div class="row form-group">
                                            <textarea class="form-control" name="<?= NAME_INPUT_COMMENT ?>"><?= $comment ?></textarea>
                                        </div>
                                        <div class="row form-group">
                                            Choisissez une image ou une vidéo : <input class="form-control" type="file" name="<?= NAME_INPUT_FILE ?>[]" multiple accept="image/*,video/*,audio/*">

                                        </div>
                                        <div class="row form-group">
                                            <?= showMediasCheckbox($insertedMedias) ?>
                                        </div>
                                        <div class="row form-group">
                                            <input class="form-control" type="submit" name="<?= NAME_SUBMIT_POST ?>">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?= showErrors($errors) ?>
                    </div>


                    <?php include_once(VIEW_PATH . "footer.inc.php") ?>

                </div>
            </div>
        </div>
        <?php include_once(VIEW_PATH . "js.inc.php") ?>

</body>

</html>