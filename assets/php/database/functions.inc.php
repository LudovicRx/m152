<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Fonctions sur la base de données
// Version   :   1.0, 01.02.21, LR, version initiale

require_once(__DIR__ . DIRECTORY_SEPARATOR . "database.inc.php");

/**
 * Gets the id of the last post
 *
 * @return int|bool
 */
function getLastPost() {
    static $ps = null;
    $db = connectDB();
    $sql = "SELECT idPost FROM POST ORDER BY idPost DESC LIMIT 1";

    $answer = false;
    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        if($ps->execute()) {
            return $ps->fetch()["idPost"];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Vérifie si l nom d'une image existe déjà
 *
 * @param string $name
 * @return bool true si cela exist déjà
 */
function verifyNameExists($name)
{
    static $ps = null;
    $db = connectDB();
    $sql = "SELECT nomFichierMedia FROM MEDIA WHERE nomFichierMedia LIKE :NOM_FICHIER_MEDIA";

    $answer = false;
    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        $ps->bindParam(':NOM_FICHIER_MEDIA', $name, PDO::PARAM_STR);

        if($ps->execute()) {
            if(count($ps->fetchAll()) > 0) {
                return true;
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Insert un média 
 *
 * @param string $typeMedia
 * @param string $nomFichierMedia
 * @param int $idPost
 * @return bool
 */
function insertMedia($typeMedia, $nomFichierMedia, $idPost)
{
    static $ps = null;
    $db = connectDB();
    $sql = "INSERT INTO MEDIA(typeMedia, nomFichierMedia, idPost) VALUES (:TYPE_MEDIA, :NOM_FICHIER_MEDIA, :ID_POST)";

    $answer = false;
    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        $ps->bindParam(':TYPE_MEDIA', $typeMedia, PDO::PARAM_STR);
        $ps->bindParam(':NOM_FICHIER_MEDIA', $nomFichierMedia, PDO::PARAM_STR);
        $ps->bindParam(':ID_POST', $idPost, PDO::PARAM_INT);

        return $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Insert un nouveau post
 *
 * @param string $commentaire
 * @return bool
 */
function insertPost($commentaire)
{
    static $ps = null;
    $db = connectDB();
    $sql = "INSERT INTO POST(commentaire) VALUES (:COMMENTAIRE)";

    $answer = false;
    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        $ps->bindParam(':COMMENTAIRE', $commentaire, PDO::PARAM_STR);

        return $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $answer;
}
