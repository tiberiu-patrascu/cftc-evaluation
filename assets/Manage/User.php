<?php
require_once "Debug.php";

class User
{
    protected $pdo;

    /** 
     * Constructeur de la classe
     */
    public function __construct()
    {
        $this->pdo = Db::getDb();
    }

    /**
     * Récupèrer toutes les données (lignes/colonnes) de la table
     * @return array || false $result le résultat de la requête sous forme de tableau 
     * ou false si la requête est fausse
     */
    public function getAllUserSearch($name)
    {
        try {
            //Vérifier si la fonction a reçu un parametre ou non
            if ($name === "") {
                //déclarer la requête
                $sql = "SELECT * FROM `user`;";
            } else {
                $sql = "SELECT * FROM `user` WHERE `login` LIKE '%" . $name . "%';";
            }
            //executer la requête
            $stmt = Db::getDb()->query($sql);
            //return le resultat sous forme de tableau contenant toutes les lignes
            $result = $stmt->fetchAll();
            //fermer la connexion
            $stmt->closeCursor();
            //retourner le résultat
            return $result;
        } catch (Exception $erreur) {
            //dans la phase de developpement on peut laisser les messages des erreurs par contre pour la phase de production on remplace par des messages personalisés
            //exit($erreur->getMessage());
            exit("Erreur traitement de données");
        }
    }

    /**
     * Récupèrer un élément dans une table à partir de son id
     * @param int $id l'identifiant à rechercher
     * @return array || false $result le résultat de la requête sous forme de tableau ou false si la requête est fausse
     */
    public function getOneUser(int $id)
    {
        try {
            $sql = "SELECT * FROM user WHERE id = :id;";
            //prépare la requête
            $stmt = Db::getDb()->prepare($sql);
            //déclare un tableau de valeur avec les marqueurs de positionnement
            $values = [
                ':id' => $id
            ];

            $result = null;
            //executer la requête
            if ($stmt->execute($values)) {
                $result = $stmt->fetch();
            }

            $stmt->closeCursor();

            return $result;
        } catch (Exception $erreur) {
            //exit($erreur->getMessage());
        }
    }

    /**
     * Insèrer un nouvel élément
     * @param array $utilisateur Le tableau des valeurs
     * @return int Le nombre des lignes affectées
     */
    public function insertUser(array $user)
    {
        try {
            $sql = "INSERT INTO user (login, pwd, mail) VALUES (:login, :pwd, :mail);";

            $stmt = Db::getDb()->prepare($sql);

            $vars = [
                ":login" => $user['user_login'],
                ":pwd" => password_hash($user['user_password'], PASSWORD_BCRYPT),
                ":mail" => $user['user_email']
            ];

            if ($stmt->execute($vars)) {
                //retourner le contenu si il y a moins une ligne modifié
                return $stmt->rowCount() > 0;
            }

            $stmt->closeCursor();
        } catch (Exception $erreur) {
            //exit($erreur->getMessage());
        }
    }

    /** 
     * Mettre à jour un élément 
     * @param array $utilisateur Le tableau des valeurs de la table courante. Il faut contenir l'id pour la liqne qu'on veut mettre à jour
     * @return int Le nombre des lignes affectées
     */
    public function updateUser(array $user)
    {
        try {
            if ($user['user_password'] === "") {
                $sql = "UPDATE user 
                SET login = :login, mail = :mail
                WHERE id = :id;";

                $stmt = Db::getDb()->prepare($sql);

                $vars = [
                    ":id" => $user['user_id'],
                    ":login" => $user['user_login'],
                    ":mail" => $user['user_email']
                ];
            } else {
                $sql = "UPDATE user 
                SET login = :login, pwd = :pwd, mail = :mail
                WHERE id = :id;";

                $stmt = Db::getDb()->prepare($sql);

                $vars = [
                    ":id" => $user['user_id'],
                    ":login" => $user['user_login'],
                    ":pwd" => password_hash($user['user_password'], PASSWORD_BCRYPT),
                    ":mail" => $user['user_email']
                ];
            }

            $result = $stmt->execute($vars);

            $stmt->closeCursor();

            return $result;
        } catch (Exception $erreur) {
            //exit($erreur->getMessage());
        }
    }

    /**
     * Supprimer un élèment de la table
     * @param int $id L'id de la ligne à supprimer
     * @return int Le nombre des ligne affectées
     */
    public function deleteUser(int $id)
    {
        try {
            $sql = "DELETE FROM user WHERE id = :id LIMIT 1;";
            $stmt = Db::getDb()->prepare($sql);
            $var = [
                ":id" => $id
            ];
            $result = $stmt->execute($var);
            $stmt->closeCursor();
            return $result;
        } catch (Exception $erreur) {
            //exit($erreur->getMessage());
        }
    }
}
