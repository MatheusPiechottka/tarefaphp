<?php
include 'conectar.php';
include 'checkLogin.php';


    if(isset($_POST['sub'])){
    
        $product_id = (int)$_POST['idProduto'];
        $quantity = (int)$_POST['quantity'];
        $nomeProduto = $_POST['nomeProduto'];
        $idProduto = $_POST['id1'];
        $idCompra = $_SESSION['id'];
        $sqlcompra1="        
        select * from compra where fk_IdUser={$idCompra} and valorCompraTotal is NULL
        ";

        date_default_timezone_set('America/Sao_Paulo');
        $time = date( 'Y-m-d H:i:s' );


        $querycompra1 = mysqli_query($con, $sqlcompra1);
        $resultCompra1=mysqli_fetch_assoc($querycompra1);
        $ExisteCompra1 = isset($resultCompra1);    
        if(isset($resultCompra1)){

        }else{
        $sqlcompra2="        
            INSERT INTO compra (fk_IdUser, dataCompra)
            VALUES ({$idCompra}, (NULL));                        
            ";
        $que2=mysqli_query($con,$sqlcompra2);

        }

        $que=mysqli_query($con,$sqlcompra1);
        while($id=  mysqli_fetch_assoc($que)){
        $idcarrinho = $id['IdCompra'];

        $sqlprocura="        
        select * from compra_produto where FKCOMPRA={$idcarrinho} AND FKPRODUTO ={$idProduto}
        ";
        $queryprocura= mysqli_query($con, $sqlprocura);
        $resultCompra=mysqli_fetch_assoc($queryprocura);
        $ExisteCompra = isset($resultCompra);

        if(isset($resultCompra)){
            $sqlAddOrUpdate = "
            UPDATE compra_produto set QTD_PRODUTO={$quantity} 
            WHERE FKPRODUTO ={$idProduto} and FKCOMPRA={$idcarrinho};
            ";
            #Log
            $log = "INSERT INTO log (fk_logtipo, tempolog, fk_idusuario) values ('6', '$time' ,'{$_SESSION['id']}')";

        }else{
            $sqlAddOrUpdate = "
            INSERT INTO compra_produto (FKPRODUTO,FKCOMPRA,QTD_PRODUTO) 
            VALUES ({$idProduto}, {$idcarrinho}, {$quantity});
            ";
            #Log
            $log = "INSERT INTO log (fk_logtipo, tempolog, fk_idusuario) values ('4', '$time' ,'{$_SESSION['id']}')";
        }
        /*$result = $con->query($log);*/
        mysqli_query($con, $sqlAddOrUpdate);
        mysqli_query($con, $log);
        // header('location:home.php');
    }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="icon" href="imagens/KANAKO.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta charset="utf-8">
</head>
<body class=fundo>
	<div class="topo">
		<ul class="nav">
		<li><a href="home.php"><img src="imagens/KANAKO.png"></a></li>
		<li><a href="#"><b><h4>Sobre nós</h4></a></b></li>
		<li style="float: right" onclick="confirmar()"><a href="logout.php" style="padding: 0.5rem 2.3rem;"><b><h4>Log Out</h4></a></b></li>
		<li style="float:right"><a href="carrinho.php"><i class="fa fa-shopping-cart fa-lg" style="padding: 1.95rem 2.3rem;"></i><b></a></b></li>
		<!--<?php
		if(!isset($_SESSION['id'])){
}else{	
	?>
<li style="float: right"><a href="logout.php"><b><h4>Log Out</h4></a></b></li>
<?php
}
?>
		</ul>-->
	</div>

	<div class="conteudo">
        <!--Titulo-->
            <div id="sidebar" class="Sidebar-1" style="display: flex;">     
                <div class="container toproll shadow" style="flex: 1;">

                    <div class="topcard">
                        <i class="fa fa-bookmark"></i>
                        Bem Vindo
                    </div>

                    <div class="texto">
                        <p>
                        Acorde para uma nova era cheia de inovações.
                        </p>
                        <p>Banco de dados, Segurança, Design de web</p>
                        <p><a href="">saiba mais</a></p>
                    </div>
                </div>

                <div class="container shadow toproll" style="flex: 1;">
                    <div class="topcard">
                        <i class="fa fa-info icon"></i>
                        Informações
                    </div>
                    <p>
                        Com banco de dados seguros com criptografias atualizadas e únicas. Sempre prezamos pela sua privacidade.<br>
                        Nós mantemos sempre atualizados os nossos programas, corrigindo qualquer problema.<br>
                        Com designs únicos inovadores com fácil personalização.
                    </p>                
                </div>      
            </div>


		<ul id="lista">
			<div class="container shadow toproll" style="flex: 1; ">

				<div class="Profs">
					<div class="topcard">		
						<i class="fa fa-user icon"></i>	
						Produtos/carrinho
<!-- <?php

if(!isset($_SESSION['id'])){
}else{
    ?>
<button class="editar" onclick="adicionar1()" form="form" name="sub" onclick="!this.form&&$('#'+$(this).attr('form')).submit()"
  >Adicionar
</button>
<button class="editar" style="background-color: #F74529;" name="del" form="form" onclick="!this.form&&$('#'+$(this).attr('form')).submit()" 
  >Apagar
</button>
<input type='text' name='idd' placeholder='Id do produto a ser deletado' form="form" style="border-radius: 3px; width: 20%;">

<?php
}
?> -->
                        <input type="text" id="pesquisa" onkeyup="myFunction()" placeholder="Nome do produto">
                    </div>
                </div>

                <div class="galeria anyClass">

<?php
$sq="

select * from produto 
";
$qu=mysqli_query($con,$sq);
while($f=  mysqli_fetch_assoc($qu)){
    ?>          
                    <li> <form method="POST" enctype="multipart/form-data" id="form1" name="form1">
                         <a href="#">
                        <div style="flex: 1;">
                            <img src="<?php echo $f['img']?>"></a>
                            <f><p><?php echo $f['nomeProduto']?></p></f>
                            <p><i>Preço: <?php echo $f['preco']?></i></p>
                            <input type="number" name="quantity" value="<?=$produto['QTD_PRODUTO']?>" min="1" placeholder="Quantidade" required>
                            <input type="hidden" name="idProduto" value="<?=$f['fkProduto']?>">
                            <input type="hidden" name="id1" value="<?=$f['IdProduto']?>">
                            <input type="hidden" name="nomeProduto" value="<?=$produto['NOME_PRODUTO']?>">                       
                            <button type="submit" name="sub" value="Adicionar">Adicionar</button></form>
                        <!--    <?php
                            if(!isset($_SESSION['id'])){
}else{  
    ?><p><i>Id: <?php echo $f['IdProduto']?></i></p>
<?php
}
?>-->
                            <p><i></i></p>              
                        </div>
                    </li>
<?php
}
?>
                    <div class="break"></div>   
                </div>  
            </ul>
        </div>      

        <footer>
                <h3>Informações extras</h3>

               

                <h4>
                    Criado pelo time 
                    <span class="orange">
                    <b>KANAKO</b>
                    </span> (Matheus P. Silva, Gustavo Baltazar e Bruno Lotze)
                </h4>
        
        </footer>

    <script>
        function myFunction() {
          var input, filter, ul, li, f, i, txtValue;
          input = document.getElementById("pesquisa");
          filter = input.value.toUpperCase();
          ul = document.getElementById("lista");
             li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
               f = li[i].getElementsByTagName("f")[0];
               txtValue = f.textContent || f.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                 li[i].style.display = "";
                } else {
                  li[i].style.display = "none";
                }
         }
        }
    </script>

    <script>



  var loadFile = function(event) {
    var output = document.getElementById('img');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

function adicionar1() {
    document.getElementById("adicionar1").style.display = "none";
    location.reload();
}

</script>
<!--
  <div class='image-upload'>
  <label for='file-input'>
    <img src='imagens/portrato.png'/>
    <f><p>Professor 1</p></f>
    <i>Descrição do Professor</i>
  </label>
  <input id='file-input' type='file' />
</div>
-->

</body>
</html> 