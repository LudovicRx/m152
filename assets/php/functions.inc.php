<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Fonctions générales
// Version   :   1.0, 08.02.21, LR, version initiale

/**
 * Gets the size of the dir 
 *
 * @param string $dir path of the directory
 * @return int size of the dir 
 */
function getSizeDir($dir)
{
    $sizeDir = 0;
    $contentDirectory = scandir($dir);
    foreach ($contentDirectory as $key => $value) {
        if(".." != $value || $value != ".") {
            $sizeDir += filesize($dir . $value);
         }
    }
    return $sizeDir;
}

/**
 * Verify if we can uploadthe file in the site
 *
 * @param int $imgSize size of the image
 * @param int $maxImgSize maximum size of the image
 * @param int $maxSizeDir maximum size of the dir   
 * @param string $dir path of the dir 
 * @return boolean true if can upload, else false
 */
function canUploadFile($imgSize, $maxImgSize, $maxSizeDir, $dir)
{
    $answer = false;
    if ($imgSize <= $maxImgSize &&  getSizeDir($dir) + $imgSize <= $maxSizeDir)
        $answer = true;
    return $answer;
}

/**
 * Create a unique name
 *
 * @param string $prefix prefix for the file
 * @param string $name name of the file to get the extension
 * @return string the unique name
 */
function createUniqueName($prefix, $name) {
    return uniqid($prefix, true) . "." . pathinfo($name, PATHINFO_EXTENSION);
}