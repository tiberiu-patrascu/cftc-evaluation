<?php
//filtrer et nettoyer les inputs
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars(strip_tags($data));
    return $data;
}

function function_check($id, $login, $password, $email)
{
    //vérifier si l'utilisateur à remplis tous le champs
    if (!isset($login) || !isset($password) || !isset($email)) {
        $_SESSION["error"] = "Les informations sont obligatoires !";
        header("location: accueil");
        exit;
    }
    //filtrer la saisie utilisateur pour le nom
    $regex_login = '/^[a-z0-9]{4,50}$/i';
    if (empty($login) || !preg_match($regex_login, $login)) {
        $_SESSION['error'] = "Le nom doit contenir minimum 4 caractères alphanumérique !";
        header("location: accueil");
        exit();
    }

    $regex_password = '/^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[@$€!%*#?&\.^])[A-Za-z0-9@$€!%^*#?&\.]{8,50}$/';
    if ($id !== null) {
        //regex pour editer
        if ($password !== "") {
            //filtrer la saisie utilisateur pour le mot de passe
            if (!preg_match($regex_password, $password)) {
                $_SESSION['error'] = "Le password doit contenir minimum 8 caractères, au moins une lettre, une chifres et un caractère spécial !";
                header("location: accueil");
                exit();
            }
        }
    } else {
        //regex pour ajouter
        if (empty($password) || !preg_match($regex_password, $password)) {
            $_SESSION['error'] = "Le password doit contenir minimum 8 caractères, au moins une lettre, une chifres et un caractère spécial !";
            header("location: accueil");
            exit();
        }
    }

    //vérifier si l'email a un maximum de 50 caractères et une adresse e-mail valide
    if (empty($email) || strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: accueil");
        exit();
    }
}
//fonction pour créer le tableau
function table($query)
{
    if (isset($_GET["search-txt"])) {
?>
        <div class="col-3">
            <a class="btn btn-success  mb-4" role="button" href="accueil">Tous les utilisateurs</a>
        </div>
    <?php
    }
    ?>
    <table id="table-user" class="table" data-toggle="table" data-locale="fr-FR" data-pagination="true" data-id-field="id" data-page-list="[10, 25, 50, 100, all]" data-show-footer="false">
        <thead>
            <tr>
                <th scope="col">
                    Nom d'utilisateur
                    <button class="btn-order" onclick="sortTable(0)" data-sort-order="asc">&#11165;</button>
                    <button class="btn-order" onclick="sortTable(0)" data-sort-order="desc">&#11167;</button>
                </th>
                <th scope="col">
                    Email
                    <button class="btn-order" onclick="sortTable(1)" data-sort-order="asc">&#11165;</button>
                    <button class="btn-order" onclick="sortTable(1)" data-sort-order="desc">&#11167;</button>
                </th>
                <th scope="col">
                    Editer
                </th>
                <th scope="col">
                    Supprimer
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user = new User;
            //récupérer tous les utilisateurs
            foreach ($user->getAllUserSearch($query) as $value) {
            ?>
                <tr>
                    <td><?= $value["login"]; ?></td>
                    <td><?= $value["mail"]; ?></td>
                    <td class="text-center">
                        <a role="button" class="btn btn-warning" href="index.php?edit=<?= $value["id"]; ?>">Editer</a>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger" onclick="delete_id(<?= $value['id']; ?>)" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $value["id"]; ?>">
                            Supprimer
                        </button>
                    </td>
                </tr>
                <!-- Modal delete-->
                <div class="modal fade" id="deleteModal-<?= $value["id"]; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="deleteModalLabel">Supprimer un utilisateur</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Etes-vous sûr que vous voulez supprimer l'utilisateur <span class="span-delete"><?= $value["login"]; ?></span> ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Non</button>
                                <button type="button" class="btn btn-danger btn-delete">Oui</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}