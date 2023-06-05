<?php
session_start();
require_once "Loader.php";
require_once "Debug.php";
require_once "functions-check.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    //récuperer l'id de l'url
    if (isset($_GET["id"])) {
        //filtrer l'input
        $id = test_input($_GET["id"]);

        //tester la validite avec les expression régulière
        $regex_id = '/^[0-9]{1,}$/i';
        if (empty($_GET["id"]) || !preg_match($regex_id, $id)) {
            $_SESSION['error'] = "Le format ne correspond pas !";
            header("location: accueil");
            exit();
        }

        $user = new User;
        if ($user->deleteUser($id)) {
            $_SESSION["success"] = "Utilisateur supprimé !";
            header("location: accueil");
            exit;
        } else {
            $_SESSION["error"] = "Erreur suppression d'utilisateur !";
            header("location: accueil");
            exit;
        }
    } else {
        header("location: accueil");
        exit;
    }
} else {
    header("location: accueil");
    exit;
}
