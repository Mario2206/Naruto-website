<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button>Demande Ajax</button>

    <script src="<?=PATH."js/package/Ajax.js" ?>"></script>
    <script>

        document.querySelector("button").addEventListener("click", (e)=> {
            // var xhr = new XMLHttpRequest();

            // // On souhaite juste récupérer le contenu du fichier, la méthode GET suffit amplement :
            // xhr.open('GET', "http://projet-naruto.local/api/test/");

            // xhr.addEventListener('readystatechange', function() { // On gère ici une requête asynchrone

            //     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) { // Si le fichier est chargé sans erreur

            //         console.log("ready");
                    

            //     }

            // });

            // xhr.send(null); // La requête est prête, on envoie tout !

            let ajax = new Ajax("api/test/")
            ajax.post(function(data){console.log(data);
            }, {testPost : "post"})
        
        })

    </script>
</body>
</html>