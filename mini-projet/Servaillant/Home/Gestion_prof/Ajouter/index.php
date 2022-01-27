<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Style/Style.css">
    <link rel="stylesheet" href="index.css">
    <title>Ajouter un professeur</title>
</head>
<body>
    <script language="javascript" type="text/javascript" src="index.js"></script>
<?php
    $out_id ="";
    $out_lname="";
    $out_fname ="";
    $out_cin="";
    $out_date="";
    $out_tele="";
    $out_adr="";
    $out_email="";
    $out_opt_cours="";
    $out_opt_depart="";

    //Connection
    $username = "root"; 
    $password ="";
    $conn = new PDO("mysql:host=localhost; dbname=EMSI;",$username, $password);
    // submit 
    if(isset($_POST["sub"]))
    {
        
        $id = $_POST["id_prof"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $cin = $_POST["cin"];
        $adr = $_POST["adr"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $date = $_POST["date_rec"];
        $opt_depart = $_POST["opt_depart"];
        $opt_cours = $_POST["opt_cours"];

        $out_v ='<div style="color:green;"> &#10004; </div> '; // print V -> Valide
        $out_x ='<div style="color:red;">&#10008; </div> ';    // print X -> Error
        // Regular Expression-------------------------------
        ///id
        $tst_id = false;
        $reg_id = "/^[0-9]+$/";
        $tst_id = preg_match($reg_id, $id);
        if($id =="" )
        {
            $out_id = $out_x;
        }else
        {
            if($tst_id)
            {
                $out_id = $out_v;
                $tst_id = true;
            }else
            {
                $out_id = $out_x;
            }
        }
        /// nom
        $reg_lname = "/^[A-Za-z]+$/";
        $tst_lname = false;
        if($lname =="")
        {
            $out_lname = $out_x;
        }else
        {
            $tst_lname = preg_match($reg_lname, $lname);
            if($tst_lname)
            {
                $out_lname = $out_v;
                $tst_lname = true;
            }else
            {
                $out_lname = $out_x;
            }
        }
        /// prenom
        $tst_fname = false;
        if($lname =="")
        {
            $out_fname = $out_x;
        }else
        {
            $tst_fname = preg_match($reg_lname, $fname);
            if($tst_fname)
            {
                $out_fname = $out_v;
                $tst_fname = true;
            }else
            {
                $out_fname = $out_x;
            }
        }
        /// cin
        $tst_cin = false;
        $reg_cin = "/^[A-Za-z]+[0-9]{3,8}$/";
        $tst_cin = preg_match($reg_cin, $cin);
        if($cin =="")
        {
            $out_cin = $out_x;
        }else
        {
            if($tst_cin){
                $out_cin = $out_v;
                $tst_cin = true;
            }else
            {
                $out_cin = $out_x;
            }
        }
        /// Adresse
        $tst_adr = false;
        if($adr =="")
        {
            $out_adr = $out_x;
        }else
        {
            $out_adr = $out_v;
            $tst_adr = true;
        }
        /// tel
        $tst_tel = false;
        $reg_tel = "/^[06|05]{2}-[0-9]{8}$/";
        $tst_tel = preg_match($reg_tel,$tel);
        if($tel=="")
        {
            $out_tele = $out_x;
        }else
        {
            if($tst_tel)
            {
                $out_tele = $out_v;
                $tst_tel = true;
            }else
            {
                $out_tele = $out_x;
            }
        }
        /// email
        $tst_email = false;
        if($email=="")
        {
            $out_email = $out_x;
        }else
        {
            $out_email = $out_v;
            $tst_email = true;
        }
        /// date
        $tst_date = false;
        $reg_date = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
        $tst_date = preg_match($reg_date, $date);
        if($date=="")
        {
            $out_date = $out_x;
        }else
        {
            if($tst_date)
            {
                $out_date = $out_v;
                $tst_date = true;
            }else
            {
                $out_date = $out_x;
            }
        }
        /// depart
        if($opt_depart!=0)
        {
            $out_opt_depart = $out_v;
        }else
        {
            $out_opt_depart = $out_x;
        }
        /// cours
        if($opt_cours!=0)
        {
            $out_opt_cours = $out_v;
        }else
        {
            $out_opt_cours = $out_x;
        }
        if( $tst_id == true && $tst_lname == true && $tst_fname == true && $tst_cin == true && $tst_adr == true && $tst_tel == true && $tst_date ==true   && $opt_cours!=0 && $opt_depart!=0 )
        {
            try
            {
                $req = "SELECT COUNT(*) FROM `PROF` WHERE id_prof = ".$id.";";
                $req = $conn->prepare($req);
                $req->execute();
                $tst = $req->fetchColumn();
                if($tst == 0)
                {
                    $req = "INSERT INTO `prof`(`id_prof`, `nom`, `prenom`, `cin`, `adresse`, `tel`, `email`, `date_recrutement`, `id_cours`, `id_depart`) 
                    VALUES ('$id','$lname','$fname','$cin','$adr','$tel','$email','$date','$opt_cours','$opt_depart')";
                    $res = $conn->prepare($req);
                    $res = $res->execute();
                    if($res)
                    {
                        echo'
                        <style>
                        .alert_success{ display: block;}
                        </style> ';
                    }
                }else
                {
                    echo'
                    <style>
                    .alert_warning_id{ display: block;}
                    </style> ';  
                    $out_id = $out_x;
                }
            }catch(Exception $exp)
            {
                echo '<script> console.log("'.$exp->getMessage().'"); </script> ';
                echo'
                <style>
                .alert_error{ display: block;}
                </style> ';  
                $out_id = $out_x;
            }
        }
    }

    if(isset($_POST["reset"]))
    {
        $out_id ="";
        $out_lname="";
        $out_fname ="";
        $out_cin="";
        $out_date="";
        $out_tele="";
        $out_adr="";
        $out_email="";
        $out_opt_cours="";
        $out_opt_depart="";
    }


    
    function Connect($sql)
    {
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
    
    function get_depart()
    {
        $sql = "SELECT * FROM `departement`; ";
        $tab = Connect($sql);
        foreach($tab as $t)
        {
            $p = $t["nom_depart"];
            $d =  $t["id_depart"];
            echo'<option value="'.$d.'">'.$p.'</option>';
        }
    }
    function get_cours()
    {
        $sql = "SELECT  * FROM `cours` ; ";
        $tab = Connect($sql);
        foreach($tab as $t)
        {
            $p = $t["intitule"];
            $d =  $t["id_cours"];
            echo'<option value="'.$d.'">'.$p.'</option>';
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
                    <li><a href="index.php">Ajouter un professeur</a></li>
                    <li><a href="../Modifier/index.php">Modifier un professeur</a></li>
                    <li><a href="../Supprimer/index.php">Supprimer un professeur</a></li>
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
    <!-- Log out button--------------------------------------------------------------------- -->
        <ul class="logout">
            <li><a href="../../../../Login/index.php"> Disconnect </li> </a>
        </ul> 
    </div><br/>
    <!-- Alert--------------------------------------------------------------------- -->
    <div class="alert_error">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Danger!</strong> Operation refuse!!
    </div> 
    <div class="alert_warning_id">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Danger!</strong> Ce id est deja exist
    </div>
    <div class="alert_success">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Insertion!</strong> Bien fait.
    </div> 
    <!-- Formulaire d'ajouter professeur------------------------------------------------------------------------------------>
    <div class="Ajout">
        <p>Ajouter un professeur</p>
        <form  method="post" action="index.php"> 
            <table>
                <tr>
                    <td><label for="id_prof">ID de professeur </label></td><td><input type="text" id="id_prof" name="id_prof" > </td><td> <?php echo $out_id;  ?> </td>
                </tr>
                <tr>
                    <td><label for="lname"> Nom</label></td><td><input type="text" id="lname" name="lname" > </td><td> <?php echo $out_lname;  ?> </td>
                </tr>
                <tr>
                    <td><label for="fname"> Prenom</label></td><td><input type="text" id="fname" name="fname" > </td><td> <?php echo $out_fname;  ?> </td>
                </tr>
                <tr>
                    <td><label for="cin"> CIN</label></td><td><input type="text" placeholder="ID000000" id="cin" name="cin"  > </td><td> <?php echo $out_cin;  ?> </td>
                </tr>
                <tr>
                    <td><label for="adr">Adresse </label></td><td><input type="text" id="adr" name="adr"  > </td><td> <?php echo $out_adr;  ?> </td>
                </tr>
                <tr>
                    <td><label for="tel"> Telephone</label></td><td><input type="tel" id="tel" placeholder="05-00000000" name="tel"  > </td> </td><td> <?php echo $out_tele;  ?> </td>
                </tr>
                <tr>
                    <td><label for="email">Email </label></td><td><input type="text" id="email" name="email" title="nom.prenom@exemple.com" placeholder="nom.prenom@exem..."></td>  <td> <?php echo $out_email;  ?> </td>  
                </tr>
                <tr>
                    <td><label for="date_rec"> Date recrutement</label></td><td><input type="text" placeholder="0000-00-00" class="date_rec" id="date_rec" name="date_rec"  > </td><td> <?php echo $out_date;  ?> </td>
                </tr>
                <tr>
                    <td>
                        <label for="depart">Departmenet</label>
                    </td>
                    <td>
                        <select name="opt_depart" id="depart" class="opt" >
                            <option value="0" selected>Select un department</option>
                            <?php  get_depart(); ?>
                        </select>
                    </td>  <td> <?php echo $out_opt_depart;  ?> </td>
                </tr>
                <tr>
                    <td>
                        <label for="cours">Cours</label>
                    </td>
                    <td>
                        <select name="opt_cours" id="cours" class="opt">
                            <option  value="0" selected>Select un cour</option>
                            <?php get_cours(); ?>
                        </select>
                    </td>  <td> <?php echo $out_opt_cours;  ?> </td>
                </tr>
                <tr>
                    <td><input type="submit"  name="sub" id="sub" class="btn" value="Valider"> </td> <td> <input type="submit" class="btn" name="reset" value="Reset"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
