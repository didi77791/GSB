<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
    case 'demandeConnexion': {
            include("vues/v_connexion.php");
            break;
        }
    case 'valideConnexion': {
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
            $internautes = $pdo->getInfosinternet($login, $mdp);


            if (!is_array($internautes)) {
                ajouterErreur("Login ou mot de passe incorrect");
                include("vues/v_erreurs.php");
                include("vues/v_connexion.php");
            } elseif ($internautes['type'] == "visiteur") {
                $type = $internautes['type'];
                $id = $internautes['id'];
                $nom = $internautes['nom'];
                $prenom = $internautes['prenom'];
                connecter($id, $nom, $prenom);
                include("vues/v_sommaire.php");
            } else {
                $type = $internautes['type'];
                $id = $internautes['id'];
                $nom = $internautes['nom'];
                $prenom = $internautes['prenom'];
                connecter($id, $nom, $prenom);
                include("vues/v_sommairecomp.php");
            }
        }break;

    case "deconnexion": {
            deconnecter();
            include("vues/v_connexion.php");
            break;
        }
    default : {
            include("vues/v_connexion.php");
            break;
        }
}
?>