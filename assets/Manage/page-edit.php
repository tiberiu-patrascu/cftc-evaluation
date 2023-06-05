<?php
session_start();
require_once "Loader.php";
require_once "Debug.php";
require_once "functions-check.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    //vérifier si le jeton est présent dans la session et dans le formulaire
    if (isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
        //vérifier si le jeton de la session correspond à celui du formulaire
        if ($_SESSION['token'] == $_POST['token']) {
            //On stocke le timestamp qu'il était il y a 15 minutes
            $timestamp_ancien = time() - (15 * 60);
            //Si le jeton n'est pas expiré
            if ($_SESSION['token_time'] >= $timestamp_ancien) {
                $user = new User;

                $id = test_input($_POST["id"]);
                $login = test_input($_POST["login"]);
                $password = test_input($_POST["password"]);
                $email = test_input($_POST["email"]);

                function_check($id, $login, $password, $email);

                $vars = [
                    "user_id" => $id ?? null,
                    "user_login" => $login ?? null,
                    "user_password" => $password ?? null,
                    "user_email" => $email ?? null
                ];

                if ($user->updateUser($vars)) {
                    $_SESSION["success"] = "Utilisateur edité !";
                    header("location: accueil");
                    exit;
                } else {
                    $_SESSION["error"] = "Erreur editer l'utilisateur !";
                    header("location: accueil");
                    exit;
                }
            }
        }
    } else {
        $_SESSION["error"] = "Nous preferons que vous restez dans la zone de sécurité !";
        header("location: accueil");
        exit;
    }
} else {
    header("location: accueil");
    exit;
}
