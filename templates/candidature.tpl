<!doctype html>
<html>
    <head>
        <title>Candidature</title>
    </head>
    <body>
        <h1>Candidature</h1>
        <form action="candidature" method="POST">
            <p>
                <label for="nomGroupe">Nom</label>
                <input type="text" name="nomGroupe" value="{$nomGroupe|escape|default:''}">
                {$messages.nomGroupe|default:''}
            </p>
            <p>
                <label for="departement">Departement</label>
                <select>
                {foreach $liste as $ligne}
                    <option>{$departement}</option>
                {/foreach}
                </select>
                {$messages.departement|default:''}
            </p>
            <p>
                <label for="typescene">Type de scène</label>
                <select>
                {foreach $liste as $ligne}
                    <option>{$typeScene}</option>
                {/foreach}
                </select>
                {$messages.typeScene|default:''}
            </p>
            <div>
                <h2>Représantant du groupe</h2>
                <label for="representantGroupeNom">Informations sur le représentant du groupe</label>
                <input type="text" name="representantGroupeNom" value="{$representantGroupeNom|escape|default:''}">
                {$messages.representantGroupeNom|default:''}

                <label for="representantGroupePrenom">Informations sur le représentant du groupe</label>
                <input type="text" name="representantGroupePrenom" value="{$representantGroupePrenom|escape|default:''}">
                {$messages.representantGroupePrenom|default:''}

                <label for="representantGroupeAdresse">Informations sur le représentant du groupe</label>
                <input type="text" name="representantGroupeAdresse" value="{$representantGroupeAdresse|escape|default:''}">
                {$messages.representantGroupeAdresse|default:''}

                <label for="representantGroupeCodePostal">Informations sur le représentant du groupe</label>
                <input type="text" name="representantGroupeCodePostal" value="{$representantGroupeCodePostal|escape|default:''}">
                {$messages.representantGroupeCodePostal|default:''}

                <label for="representantGroupeEmail">Informations sur le représentant du groupe</label>
                <input type="text" name="representantGroupeEmail" value="{$representantGroupeEmail|escape|default:''}">
                {$messages.representantGroupeEmail|default:''}

                <label for="representantGroupeTelephone">Informations sur le représentant du groupe</label>
                <input type="text" name="representantGroupeTelephone" value="{$representantGroupeTelephone|escape|default:''}">
                {$messages.representantGroupeTelephone|default:''}
            </div>
            <p>
                <label for="styleMusical">Style musical</label>
                <input type="text" name="styleMusical" value="{$styleMusical|escape|default:''}">
                {$messages.styleMusical|default:''}
            </p>
            <p>
                <label for="anneeCreation">Année de création du groupe</label>
                <input type="text" name="anneeCreation" value="{$anneeCreation|escape|default:''}">
                {$messages.anneeCreation|default:''}
            </p>
            <p>
                <label for="anneeCreation">Année de création du groupe</label>
                <input type="text" name="anneeCreation" value="{$anneeCreation|escape|default:''}">
                {$messages.anneeCreation|default:''}
            </p>
            <p>
                <label for="presentation">Présentation du groupe</label>
                <textarea name="presentation" value="{$presentation|escape|default:''}">
                {$messages.presentation|default:''}
            </p>
            <p>
                <label for="experience">Expérience sur scène</label>
                <textarea name="experience" value="{$experience|escape|default:''}">
                {$messages.experience|default:''}
            </p>
            <p>
                <label for="siteOuPage">Lien vers site ou page internet du groupe</label>
                <input type="url" name="siteOuPage" value="{$siteOuPage|escape|default:''}">
                {$messages.siteOuPage|default:''}
            </p>
            <p>
                <label for="adresseSoundcloud">Lien vers la page Soundcloud du groupe</label>
                <input type="url" name="adresseSoundcloud" value="{$adresseSoundcloud|escape|default:''}">
                {$messages.adresseSoundcloud|default:''}
            </p>
            <p>
                <label for="adresseYoutube">Lien vers la chaîne Youtube du groupe</label>
                <input type="url" name="adresseYoutube" value="{$adresseYoutube|escape|default:''}">
                {$messages.adresseYoutube|default:''}
            </p>
            <div>
                <h2>Membres du groupes</h2>
                <label for="membres">Membres du groupe</label>
                <textarea name="membres" value="{$membres|escape|default:''}">
                {$messages.membres|default:''}

                <label for="roles_membres">Membres du groupe</label>
                <textarea name="roles_membres" value="{$roles_membres|escape|default:''}">
                {$messages.roles_membres|default:''}
            </div>
            <p>
                <label for="statutAssociatif">Statut associatif ?</label>
                <input type="checkbox" name="statutAssociatif" value="{$statutAssociatif|escape|default:''}">
                {$messages.statutAssociatif|default:''}
            </p>
            <p>
                <label for="inscritSACEM">Inscrit à la SACEM ?</label>
                <input type="checkbox" name="inscritSACEM" value="{$inscritSACEM|escape|default:''}">
                {$messages.inscritSACEM|default:''}
            </p>
            <p>
                <label for="producteur">Producteur ?</label>
                <input type="checkbox" name="producteur" value="{$producteur|escape|default:''}">
                {$messages.producteur|default:''}
            </p>
            <p>
                <label for="fichierMP3">3 fichier au format MP3</label>
                <input type="file" name="producteur" value="{$producteur|escape|default:''}">
                <input type="file" name="producteur" value="{$producteur|escape|default:''}">
                <input type="file" name="producteur" value="{$producteur|escape|default:''}">
                {$messages.producteur|default:''}
            </p>
            <p>
                <label for="DossierPresse">Dossier de presse au format PDF</label>
                <input type="text" accept=".pdf" name="DossierPresse" value="{$DossierPresse|escape|default:''}">
                {$messages.DossierPresse|default:''}
            </p>
            <p>
                <label for="photoGroupe">Photo du groupe</label>
                <input type="file" accept="image/*" name="producteur" value="{$producteur|escape|default:''}">
                {$messages.producteur|default:''}
            </p>
            <p>
                <label for="ficheTechnique">Fiche Technique au format PDF</label>
                <input type="file" accept=".pdf" name="ficheTechnique" value="{$ficheTechnique|escape|default:''}">
                {$messages.ficheTechnique|default:''}
            </p>
            <p>
                <label for="documentSACEM">Document SACEM au format PDF</label>
                <input type="file" accept=".pdf" name="documentSACEM" value="{$documentSACEM|escape|default:''}">
                {$messages.documentSACEM|default:''}
            </p>
            <p>
                <input type="submit" name="valider">
            </p>
        </form>
        <p><a href="/">Retourner à la page principale</a></p>
    </body>
</html> 