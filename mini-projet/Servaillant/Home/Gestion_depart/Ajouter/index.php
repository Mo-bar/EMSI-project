<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Style/Style.css">
    <link rel="stylesheet" href="index.css">
    <title>Ajouter un departement</title>
    <?php
        //Connection
        $username = "root"; 
        $password ="";
        $conn = new PDO("mysql:host=localhost; dbname=EMSI;",$username, $password);

        $out_v ='<div style="color:green;"> &#10004; </div> '; // print V -> Valide
        $out_x ='<div style="color:red;">&#10008; </div> ';    // print X -> Error
        
        $out_id ="";
        $out_dep="";

        //Submit
        if(isset($_POST["sub"]))
        {
            // get element by name
            $dep = $_POST["name_dep"];

            ///nom
            if($dep == "")
            {
                $out_dep = $out_x;
            }
            if($dep!="")
            {
                try
                {
                $sql = "INSERT INTO `departement` (`id_depart`, `nom_depart`) VALUES (NULL, '".$dep."');";
                $req = $conn->prepare($sql);
                $req = $req->execute();
                if($req)
                {
                    echo'
                    <style>
                    .alert_success{ display: block;}
                    </style> ';
                }
                }catch(Exception $exp)
                {
                echo '<script> console.log("'.$exp->getMessage().'"); </script> ';
                echo'
                <style>
                .alert_warning{ display: block;}
                </style> ';
                // echo'
                // <style>
                // .alert_warning{ display: block;}
                // </style> ';  
                $out_id = $out_x;
            
                }
            }
        }
    
    ?>
    <title>Gestion des departements</title>
</head>
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
            <li><a href="../../../../Login/index.php"> Disconnect </a></li>
        </ul>
    </div>
    <!-- Alert--------------------------------------------------------------------- -->
    <div class="alert_warning">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Danger!</strong> Ce id est deja exist
    </div> 
    <div class="alert_success">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Insertion!</strong> Bien fait.
    </div> 
    
    <form action="index.php" method="post">
        <div class="Ajout">
            <p>Ajouter un departement</p>
            <table>
                    <tr>
                        <td> <label for="">Nom departement</label> </td><td> <input type="text" name="name_dep"> </td> <td> <?php echo $out_dep;  ?> </td>
                    </tr>
                    <tr>
                    <td><input type="submit"  name="sub" id="sub" class="btn" value="Valider"> </td> <td> <input type="submit" class="btn" name="reset" value="Reset"></td>
                    </tr>

            </table>
        </div>
    </form>
</body>
</html>