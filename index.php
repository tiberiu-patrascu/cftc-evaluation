<?php
session_start();
require_once "assets/Manage/Debug.php";
require_once "assets/Manage/Loader.php";
require_once "assets/Manage/functions-check.php";
//Générer un jeton unique 
$token = uniqid(rand(), true);
//Stoker dans la variable de session
$_SESSION['token'] = $token;
//Enregistre le timestamp correspondant au moment de la création du token
$_SESSION['token_time'] = time();
?>
<div class="console-msg">
    <?php
    if (!empty($_SESSION["error"])) :
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center p-0">
                    <p class="bg-danger"><?= $_SESSION["error"]; ?></p>
                </div>
            </div>
        </div>
    <?php
        //vider la session
        $_SESSION["error"] = null;
    endif;

    if (!empty($_SESSION["success"])) :
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center p-0">
                    <p class="bg-success"><?= $_SESSION["success"]; ?></p>
                </div>
            </div>
        </div>
    <?php
        $_SESSION["success"] = null;
    endif;
    ?>
</div>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Application utilisateur">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Evaluation CFTC</title>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-1 mx-auto">
                    <img src="assets/images/cftc-logo.jpg" class="img-fluid" alt="logo cftc">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Liste d'utilisateurs</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#ajouterModal">
                        Ajouter un utilisateur
                    </button>
                    <div class="row">
                        <div class="col-12">
                            <div class="row text-center">
                                <div class="col-xl-3 col-lg-5 col-md-10 mx-auto mt-4 mb-4">
                                    <form class="d-flex" role="search" action="/" method="GET">
                                        <input class="form-control me-2" type="search" placeholder="" aria-label="Rechercher" name="search-txt" id="search-txt">
                                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Ajouter Utilisateur-->
            <div class="modal fade" id="ajouterModal" tabindex="-1" aria-labelledby="ajouterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ajouterModalLabel">Ajouter un utilisateur</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="page-add" method="POST" class="box">
                            <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="login" class="form-label">Nom d'utilisateur *</label>
                                    <input type="text" name="login" class="form-control" id="login">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3 text-center">
                                    <p>* le champ est obligatoire !</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            //déclarer un nouveau utilisateur
            $user = new User;
            //vérifier si la variable existe et ce n'est pas vide
            if (isset($_GET["edit"]) || !empty($_GET["edit"])) {
                //filtrer la variable
                $edit = test_input($_GET["edit"]);
                //récupérer l'utilisateur
                $user_edit = $user->getOneUser($edit);
                //validation si l'utilisatteur existe dans la base de données
                if ($user_edit) {
            ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-10 mx-auto">
                            <form action="page-edit" method="POST">
                                <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
                                <input type="hidden" name="id" id="id" value="<?= $user_edit["id"]; ?>">
                                <div class="mb-3">
                                    <label for="login" class="form-label">Nom d'utilisateur</label>
                                    <input type="text" class="form-control" id="login" name="login" aria-describedby="login" value="<?= $user_edit["login"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder="laisser champ vide si le mot de passe ne se modifie pas">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="<?= $user_edit["mail"]; ?>">
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-success" value="editer">Sauvegarder</button>
                            </form>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="row">
                        <div class="col-12 text-center mt-5">
                            <p>Nous ne pouvons pas editer cet utilisateur !</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mx-auto text-center">
                            <a class="btn btn-success  mb-4" role="button" href="accueil">Voir les utilisateurs</a>
                        </div>
                    </div>
                <?php
                }
            }
            if (isset($_GET["search-txt"]) || !empty($_GET["search-txt"])) {
                $query = test_input($_GET["search-txt"]);
                //vérifier si on a des données en retour
                if ($user->getAllUserSearch($query) !== []) {
                ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-10 m-auto">
                            <?php
                            //traitement des données pour afficher la table
                            table($query);
                            ?>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="row">
                        <div class="col-12 text-center mt-5">
                            <p>Aucun utilisateur trouvé</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mx-auto text-center">
                            <a class="btn btn-success mb-4" role="button" href="accueil">Voir les utilisateurs</a>
                        </div>
                    </div>
                <?php
                }
            } else {
                //vérifier si il y a des utilisateurs en retour
                if ($user->getAllUserSearch("") != []) {
                ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-10 m-auto">
                            <?php
                            //traitement des données pour afficher la table
                            table("");
                            ?>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>Aucun utilisateur trouvé</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mx-auto text-center">
                            <a class="btn btn-success  mb-4" role="button" href="accueil">Voir les utilisateurs</a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </main>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>