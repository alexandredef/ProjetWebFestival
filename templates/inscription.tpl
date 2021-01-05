
<form action="inscription" method="POST">
    <p>
        <label for="">Nom</label>
        <input type="text" name="nom" >
        {$messages.nom|default:''}
    </p>
    <p>
        <label for="">Email</label>
        <input type="email" name="email" >
        {$messages.email|default:''}
    </p>
    <p>
        <label for="">Mot de passe</label>
        <input type="password" name="password">
        {$messages.password|default:''}
    </p>
    <p>
        <input type="submit" name="submit">
    </p>
</form>