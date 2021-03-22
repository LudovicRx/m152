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
function getLastPost()
{
    return intval(connectDB()->lastInsertId());
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

/**
 * Update a post
 *
 * @param integer $idPost id of the post
 * @param string $comment comment of the post
 * @return bool true if wors, else false
 */
function updatePost($idPost, $comment)
{
    static $ps = null;
    $db = connectDB();
    $sql = "UPDATE POST SET commentaire = :COMMENTAIRE WHERE idPost = :ID_POST";

    $answer = false;
    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        $ps->bindParam(':COMMENTAIRE', $comment, PDO::PARAM_STR);
        $ps->bindParam(':ID_POST', $idPost, PDO::PARAM_INT);

        $answer = $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Get posts with the medias corresponding 
 *
 * @param array $posts all the posts 
 * @return array|bool
 */
function getPostsWithMedias($posts)
{
    static $ps = null;
    $db = connectDB();
    $sql = "SELECT nomFichierMedia, typeMedia FROM MEDIA WHERE idPost = :ID_POST";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = $db->prepare($sql);
        }

        if ($posts) {
            $answer = [];
            foreach ($posts as $key => $post) {
                $ps->bindParam(":ID_POST", $post["idPost"], PDO::PARAM_INT);
                $ps->execute();
                $result = $post;
                $result["medias"] = $ps->fetchAll(PDO::FETCH_ASSOC);
                array_push($answer, $result);
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        $answer = false;
    }

    return $answer;
}

/**
 * Get one post thanks to the id
 *
 * @param integer $idPost id of the post
 * @return integer if works, else false
 */
function getPost(int $idPost)
{
    static $ps = null;
    $db = connectDB();
    $sql = "SELECT commentaire FROM POST WHERE idPost = :ID_POST";

    $answer = false;
    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        $ps->bindParam(":ID_POST", $idPost, PDO::PARAM_INT);

        if ($ps->execute()) {
            $answer = $ps->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Get the comment from a post
 *
 * @param integer $idPost id of the post
 * @return integer if works, else false
 */
function getCommentFromPost($idPost)
{
    return getPost($idPost)["commentaire"];
}

/**
 * Get all posts
 *
 * @return bool|array
 */
function getPosts()
{
    static $ps = null;
    $db = connectDB();
    $sql = "SELECT * FROM POST ORDER BY dateDeCreation DESC";

    $answer = false;
    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        if ($ps->execute()) {
            return $ps->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $answer;
}

/**
 * Delete a post and the medias corresponding
 *
 * @param integer $idPost id of the post
 * @return bool, true if succeed, else false
 */
function deletePost(int $idPost)
{
    static $ps = null;
    $db = connectDB();
    $sql = "DELETE FROM POST WHERE idPost = :ID_POST";

    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        $ps->bindParam(":ID_POST", $idPost, PDO::PARAM_INT);

        return $ps->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return false;
}

/**
 * Get the medias from a post
 *
 * @param integer $idPost id of the post
 * @return array|bool array if succeed else false
 */
function getMediasFromPost(int $idPost)
{
    static $ps = null;
    $db = connectDB();
    $sql = "SELECT idMedia, nomFichierMedia, typeMedia FROM MEDIA WHERE idPost = :ID_POST";

    try {
        if ($ps == null) {
            // prepare analyse la requête pour savoir s'il peut la résoudre (correction syntaxique, analyse table champs, calule le cout de la requete)
            $ps = $db->prepare($sql);
        }

        $ps->bindParam(":ID_POST", $idPost, PDO::PARAM_INT);

        if ($ps->execute()) {
            return $ps->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return false;
}

/**
 * Start a transaction
 *
 * @return bool true if succeed, else false
 */
function dbStartTransaction()
{
    return connectDB()->beginTransaction();
}

/**
 * Commit the transaction
 *
 * @return bool trus if succeed, false if error
 */
function dbCommitTransaction()
{
    return connectDB()->commit();
}

/**
 * Cancel the transaction
 *
 * @return bool true if succeed, else false
 */
function dbRollBack()
{
    return connectDB()->rollBack();
}
