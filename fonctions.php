<?php

include 'includes/pdo.php';

/*

ACCUEIL

*/

// Fonction de la route / 
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

// Fonction de la route /connexion avec la méthode GET
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

    // Vérification du champ nom
    if(empty($_POST['nom'])){
        $messages_erreur['nom'] = "Le nom d'utilisateur est obligatoire";
    }

    // Vérification du champ email
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

    // Vérification du champ password
    if(empty($_POST['password'])) {
        $messages_erreur['password'] = "Le mot de passe est obligatoire";
    }
    else if(strlen($_POST['password']) < 8){
        $messages_erreur['password'] = "Le mot de passe doit faire minimum 8 caracteres";
    }

    // Envoi de messages d'erreurs si fautes de saisies
    if(!empty($messages_erreur)) {
        Flight::view()->assign("messages", $messages_erreur);
        Flight::view()->assign($_POST);
        Flight::render("inscription.tpl", NULL);
    // Sinon envoi des informations saisies dans le formulaire vers la table utilisateur de la base de données
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

// Fonction de la route /candidature avec la méthode GET
Flight::route('GET /candidature', function(){
    // On vérifie si l'utilisateur est connecté,
        if (isset($_SESSION['utilisateur'])){
            $db = Flight::get('db');
            $departement=$db->query('select * from departement');
            $liste=$departement->fetchAll();
        
            $data = array(
                "departement" => $liste
            );

        Flight::render("candidature.tpl",$data);
    } else{
        // Si ce n'est pas le cas alors on redirige vers la route /login
        Flight::redirect('/connexion');
    }
});

// Fonction de la route /candidature avec la méthode POST
Flight::route('POST /candidature', function(){
    $messages_erreur = array();

    // Vérification du champ nomGroupe
    if(empty($_POST['nomGroupe'])){
        $messages_erreur['nomGroupe'] = "Le nom du groupe est obligatoire";
    }

    // Vérification du champ departement
    if(empty($_POST['departement'])){
        $messages_erreur['departement'] = "Le département est obligatoire";
    }

    // Vérification du champ typeScene
    if(empty($_POST['typeScene'])){
        $messages_erreur['typeScene'] = "Le type de scène est obligatoire";
    }

    // Vérification du champ representantGroupeNom
    if(empty($_POST['representantGroupeNom'])){
        $messages_erreur['representantGroupeNom'] = "Le nom du représentant du groupe est obligatoire";
    }

    // Vérification du champ representantGroupePrenom
    if(empty($_POST['representantGroupePrenom'])){
        $messages_erreur['representantGroupePrenom'] = "Le prénom du représentant du groupe est obligatoire";
    }

    // Vérification du champ representantGroupeAdresse
    if(empty($_POST['representantGroupeAdresse'])){
        $messages_erreur['representantGroupeAdresse'] = "L'adresse du représentant du groupe est obligatoire";
    }

    // Vérification du champ representantCodePostal
    if(empty($_POST['representantGroupeCodePostal'])){
        $messages_erreur['representantGroupeCodePostal'] = "Le code postal du représentant du groupe est obligatoire";
    }

    // Vérification du champ representantGroupeEmail
    if(empty($_POST['representantGroupeEmail'])) {
        $messages_erreur['representantGroupeEmail'] = "L'adresse mail est obligatoire";
    }
    elseif(!filter_var($_POST['representantGroupeEmail'], FILTER_VALIDATE_EMAIL)){
        $messages_erreur['representantGroupeEmail'] = "Format d'adresse email non valide";
    } else {
        $db = Flight::get('db');
        $st = $db->prepare("select representantGroupeEmail from candidature where email = ?");
        $st->execute(array($_POST['representantGroupeEmail']));
        if($st->rowCount()!==0){
            $messages_erreur['representantGroupeeEmail']="L'adresse email est deja utilisee";
        }
    }

    // Vérification du champ reprensetantGroupeTelephone
    if(empty($_POST['representantGroupeTelephone'])){
        $messages_erreur['representantGroupeTelephone'] = "Le numéro de téléphone est obligatoire";
    }

    // Vérification du champ styleMusical
    if(empty($_POST['styleMusical'])){
        $messages_erreur['styleMusical'] = "Le style musical est obligatoire";
    }

    // Vérification du champ anneeCreation
    if(empty($_POST['anneeCreation'])){
        $messages_erreur['anneeCreation'] = "L'année de création du groupe est obligatoire";
    }

    // Vérification du champ presentation
    if(empty($_POST['presentation'])){
        $messages_erreur['presentation'] = "Une présentation du groupe est obligatoire";
    }

    // Vérification du champ experience
    if(empty($_POST['experience'])){
        $messages_erreur['experience'] = "L'expérience sur scène du groupe est obligatoire";
    }

    // Vérification du champ siteOuPage
    if(empty($_POST['siteOuPage'])){
        $messages_erreur['SiteOuPage'] = "Un lien vers le site ou la page Facebook du groupe est obligatoire";
    }

    // Vérification du champ membres
    if(empty($_POST['membres'])){
        $messages_erreur['membres'] = "Les noms et prénoms des membres du groupe est obligatoire";
    }

    // Vérification du champ roles_membres
    if(empty($_POST['roles_membres'])){
        $messages_erreur['roles_membres'] = "Les rôles des membres du groupe est obligatoire";
    }

    // Vérification du champ fichierMP3
    if(empty($_POST['fichierMP3'])){
        $messages_erreur['fichierMP3'] = "3 Fichiers MP3 sont obligatoires";
    }

    // Vérification du champ photoGroupe
    if(empty($_POST['photoGroupe'])){
        $messages_erreur['photoGroupe'] = "Une photo du groupe est obligatoire";
    }

    // Vérification du champ ficheTechnique
    if(empty($_POST['ficheTechnique'])){
        $messages_erreur['ficheTechnique'] = "Une fiche technique en format PDF obligatoire";
    }

    // Envoi de messages d'erreurs si fautes de saisies
    if(!empty($messages_erreur)) {
        Flight::view()->assign("messages", $messages_erreur);
        Flight::view()->assign($_POST);
        Flight::render("candidature.tpl", NULL);
    // Sinon envoi des informations saisies dans le formulaire vers la table candidature de la base de données
    } else {
        $get_db = Flight::get('db');
        $st = $get_db->prepare('INSERT INTO candidature VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $_POST['groupeNom'] = trim($_POST['groupeNom']);
        $_POST['departement'] = trim($_POST['departement']);
        $_POST['typeScene'] = trim($_POST['typeScene']);
        $_POST['representantGroupeNom'] = trim($_POST['representantGroupeNom']);
        $_POST['representantGroupePrenom'] = trim($_POST['representantGroupePrenom']);
        $_POST['representantGroupeAdresse'] = trim($_POST['representantGroupeAdresse']);
        $_POST['representantGroupeCodePostal'] = trim($_POST['representantGroupeCodePostal']);
        $_POST['representantGroupeEmail'] = trim($_POST['representantGroupeEmail']);
        $_POST['representantGroupeTelephone'] = trim($_POST['representantGroupeTelephone']);
        $_POST['styleMusical'] = trim($_POST['styleMusical']);
        $_POST['anneeCreation'] = trim($_POST['anneeCreation']);
        $_POST['presentation'] = trim($_POST['presentation']);
        $_POST['experience'] = trim($_POST['experience']);
        $_POST['siteOuPage'] = trim($_POST['siteOuPage']);
        $_POST['adresseSoundcloud'] = trim($_POST['adresseSoundcloud']);
        $_POST['adresseYoutube'] = trim($_POST['adresseYoutube']);
        $_POST['membres'] = trim($_POST['membres']);
        $_POST['roles_membres'] = trim($_POST['roles_membres']);
        $_POST['statutAssociatif'] = trim($_POST['statutAssociatif']);
        $_POST['inscritSACEM'] = trim($_POST['inscritSACEM']);
        $_POST['producteur'] = trim($_POST['producteur']);
        $_POST['fichierMP3'] = trim($_POST['fichierMP3']);
        $_POST['dossierPresse'] = trim($_POST['dossierPresse']);
        $_POST['photoGroupe'] = trim($_POST['photoGroupe']);
        $_POST['ficheTechnique'] = trim($_POST['ficheTechnique']);
        $_POST['documentSACEM'] = trim($_POST['documentSACEM']);
        $st->execute(array($_POST));
        Flight::redirect('/success');
    }
});

/*

LISTE

*/

// Fonction de la route /liste avec la méthode GET
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

// Fonction de la route /logout avec la méthode GET
Flight::route('GET /logout', function(){
    // On retire le nom de l'utilisateur de la variable globale _SESSION afin de mettre fin à sa session, puis on redirige vers la route / désignant la page d'accueil
    unset($_SESSION['utilisateur']);
    Flight::redirect('/');
});


/*

DETAIL CANDIDATURE

*/

// Fonction de la route /detail/@if/@name avec la méthode GET
Flight::route('GET /detail/@id/@name', function() {
    $template = 'detail.tpl';
    $db = Flight::get('db');
    $album=$db->prepare('select * from candidature where nomGroupe like :nom');
    $album->execute(array(':nom' => $secondArg));
    $liste = $album->fetchall();
    $data = array('titre' => 'Detail', 'route' => "$premierArg/$secondArg", 'liste' => $liste);
    Flight::render($template, $data);
});

/*

SUCCES

*/

// Fonction de la route /succes avec la méthode GET
Flight::route('GET /success', function(){
   
    Flight::render('success.tpl', NULL);
});



?>

