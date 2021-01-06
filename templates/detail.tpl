{* Commentaire Smarty *}
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{$titre}</title>
    </head>
    <body>
        <h1>{$titre}</h1>
        <p><img src=''></p>
        <section>
			{*
		    <p>{$liste[0]}</p>
            <p>{$fichierMP3}</p>
            <p>{$fichierMP3}</p>
            <p>{$fichierMP3}</p>
            <p>{$departement}</p>
            <p>{$adresse}</p>
            <p>{$typeScene}</p>
            <p>{$styleMusical}</p>
            <p>{$adresseSoundcloud}</p>
            <p>{$adresseYoutube}</p>
            <p>{$presentation}</p>
            <p>{$experience}</p>
            <p>Dossier</p>
            <p>{$documentSACEM}</p>
            <p>{$ficheTechnique}</p>
			*}
			<p>{$liste[0]}</p>
			 <audio controls>
				<source src="{liste[21]}" type="audio/mpeg">
			</audio>  
            <p>{$liste[1]}</p>
            <p>{$liste[5]}</p>
            <p>{$liste[2]}</p>
            <p>{$liste[9]}</p>
            <p>{$liste[14]}</p>
            <p>{$liste[15]}</p>
            <p>{$liste[11]}</p>
            <p>{$liste[12]}</p>
            <p>Dossier</p>
            <p>{$liste[25]}</p>
            <p>{$liste[24]}</p>
        </section>
    </body>
</html> 