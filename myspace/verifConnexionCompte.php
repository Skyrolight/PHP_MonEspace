<!DOCTYPE html>
<html>
    <head>
        <script language="javascript" type="text/javascript">
            function valider() {
                if (!(document.forms["formulaire"].pseudo.value)) {
                    alert("Pseudo manquant");
                    if (!(document.forms["formulaire"].mdp.value)) {
                        alert("Mot de passe manquant");
                    }
                }
            }
        </script>
    </head>
    <body>
    </body>
</html>