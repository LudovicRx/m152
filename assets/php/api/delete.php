<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "app.inc.php");

$redirect = "../../../index.php";

// Vérifie si le paramètre GET est un int
if (filter_input(INPUT_GET, "idPost", FILTER_VALIDATE_INT)) {
    $idPost = intval(filter_input(INPUT_GET, "idPost", FILTER_SANITIZE_NUMBER_INT));
    $medias = getMediasFromPost($idPost);
    $errors = array();

    // Commence la transaction
    dbStartTransaction();
    
    // Supprime le post 
    if (!deletePost($idPost)) {
        array_push($errors, "Error DB");
    }

    // Supprimer les médias en local
    foreach ($medias as $key => $media) {
        if (!unlink(MEDIA_PATH . $media["nomFichierMedia"])) {
            array_push($errors, $e->getMessage());
        }
    }

    $redirect .= "?successDelete=";
    if (count($errors) === 0) {
        // Commit a transaciton s'il n'y a pas eu d'erreur
        dbCommitTransaction();
        $redirect .= "1";
    } else {
        // Fait un rollback s'il y a eu des erreurs
        dbRollBack();
        $redirect .= "0";
    }
}

// Redirection sur la page d'index
header("Location: $redirect");
