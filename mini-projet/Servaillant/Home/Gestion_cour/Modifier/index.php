<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Style/Style.css">
    <link rel="stylesheet" href="../../Gestion_depart/Modifier/index.css">
    <title>Modifier un departement</title>
</head>
<?php
    $conn = new PDO("mysql:host=localhost; dbname=EMSI;","root","");

    $out_v ='<div style="color:green;"> &#10004; </div> '; // print V -> Valide
    $out_x ='<div style="color:red;">&#10008; </div> ';    // print X -> Error
    $out_dep = "";
    if(isset($_POST["sub"]))
    {
        $salle = $_POST["nv_dept"];
        $id = $_POST["dept_id"];

        if($salle =="")
        {
            $out_dep = $out_x;
        }else
        {
            $sql = "UPDATE `cours` SET `intitule`='".$salle."' WHERE id_cours = ".$id.";";
            $sql = $conn->prepare($sql);
            if($sql->execute())
            {
                $out_dep = $out_v;
            }
        }
    }


    function get_depart()
    {
        $username = "root"; 
        $password ="";
        //Connection
        $conn = new PDO("mysql:host=localhost; dbname=EMSI;",$username, $password);

        $sql = "SELECT * FROM `cours`; ";
        $req = $conn->prepare($sql);
        //execute 
        $req->execute();
        $tab = $req->fetchAll();

        foreach($tab as $t)
        {
            $p = $t["intitule"];
            $d = $t["id_cours"];
            echo'<option value="'.$d.'">'.$p.'</option>';
        }
    }
?>
<body>
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
                        <li><a href="../Ajouter/index.php">Ajouter un cour</a></li>
                        <li><a href="index.php">Modifier un cour</a></li>
                        <li><a href="../Supprimer/index.php">Supprimer un cour</a></li>
                        <li><a href="../Affecter/index.php">Affecter des cours a des profs </a></li> 
                    </ul>
                </div>
            </li>
            
        </ul>
        <ul class="logout">
            <li><a href="../../../../Login/index.php"> Disconnect </a></li>
        </ul>
    </div>
    <form action="index.php" method="post">
        <div class="modif">
            <p>Modifier un cour</p>
            <table>
                <tr>
                    <td> <label for="">Ancien cour</label></td> 
                    <td>
                        <select name="dept_id" id="" class="dept">
                            <option value="0" selected>Select un department</option>
                            <?php  get_depart(); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nouveau cour</td> <td><input type="text" name="nv_dept"> </td> <td><?php  echo $out_dep; ?> </td>
                </tr>
                <tr> <td><input type="submit" value="Valider"  name="sub" class="btn"> </td> <td><input type="submit" value="Reset" name="reset" class="btn"></td></tr>
            </table>
        </div>
    </form>
    
</body>
</html>