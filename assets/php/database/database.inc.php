<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Connexion à la base de donnée
// Version   :   1.0, 01.02.21, LR, version initiale

include_once(__DIR__ . DIRECTORY_SEPARATOR ."const.inc.php");

/**
 * Se connecte à la base de donnée
 * Le script meurt (die) si la connexion n'est pas possible.
 * @staticvar PDO $dbc
 * @return PDO base de donnée
 */
function connectDB()
{
  static $dbc = null;

  // Première visite de la fonction
  if ($dbc == null) {
    // Essaie le code ci-dessous
    try {
      $dbc = new PDO('mysql:host=' . DB_IP . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_PERSISTENT => true
      ));
    }
    // Si une exception est arrivée
    catch (Exception $e) {
      echo 'Erreur : ' . $e->getMessage() . '<br />';
      echo 'N° : ' . $e->getCode();
      // Quitte le script et meurt
      die('Could not connect to MySQL');
    }
  }
  // Pas d'erreur, retourne un connecteur
  return $dbc;
}
