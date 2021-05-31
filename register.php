<?php
// Conexão com banco de dados 
include'conectar.php';

if(isset($_POST['sub'])){
    $t=$_POST['Nome'];
    $u=$_POST['Username'];
    $v=$_POST['Mail'];
    $w=$_POST['Pass'];
    if($_FILES['img']['name']){
    move_uploaded_file($_FILES['img']['tmp_name'], "imagens/".$_FILES['img']['name']);
    $img="imagens/".$_FILES['img']['name'];
    }
    $i="insert into users(Nome,Username, Senha, Email, fk_adm_Idadm, Img)value('$t','$u','$w','$v', '2', '$img')";
    mysqli_query($con, $i);
    header ('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="reglog.css">
	<link rel="icon" href="imagens/Kanako.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body class=fundo>

	</div><br><br><br>
	<div class="container reg">
		<a href="https://www.nutaku.com/games/fap-ceo-online/"><img src="imagens/Kanako.png"></a>

    <div id="ErrMsg" class="opacity">
    <span id="erro" style="padding: 1.5rem;"></span>
    </div>
		<div class="login">
			<h2>Registro</h2>
 			<form method="POST" enctype="multipart/form-data" id="form">
    			<label for="fname">Nome de usuário</label>
    			<input type="text" id="fname" name="Nome" placeholder="Nome de usuário" required>
    			<label for="fname">Apelido</label>
    			<input type="text" id="fname" name="Username" placeholder="Apelido" required><br>
    			<label for="fname">E-mail</label>
    			<input type="email" id="fname" name="Mail" placeholder="E-Mail" required>   			

    			<label for="lname">Senha</label>
    			<input type="password" id="lname" name="Pass" placeholder="Senha" required>
    			<label for="fname" class="file">Imagem de perfil</label>
    			<input type="file" id="fname" name="img" placeholder="imagem de perfil" required>

    			<div id="btnDIV"><input type="submit" value="Registrar" name="sub" onclick="errorMessage()">
    				</div>
 			</form>
 			  <a href="login.php"><input type="submit" value="Já tenho conta"></a>
		</div>
	</div>

</body>
</html>	