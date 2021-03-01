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
function canUploadImages($images, $maxImgSize, $maxTotalImagesSize)
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

function showPosts($posts)
{
    $answer = "";
    foreach ($posts as $key => $post) {
        $answer .= '<div class="panel panel-default">';
        $answer .= '<div class="panel-thumbnail">';
        foreach ($post["images"] as $key => $value) {
            $answer .= '<img src="assets/img/' . IMAGE_PATH . $value . '" class="img-responsive">';
        }
        $answer .= '</div>';
        $answer .= '<div class="panel-body">';
        $answer .= "</div>";
        $answer .= '<p class="lead">Social Good</p>';
        $answer .= '<p>' . $post["commentaire"] . '</p>';
        $answer .= '</div>';
        $answer .= '</div>';
    }


    // 	
    // 		
    // 		

    // 		
    // 			<img src="assets/img/photo.jpg" height="28px" width="28px">
    // 			<img src="assets/img/photo.png" height="28px" width="28px">
    // 			<img src="assets/img/photo_002.jpg" height="28px" width="28px">
    // 		</p>
    // 	
    // <?php
    return false;
}
