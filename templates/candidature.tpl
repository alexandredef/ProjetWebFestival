<!doctype html>
<html>
    <head>
        <title>Candidature</title>
    </head>
    <body>
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
            <p>
                <label for="representantGroupe">Informations sur le représentant du groupe</label>
                <input type="text" name="representantGroupe" value="{$representantGroupe|escape|default:''}">
                {$messages.representantGroupe|default:''}
            </p>
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
                <textarea name="siteOuPage" value="{$siteOuPage|escape|default:''}">
                {$messages.siteOuPage|default:''}
            </p>
            <p>
                <label for="adresseSoundcloud">Lien vers la page Soundcloud du groupe</label>
                <textarea name="adresseSoundcloud" value="{$adresseSoundcloud|escape|default:''}">
                {$messages.adresseSoundcloud|default:''}
            </p>
            <p>
                <label for="adresseYoutube">Lien vers la chaîne Youtube du groupe</label>
                <textarea name="adresseYoutube" value="{$adresseYoutube|escape|default:''}">
                {$messages.adresseYoutube|default:''}
            </p>
            <p>
                <label for="membres">Lien vers site ou page internet du groupe</label>
                <textarea name="siteOuPage" value="{$siteOuPage|escape|default:''}">
                {$messages.siteOuPage|default:''}
            </p>
            <p>
                <label for="statutAssociatif">Statut associatif ?</label>
                <textarea name="statutAssociatif" value="{$statutAssociatif|escape|default:''}">
                {$messages.statutAssociatif|default:''}
            </p>
            <p>
                <label for="inscritSACEM">Inscrit à la SACEM ?</label>
                <textarea name="inscritSACEM" value="{$inscritSACEM|escape|default:''}">
                {$messages.inscritSACEM|default:''}
            </p>
            <p>
                <label for="producteur">producteur</label>
                <textarea name="producteur" value="{$producteur|escape|default:''}">
                {$messages.producteur|default:''}
            </p>
            <p>
                <label for="fichierMP3">3 fichier au format MP3</label>
                <textarea name="producteur" value="{$producteur|escape|default:''}">
                {$messages.producteur|default:''}
            </p>
            <p>
                <label for="DossierPresse">Dossier de presse au format PDF</label>
                <textarea name="DossierPresse" value="{$DossierPresse|escape|default:''}">
                {$messages.DossierPresse|default:''}
            </p>
            <p>
                <label for="photoGroupe">3 fichier au format MP3</label>
                <textarea name="producteur" value="{$producteur|escape|default:''}">
                {$messages.producteur|default:''}
            </p>
            <p>
                <label for="ficheTechnique">Fiche Technique au format PDF</label>
                <textarea name="ficheTechnique" value="{$ficheTechnique|escape|default:''}">
                {$messages.ficheTechnique|default:''}
            </p>
            <p>
                <label for="documentSACEM">Document SACEM au format PDF</label>
                <textarea name="documentSACEM" value="{$documentSACEM|escape|default:''}">
                {$messages.documentSACEM|default:''}
            </p>
            <p>
                <input type="submit" name="valider">
            </p>
        </form>
        <p><a href="/">Retourner à la page principale</a></p>
    </body>
</html> 