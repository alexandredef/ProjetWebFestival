<?php

include 'includes/pdo.php';

/*

CONNEXION


*/


Flight::route('GET /connexion', function(){
    // On affiche seulement le template de la page de connexion connexion.tpl
    Flight::render("connexion.tpl",NULL);
});

// Fonction de la route /connexion avec la méthode POST
Flight::route('POST /connexion', function(){
    // Même princique pour la route /inscription
    $message = array();

    // On vérifie si l'adresse email a été saisi
    if(empty($_POST['email'])){
        $messages['email']="L'adresse email est obligatoire";
    }
    // On vérifie si l'adresse email existe
    else{
        $db = Flight::get('db');
        $st = $db->prepare('select Email from utilisateur where Email = ?');
        $st->execute(array($_POST['email']));
        if($st->rowCount()==0){
            $messages['email']="L'adresse email n'existe pas";
        }
    }

    // On vérifie si le mot de passe a été saisi
    if(empty($_POST['motdepasse'])){
        $messages['motdepasse']="Le mot de passe est obligatoire";
    }
    // On vérifie si le mot de passe est correcte
    else{
        $st = $db->prepare('select Motdepasse from utilisateur where Email = ?');
        $st->execute(array($_POST['email']));
        $motdepasse_chiffre = $st->fetch();
        if(!password_verify($_POST['motdepasse'], $motdepasse_chiffre[0])){
            $messages['motdepasse']="Le mot de passe est incorrecte";
        }

    }

    // Même principe que pour la route /inscription, on affiche les erreurs cette fois ci dans le template connexion.tpl
    if(!empty($messages)){
        Flight::view()->assign("messages", $messages);
        Flight::view()->assign($_POST);
        Flight::render("connexion.tpl",NULL);
    }
    // On importe le nom du compte de l'utilisateur puis on l'attribue dans la variable globale _SESSION puis on redirige vers la route / donc vers la page d'accueil
    else{
        $db = Flight::get('db');
        $st = $db->prepare('select Nom from utilisateur where Email = ?');
        $st->execute(array($_POST['email']));
        $nom_utilisateur = $st->fetch();
        $_SESSION['utilisateur'] = $nom_utilisateur[0];
        Flight::redirect('/');
    }
});

/*

INSCRIPTION

*/

// Fonction de la route /inscription avec la méthode GET
Flight::route("GET /inscription", function(){
    // On affiche seulement le template de la page d'inscription inscription.tpl
    Flight::render("inscription.tpl",NULL);
});

// Fonction de la route /inscription avec la méthode POST
Flight::route("POST /inscription", function(){
    $messages_erreur = array();

    if(empty($_POST['nom'])){
        $messages_erreur['nom'] = "Le nom d'utilisateur est obligatoire";
    }

    if(empty($_POST['email'])) {
        $messages_erreur['email'] = "L'adresse mail est obligatoire";
    }
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $messages_erreur['email'] = "Format d'adresse email non valide";
    } else {
        $db = Flight::get('db');
        $st = $db->prepare("select email from utilisateur where email = ?");
        $st->execute(array($_POST['email']));
        if($st->rowCount()!==0){
            $messages_erreur['email']="L'adresse email est deja utilisee";
        }
    }

    if(empty($_POST['password'])) {
        $messages_erreur['password'] = "Le mot de passe est obligatoire";
    }
    else if(strlen($_POST['password']) < 8){
        $messages_erreur['password'] = "Le mot de passe doit faire minimum 8 caracteres";
    }

    if(!empty($messages_erreur)) {
        Flight::view()->assign("messages", $messages_erreur);
        Flight::view()->assign($_POST);
        Flight::render("inscription.tpl", NULL);
    } else {
        $get_db = Flight::get('db');
        $st = $get_db->prepare('INSERT INTO utilisateur VALUES(?,?,?,0)');
        $_POST['nom'] = trim($_POST['nom']);
        $_POST['email'] = trim($_POST['email']);
        $_POST['password'] = trim($_POST['password']);
        $motdepasse_chiffre = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $st->execute(array($_POST['nom'],$_POST['email'],$motdepasse_chiffre));
        Flight::redirect('/success');
    }
    });

/* 

CANDIDATURE

*/


/*

LISTE


*/

Flight::route('/liste', function(){

    $db = Flight::get('db');
    $albums=$db->query('select id,nomgroupe,departement,annee,presentation,typescene,stylemusicale from candidature');
    $liste=$albums->fetchAll();

    $data = array(
        "titre" => "Liste des candidatures",
        "liste" => $liste
    );

    Flight::render('liste.tpl', $data);

});

?>