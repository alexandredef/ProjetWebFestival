{* Commentaire Smarty *}
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{$titre}</title>
    </head>
    <body>
        <h1>{$titre}</h1>
        <table>
            {foreach $liste as $ligne}
                <tr>
                    <td>{$id}</td>
                    <td><a href="/detail/{$ligne[]}/{$ligne[]}"</td>
                    <td>{$nom}</td>
                    <td>{$departement}</td>
                    <td>{$adresse}</td>
                    <td>{$scene}</td>
                    <td>{$style}</td>
                    <td>{$annee}</td>
                    <td>{$description}</td>
                    <td>{$experience}</td>
                </tr>
            {/foreach}
        </table>
    </body>
</html> 