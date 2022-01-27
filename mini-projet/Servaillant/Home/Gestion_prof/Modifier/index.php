<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Style/Style.css">
    <link rel="stylesheet" href="../Ajouter/index.css">
    <title>Modifier un professeur</title>
</head>
<body>
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
    if(isset($_POST["sub"])){
        
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
        $out_v ='<div style="color:green;"> &#10004; </div> ';
        $out_x ='<div style="color:red;">&#10008; </div> ';
        // Regular Expression-------------------------------
        //id
        if($id =="" ){
            $out_id = $out_x;
        }else{
            $reg_id = "/^[0-9]+$/";
            $tst_id = preg_match($reg_id, $id);
            if($tst_id){
                $out_id = $out_v;
            }else{
                $out_id = $out_x;
            }
        }
        // nom
        $reg_lname = "/^[A-Za-z]+$/";
        if($lname!=""){
            $tst_lname = preg_match($reg_lname, $lname);
            if($tst_lname){
                $out_lname = $out_v;
            }else{
                $out_lname = $out_x;
            }
        }

        // prenom
        if($fname!=""){
            $tst_fname = preg_match($reg_lname, $fname);
            if($tst_fname){
                $out_fname = $out_v;
            }else{
                $out_fname = $out_x;
            }
        }

        // cin
        if($cin!=""){
            $reg_cin = "/^[A-Za-z]+[0-9]{3,8}$/";
            $tst_cin = preg_match($reg_cin, $cin);
            if($tst_cin){
                $out_cin = $out_v;
            }else{
                $out_cin = $out_x;
            }
        }


        // tel
        if($tel!=""){
            $reg_tel = "/^[06|05]{2}-[0-9]{8}$/";
            $tst_tel = preg_match($reg_tel,$tel);
            if($tst_tel){
                $out_tele = $out_v;
            }else{
                $out_tele = $out_x;
            }
        }

        //date
        if($date!=""){
            $reg_date = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
            $tst_date = preg_match($reg_date, $date);
            if($tst_date){
                $out_date = $out_v;
            }else{
                $out_date = $out_x;
            }
        }
        try{
            $sql = "SELECT COUNT(*) FROM `prof` WHERE id_prof = ".$id.";";
            $pre = $conn->prepare($sql);
            $pre->execute();
            $rut = $pre->fetchColumn();
            if($rut == 1)
            {
                $req="";
                if($lname!=""){
                    $req = "UPDATE `prof` SET `nom` = '".$lname."' WHERE id_prof = '".$id."' ;";
                    $out_lname = $out_v;
                }
                if($fname!=""){
                    $req = $req."UPDATE `prof` SET `prenom` = '".$fname."' WHERE id_prof = '".$id."' ;";
                    $out_fname = $out_v;
                }
                if($cin!=""){
                    $req = $req."UPDATE `prof` SET `cin` = '".$cin."' WHERE id_prof = '".$id."' ;";
                    $out_cin = $out_v;
                }
                if($adr!=""){
                    $req = $req."UPDATE `prof` SET `adresse` = '".$adr."' WHERE id_prof = '".$id."' ;";
                    $out_adr = $out_v;
                }
                if($tel!=""){
                    $req = $req."UPDATE `prof` SET `tel` = '".$tel."' WHERE id_prof = '".$id."' ;";
                    $out_tele = $out_v;
                }
                if($email!=""){
                    $req = $req."UPDATE `prof` SET `email` = '".$email."' WHERE id_prof = '".$id."' ;";
                    $out_email = $out_v;
                }
                if($date!=""){
                    $req = $req."UPDATE `prof` SET `date_recrutement` = '".$date."' WHERE id_prof = '".$id."' ;"; 
                    $out_date = $out_v;
                }
                if($opt_depart!= 0){
                    $req = $req."UPDATE `prof` SET `id_depart` = '".$opt_depart."' WHERE id_prof = '".$id."' ;";
                    $out_opt_depart = $out_v;
                }
                if($opt_cours!= 0){
                    $req = $req."UPDATE `prof` SET `id_cours` = '".$opt_cours."' WHERE id_prof = '".$id."' ;";
                    $out_opt_cours = $out_v;
                }
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
                $out_id = $out_x;
            }
        }catch(Exception $exp){
            echo '<script> console.log("'.$exp->getMessage().'"); </script> ';
        }
    }
    if(isset($_POST["reset"])){
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
    
    function get_depart(){
        $sql = "SELECT * FROM `departement`; ";
        $tab = Connect($sql);
        foreach($tab as $t){
            $p = $t["nom_depart"];
            $d = $t["id_depart"];
            echo'<option value="'.$d.'">'.$p.'</option>';
        }
    }
    function get_cours(){
        $sql = "SELECT  * FROM `cours` ; ";
        $tab = Connect($sql);
        foreach($tab as $t){
            $p = $t["intitule"];
            $d = $t["id_cours"];
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
                    <li><a href="../Ajouter/index.php">Ajouter un professeur</a></li>
                    <li><a href="index.php">Modifier un professeur</a></li>
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
    <div class="alert_warning">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Danger!</strong> Ce id  pas exist 
    </div> 
    <div class="alert_success">
        <span class="closebtn" onclick="this.parentElement.style.display ='none'">&times;</span>  
        <strong>Modification!</strong> Bien fait.
    </div> 
    <!-- Formulaire d'ajouter professeur------------------------------------------------------------------------------------>
    <div class="Ajout">
        <p>Modifier un professeur par ID</p>
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
