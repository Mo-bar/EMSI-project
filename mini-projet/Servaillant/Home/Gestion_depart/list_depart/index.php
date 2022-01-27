<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Style/Style.css">
    <link rel="stylesheet" href="index.css">
    <title>Liste des departements</title>
</head>
<body>
    <?php 
        function Afficher_departs()
        {
            $username = "root"; 
            $password ="";
            $conn = new PDO("mysql:host=localhost; dbname=EMSI;",$username, $password);
            $req ="SELECT * FROM `departement` ";
            $req = $conn->prepare($req);
            if($req->execute())
            {
                $tab = $req->fetchAll();
                foreach($tab as $t)
                {
                    echo'<tr>';
                    echo'<td>'.$t[0].'</td>';
                    echo'<td class="dept">'.$t[1].'</td>';
                    echo'</tr>';
                }
            }
        }
    ?>
    <div class="logo"><a href="../../Index/index.html"><img src="../../../Logo/logo.png"  alt="logo"></a> </div>  
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
        <ul class="logout">
            <li><a href="../../../../Login/index.php"> Disconnect</a></li>
        </ul>
    </div>
    <div class="liste">
        <p>La liste des departements</p>
        <table>
            <tr class="title">
                <td>id departement</td>
                <td>nom departement</td>
            </tr>
            <?php    Afficher_departs();  ?>
        </table>    
    </div>
</body>
</html>