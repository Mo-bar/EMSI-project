<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Style/Style.css">
    <link rel="stylesheet" href="index.css">
    <title>Supprimer un professeur</title>

</head>
<body>

<?php
    
    $username = "root"; 
    $password ="";
    $conn = new PDO("mysql:host=localhost; dbname=EMSI;",$username, $password);

    if(isset($_POST["sub"])){
        $id = $_POST["id_prof"];
        $req ='SELECT COUNT(*) FROM `prof` WHERE `id_prof` = '.$id;
        $res = $conn->prepare($req);
        $res->execute();
        $idp = $res->fetchColumn();
        if($idp == 1){
            $req ='DELETE FROM `prof` WHERE `id_prof` = '.$id;
            $res = $conn->prepare($req);
            if($res->execute()){
                echo'
                <style>
                .alert_success{ display: block;}
                </style> ';
            }
        }else{
            echo'
            <style>
            .alert_warning{ display: block;}
            </style> '; 
        }
    }
    function get_depart(){
        $sql = "SELECT `departement`.`nom_depart` FROM `departement`; ";
        $tab = Connect($sql);
        $i = 1;
        foreach($tab as $t){
            $p = $t["nom_depart"];
            echo'<option value="'.$i.'">'.$p.'</option>';
            ++$i;
        }
    }
    function get_cours(){
        $sql = "SELECT  `intitule` FROM `cours` ; ";
        $tab = Connect($sql);
        $i = 1;
        foreach($tab as $t){
            $p = $t["intitule"];
            echo'<option value="'.$i.'">'.$p.'</option>';
            ++$i;
        }
    }

?>

    <div class="logo"><a href="../../Index/index.html"><img src="../../../Logo/logo.png"  alt="logo"></a> </div>  
    <div class="navbar">
        
        <ul>
            <li><a href="">Gerer les professeur</a>
            <div class="sub-menu-prof" class="sub-menu">
                <ul>
                    <li><a href="../Ajouter/index.php">Ajouter un professeur</a></li>
                    <li><a href="../Modifier/index.php">Modifier un professeur</a></li>
                    <li><a href="index.php">Supprimer un professeur</a></li>
                    <li><a href="../Afficher/index.php">Afficher la liste des profs</a></li>
                </ul>
            </div>
            </li>
            <li><a href="">Gerer les departements</a>
                <div class="sub-menu-depart" class="sub-menu">
                    <ul>
                        <li><a href="../../Gestion_depart/Ajouter/index.php">Ajouter un departement</a></li>
                        <li><a href="../../Gestion_depart/Modifier/index.php">Modifier un departement</a></li>
                        <li><a href="../../Gestion_depart/Supprimer/index.php">Supprimer un departement </a></li>
                        <li><a href="../../Gestion_depart/list_depart/index.php">liste des departemets</a></li>
                        <li><a href="../../Gestion_depart/list_prof/index.php">profs appartenent un depart.</a></li>
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
            <li><a href="../../../../Login/index.php"> Disconnect </a></li> 
        </ul> 
    </div><br/>
        <!-- Alert--------------------------------------------------------------------- -->
        <div class="alert_warning">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Danger!</strong> Ce id n'est exist pas 
    </div> 
    <div class="alert_success">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Suppression!</strong> Bien fait.
    </div> 

    <div class="Ajout">
        <p>Supprimer un professeur</p>
        <form action="index.php" method="post"> 
            <table>
                <tr>
                    <td><label for="id_prof">ID de professeur </label></td><td><input type="text" id="id_prof" name="id_prof" required> </td>
                </tr>
                <tr>
                    <td><input type="submit" name="sub" class="btn" value="Valider"> </td> <td> <input type="reset" class="btn" name="reset" value="Reset"></td>
                </tr>
            </table>    
        </form>
    </div>
</body>
</html>