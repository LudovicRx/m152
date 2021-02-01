<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Fichier qui contient les constantes de chemin d'accès
// Version   :   1.0, 01.02.21, LR, version initiale

define("IMAGE_PATH", __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR); // Contient le chemin pour ajouter les images
define("VIEW_PATH", __DIR__ . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR); // Chemin pour les fichiers du type vue (qui contiennent de l'HTML principalement)
define("DATABASE_PATH", __DIR__ . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR);// Chemin pour les fichier php qui concernent la db