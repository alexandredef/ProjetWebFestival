<!doctype html>
<html>
    <head>
        <title>ferme ta gueule fdp</title>
    </head>
    <body>
        <form action="inscription" method="POST">
            <p>
                <label for="">Nom</label>
                <input type="text" name="nom" value="{$nom|escape|default:''}">
                {$messages.nom|default:''}
            </p>
            <p>
                <label for="">Email</label>
                <input type="email" name="departement" value="{$email|escape|default:''}">
                {$messages.departement|default:''}
            </p>
            <p>
                <label for="">Mot de passe</label>
                <input type="password" name="motdepasse" value="{$motdepasse|escape|default:''}" autocomplete="off">
                {$messages.motdepasse|default:''}
            </p>
            <p>
                <input type="submit" name="">
            </p>
        </form>
        <p><a href=".">Retourner à la page principale</a></p>
    </body>
</html> 