<form action="connexion" method="POST">
    <p>
        <label for="">Email</label>
        <input type="email" name="email">
		{$messages.email|default:''}
    </p>
    <p>
        <label for="">Mot de passe</label>
        <input type="password" name="motdepasse">
		{$messages.motdepasse|default:''}
    </p>
    <p>
        <input type="submit" value="Se connecter" name="submit">
    </p>
</form>