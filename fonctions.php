<?php

include 'includes/pdo.php';

/*

ACCUEIL

*/

Flight::route('/', function(){
    // On vérifie si l'utilisateur est connecté,
    if (isset($_SESSION['utilisateur'])){
        // Si c'est le cas alors on affiche l'adresse email et le nom du compte dans le template profil.tpl en les important de la base de données
        $db = Flight::get('db');
        $st = $db->prepare('select nom, email from utilisateur where nom = ?');
        $st->execute(array($_SESSION['utilisateur']));
        $info_utilisateur = $st->fetch();
        Flight::render("index.tpl",array("titre"=>"Accueil", "nom"=>$info_utilisateur[0], "email"=>$info_utilisateur[1]));
    }
    else{
        // Si ce n'est pas le cas alors on redirige vers la route /login
        Flight::redirect('/connexion');
    }
});


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

Flight::route('GET /candidature', function(){
    // On vérifie si l'utilisateur est connecté,
        if (isset($_SESSION['utilisateur'])){
            $db = Flight::get('db');
            $departement=$db->query('select * from departement');
            $liste=$departement->fetchAll();
        
            $data = array(
                "departements" => $liste
            );

        Flight::render("candidature.tpl",$data);
    } else{
        // Si ce n'est pas le cas alors on redirige vers la route /login
        Flight::redirect('/connexion');
    }
});


Flight::route('POST /candidature', function(){
    

});

/*

LISTE


*/

Flight::route('GET /liste', function(){
    if (isset($_SESSION['utilisateur'])){
    $db = Flight::get('db');
    $candidatures=$db->query('select id,nomgroupe,departement,annee,presentation,typescene,stylemusicale from candidature');
    $liste=$candidatures->fetchAll();

    $data = array(
        "titre" => "Liste des candidatures",
        "liste" => $liste
    );

    Flight::render('liste.tpl', NULL);
} else {
Flight::redirect('connexion');
}


});

/*

DECONNEXION

*/

Flight::route('GET /logout', function(){
    // On retire le nom de l'utilisateur de la variable globale _SESSION afin de mettre fin à sa session, puis on redirige vers la route / désignant la page d'accueil
    unset($_SESSION['utilisateur']);
    Flight::redirect('/');
});


/*

DETAIL CANDIDATURE

*/

Flight::route('GET /detail/@id', function() {
	
	
});

/*

SUCCES

*/

Flight::route('GET /success', function(){
   
    Flight::render('success.tpl', NULL);
});



?>

