<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Fichier qui link tous les autres fichiers php
// Version   :   1.0, 01.02.21, LR, version initiale

define("VIEW_PATH", __DIR__ . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR);// Chemin pour les fichiers du type vue (qui contiennent de l'HTML principalement)
define("DATABASE_PATH", __DIR__ . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR);// Chemin pour les fichier php qui concernent la db

require_once(DATABASE_PATH . "functions.inc.php");