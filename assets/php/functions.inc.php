<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Fonctions générales
// Version   :   1.0, 08.02.21, LR, version initiale

/**
 * Verify if we can upload the images in the site
 *
 * @param array $images all the images
 * @param int $maxImgSize maximum size of the image
 * @param int $maxSizeDir maximum size of the dir   
 * @return boolean true if can upload, else false
 */
function canUploadMedias($images, $maxImgSize, $maxTotalImagesSize)
{
    $totalSize = 0;
    for ($i = 0; $i < count($images["name"]); $i++) {
        $totalSize += $images["size"][$i];
        if ($images["size"][$i] >= $maxImgSize) {
            return false;
        }
    }

    if ($totalSize >= $maxTotalImagesSize) {
        return false;
    }
    return true;
}

/**
 * Create a unique name
 *
 * @param string $prefix prefix for the file
 * @param string $name name of the file to get the extension
 * @return string the unique name
 */
function createUniqueName($prefix, $name)
{
    return uniqid($prefix, true) . "." . pathinfo($name, PATHINFO_EXTENSION);
}

/**
 * Show the post with the medias
 *
 * @param array $posts posts with the medias
 * @return string result as HTML
 */
function showPosts($posts)
{
    $answer = "";
    foreach ($posts as $key => $post) {
        $answer .= '<div class="panel panel-default">';
        $answer .= '<div class="panel-thumbnail">';
        foreach ($post["medias"] as $key => $value) {
            if (IsImage($value["typeMedia"])) {
                $answer .= '<img src="assets/img/media/' . $value["nomFichierMedia"] . '" class="img-responsive">';
            } else if (IsVideo($value["typeMedia"])) {
                $answer .= "<video muted autoplay controls loop>";
                $answer .= '<source src="assets/img/media/' . $value["nomFichierMedia"] . '">';
                $answer .= "Your browser does not support the video tag.";
                $answer .= "</video>";
            }
        }
        $answer .= '</div>';
        $answer .= '<div class="panel-body">';
        // $answer .= '<p class="lead">Social Good</p>';
        $answer .= '<p class="lead">' . $post["commentaire"];

        // Icone pour supprimer
        $answer .= '<button type="button" class="btn btn-danger float-end"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg></button>';

        // Icone pour modifier
        $answer .= '<button type="button" class="btn btn-success float-end"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
         <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
       </svg></button>';


        $answer .= '</p>';

        $answer .= '</div>';
        $answer .= "</div>";
    }

    return $answer;
}

/**
 * Show the errors when you try to insert a post
 *
 * @param array $errors errors that are stored in a array
 * @return string result as HTML
 */
function showErrors($errors)
{
    $result = "";
    foreach ($errors as $key => $error) {
        $result .= "<div>$error</div>";
    }
    return $result;
}

/**
 * Verify if this is an image
 *
 * @param string $type name of the type to verify
 * @return bool trus if image, else false
 */
function IsImage($type)
{
    return strpos($type, "image") === 0;
}

/**
 * Verify if this is a video
 *
 * @param string $type name of the type to verify
 * @return bool true if video, else false
 */
function IsVideo($type)
{
    return strpos($type, "video") === 0;
}
