<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Style/Style.css">
    <link rel="stylesheet" href="index.css">
    <title>List des professeurs</title>
    <style>
  
    </style>
</head>
<body>
<script src="index.js"></script>
<?php
    function Connect($sql){
        $username = "root"; 
        $password ="";
        //Connection
        $conn = new PDO("mysql:host=localhost; dbname=EMSI;",$username, $password);
        // prepare requete
        $req = $conn->prepare($sql);
        //execute 
        $req->execute();
        $tab = $req->fetchAll();
        return $tab;
    }
    
    function get_depart($d){
        $sql = "SELECT `nom_depart` FROM `departement` WHERE `id_depart` =".$d ;
        $tab = Connect($sql);
        foreach($tab as $t){
            return $t["nom_depart"];
        }
    }
    function get_cours($r){
        $sql = "SELECT  `intitule` FROM `cours` WHERE  `id_cours` =".$r;
        $tab = Connect($sql);
        foreach($tab as $t){
            return $t["intitule"];
        }
    }
    function Afficher_profs()
    {
        $username = "root"; 
        $password ="";
        $conn = new PDO("mysql:host=localhost; dbname=EMSI;",$username, $password);
        $req ="SELECT * FROM `prof` ";
        $req = $conn->prepare($req);
        if($req->execute())
        {
            $tab = $req->fetchAll();
            foreach($tab as $t)
            {
                echo'<tr>';
                echo'<td>'.$t[0].'</td>';
                echo'<td class="nom">'.$t[1].'</td>';
                echo'<td class="prenom">'.$t[2].'</td>';
                echo'<td>'.$t[3].'</td>';
                // echo'<td class="adresse">'.$t[4].'</td>';
                // echo'<td>'.$t[5].'</td>';
                // echo'<td>'.$t[6].'</td>';
                // echo'<td>'.$t[7].'</td>';
                // echo'<td class="cour">'.get_cours($t[8]).'</td>';
                echo'<td class="depart">'.get_depart($t[9]).'</td>';
                echo'</tr>';
            }
        }
    }
?>
    <!-- Logo---------------------------------------------------- -->
<div class="logo"><a href="../../Index/index.html"><img src="../../../Logo/logo.png"  alt="logo"></a> </div>  
    <!-- Navigation bar------------------------------------------- -->
<div class="navbar">
        
        <ul>
            <li><a href="">Gerer les professeur</a>
            <div class="sub-menu-prof" class="sub-menu">
                <ul>
                    <li><a href="../../Gestion_prof/Ajouter/index.php">Ajouter un professeur</a></li>
                    <li><a href="../../Gestion_prof/Modifier/index.php">Modifier un professeur</a></li>
                    <li><a href="../../Gestion_prof/Supprimer/index.php">Supprimer un professeur</a></li>
                    <li><a href="../../Gestion_prof/Afficher/index.php">Afficher la liste des profs</a></li>
                </ul>
            </div>
            </li>
            <li><a href="">Gerer les departements</a>
                <div class="sub-menu-depart" class="sub-menu">
                    <ul>
                        <li><a href="../Ajouter/index.php">Ajouter un departement</a></li>
                        <li><a href="../Modifier/index.php">Modifier un departement</a></li>
                        <li><a href="../Supprimer/index.php">Supprimer un departement </a></li>
                        <li><a href="../list_depart/index.php">liste des departemets</a></li>
                        <li><a href="../list_prof/index.php">profs appartenent un depart.</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="">Gerer les cours</a>
                <div class="sub-menu-cours" class="sub-menu">
                    <ul>
                        <li><a href="../../Gestion_cour/Ajouter/index.php">Ajouter un cour</a></li>
                        <li><a href="../../Gestion_cour/Modifier/index.php">Modifier un cour</a></li>
                        <li><a href="../../Gestion_cour/Supprimer/index.php">Supprimer un cour</a></li>
                        <li><a href="../../Gestion_cour/Affecter/index.php">Affecter des cours a des profs </a></li> 
                    </ul>
                </div>
            </li>
            
        </ul>
            <!-- Log out button--------------------------------------------------------------------- -->
            <ul class="logout">
            <li><a href="../../../../Login/index.php"> Disconnect </li> </a>
        </ul> 
</div>

<div class="liste">
    <p>La liste des professeurs</p>

        <table>
            <tr class="title">
                <td>id</td>
                <td>nom</td>
                <td>prenom</td>
                <td>cin</td>
                <!-- <td>adresse</td>
                <td>tel</td>
                <td>email</td>
                <td>date recrutement</td> -->
                <!-- <td>cour</td> -->
                <td>department</td>
            </tr>
            <?php    Afficher_profs();  ?>
        </table>    
</div>
</body>
</html>