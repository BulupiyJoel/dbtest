<?php
    $dbb = new PDO('mysql:host=localhost;dbname=resto','root','');
    $request = $dbb->query('SELECT * FROM commande');
    $commande = $request->fetchAll();
    //CHECKBOX OUI
     $nom_client;
     $nom_plat;
     $quantite_plat;
    if (isset($_POST['envoyer']) AND isset($_POST['emporter'])) {
        $nom_client = htmlspecialchars($_POST['nom']);
        $nom_plat = ($_POST['plat']);
        $quantite_plat = $_POST['quantite'];
        $_POST['emporter'] = true ;    
               if(!empty($nom_client AND $nom_plat AND $quantite_plat AND $_POST['emporter']) AND is_numeric($quantite_plat)){
                         $request = $dbb->prepare('INSERT INTO commande(nom_client,plat,quantite,emporter)VALUES(?,?,?,?)');
                         $result = $request->execute([$nom_client,$nom_plat,$quantite_plat,$_POST['emporter']]);
               }
     }
    //CHECKBOX = NON
    if (isset($_POST['envoyer']) AND !isset($_POST['emporter'])) {
        $nom_client = $_POST['nom'];
        $nom_plat = $_POST['plat'];
        $quantite_plat = $_POST['quantite'];
        $_POST['emporter'] = 0;
        if (!empty($nom_client AND $nom_plat AND $quantite_plat) AND empty($_POST['emporter'])) {
            $request = $dbb->prepare('INSERT INTO commande(nom_client,plat,quantite,emporter)VALUES(?,?,?,?)');
            $result = $request->execute([$nom_client,$nom_plat,$quantite_plat,$_POST['emporter']]);   
        }
    }
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>RESTAURANT</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="shortcut icon" href="../IMG/2ND" type="image/x-icon">
</head>
<style>
body{
     background-image: url("../IMG/2ND");
     background-size: cover;
}
*{
     margin: 0%;
     padding: 0%;
}
.tete{
     color: black;
     font-size:large;
     font-weight: 600;
     font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.box{
     margin-top: 5%;
     margin-left: 5%;
     width: 50%;
     padding: 1%;
     box-shadow: 2px 5px 3px 5px rgba(0, 0, 0, 0.343);
     border-radius: 1px;
     background-color: rgba(75, 75, 56, 0);
}
.form{
     padding: 4%;
     background-color: yellow;
     font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
#nom{
     background-color: white;
     outline: none;
     border:none;
     background-color:yellow;
     border-bottom:2px solid black;
     font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
     padding: .9%;
     color: black;
}
#plats{
     outline: none;
     background-color:yellow;
     border:2px solid black;
     font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
#group-option{
     background-color: rgb(255, 251, 0);
     font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
#qte{
     width:40px;
     border: 2px solid rgb(0, 0, 0);
     background-color:yellow;
     font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
     outline: none;
}
button{
     font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
     outline: none;
     padding: 1%;
     border-radius: 5px;
     background:linear-gradient(to right,rgba(255, 255, 0.794),rgb(255, 255, 255),rgba(255, 255, 255, 0.84)) 4%;
     color: black;
     border: 2px solid black;
}
button:hover{
     background: white;
     color:black;
     border: none;
     box-shadow: 3px 3px 5px 2px black;
     margin-bottom:2%;
}
h3{
     border-bottom:3px solid black;
}
</style>
<body>
     <section class="box">
          <div class="form">
               <h2 class="subject">FORMULAIRE POUR CLIENTS</h2>
               <form method='post' target='' action=''>
                    <label for='nom'>Nom Client</label><br>
                    <input type='text' name='nom' id='nom' required><br>
                    <label for='plat'>Nom plat</label><br>
                    <select id="plats" name="plat">
                         <optgroup label="LES PLATS" id="group-option">
                              <option value="SPAGHA">SPAGHA</option>
                              <option value="MADESU-FUFU">MADESU-FUFU</option>
                              <option value="MAYI MOTO">MAYI MOTO</option>
                              <option value="NDAKALA">NDAKALA</option>
                              <option value="BOHKE">BOHKE</option>
                              <option value="SONGO-MOLE">SONGO-MOLE</option>
                              <option value="ZURUBI">ZURUBI</option>
                              <option value="FUFU-TSAYI">FUFU-TSAYI</option>
                              <option value="BITEKUTEKU">BITEKUTEKU</option>
                              <option value="KPINA-NGU">KPINA-NGU</option>
                         </optgroup>
                    </select><br>
                    <label for='quantite'>Quantite</label><br>
                    <input type='number' name='quantite' id='qte' min="0"><br>
                    <label for="emporter">A emporter ?</label>
                    <input type='checkbox' name='emporter' id='emporter'><br>
                    <button type='submit' name='envoyer'>Commander</button>
               </form>
          </div>
     </section>
</body>
</html>