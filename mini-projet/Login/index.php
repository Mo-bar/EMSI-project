<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="index.php">
    <title>Login </title>
</head>
<?php
    $conn = new PDO("mysql:host=localhost;dbname=EMSI;","root","");

    $out_v ='<div style="color:green;"> &#10004; </div> '; // print V -> Valide
    $out_x ='<div style="color:red;">&#10008; </div> ';    // print X -> Error

    $out_user ="";
    $out_pw ="";
    if(isset($_POST["go"]))
    {
        $user = $_POST["user"];
        $pw = $_POST["pw"];

        if($user =="")
        {
            $out_user = $out_x;
        }else
        {
            try
            {
                $sql = "SELECT count(*) FROM `login_ser` WHERE `login`= '".$user."' AND `pw`= '".$pw."';";
                $sql = $conn->prepare($sql);
                $sql->execute();
                $res = $sql->fetchColumn();
                if($res==0)
                {
                    $out_user = $out_x;
                    $out_pw = $out_x;
                }else
                {
                    $out_user = $out_v;
                    $out_pw = $out_v;
                    header("Location: ../Servaillant/Home/Index/index.html");
                }
                
            }catch(Exception $exp)
            {

            }
        }
    }
?>
<body>
    <div class="navbar">
        <div class="logo">
            <a href="index.php"><img src="../Servaillant/Logo/logo.png"  alt="logo"></a> 
        </div> 
    </div>

    <div class="login">
        <form method="post" action="index.php" >
            <table>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td> <label for="user" > Utilisateur </label></td>  <td><input type="text" placeholder="admin" id="user" name="user"  ></td>
                </tr>
                <tr>
                    <td> <label for="pw" > Mot de pass </label></td>  <td><input type="password" placeholder="admin" id="pw" name="pw"  ></td>
                </tr>
                <tr>
                    <td><input type="submit" class="btn" value="Se Connecter" name="go"> </td>
                    <td><input type="reset" class="btn" value="Reset" name="reset"></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                
            </table>
        </form>
    </div>

</body>
</html>