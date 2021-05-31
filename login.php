<?php
// Conexão com banco de dados 
include'conectar.php';

if(isset($_POST['sub'])){
    $u=$_POST['Name'];
    $p=$_POST['Pass'];
    $s= "select * from users where Username='$u' and Senha= '$p'";

    date_default_timezone_set('America/Sao_Paulo');
    $time = date( 'Y-m-d H:i:s' );

    $qu= mysqli_query($con, $s);

    if(mysqli_num_rows($qu)>0){
        $f= mysqli_fetch_assoc($qu);
        $_SESSION['id']=$f['Iduser'];
        $_SESSION['profile']=$f['fk_adm_Idadm'];

        $sql = "INSERT INTO log (fk_logtipo, tempolog, fk_idusuario) values ('1', '$time' ,'{$_SESSION['id']}')";
        $result = $con->query($sql);

        header ('location:home.php'); 
    }
    #
    #
   else{
     
   }
  
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="reglog.css">
	<link rel="icon" href="imagens/Kanako.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body class=fundo>

	</div><br><br><br><br><br><br>
	<div class="container">
		<a href="#"><img src="imagens/Kanako.png"></a>

    <div id="ErrMsg" class="opacity">
    <span id="erro" style="padding: 1.5rem;"></span>
    </div>
		<div class="login">
			<h2>Login</h2>
 			<form method="POST" enctype="multipart/form-data" id="form">
    			<label for="fname">Nome de usuário</label>
    			<input type="text" id="fname" name="Name" placeholder="Nome de usuário" required>

    			<label for="lname">Senha</label>
    			<input type="password" id="lname" name="Pass" placeholder="Senha" required>

    			<div id="btnDIV"><input type="submit" value="Logar" name="sub" id="sub1" onclick="errorMessage()">
           </div>
 			</form>
       <a href="register.php"><input type="submit" value="Não tenho conta"></a>
		</div>
	</div>

</body>
</html>	