<!DOCTYPE html>

<html>
<head>

<head>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <title>Carrinho</title>
    <link rel="stylesheet" type="text/css" href="home1.css">
    <link rel="icon" href="imagens/KANAKO.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
</head>
  
</head>
<body class="fundo">
<div class="topo">
        <ul class="nav">
        <li><a href="home.php"><img src="imagens/KANAKO.png"></a></li>
        <li><a href="home.php"><i class="fa fa-home fa-lg" style="padding: 1.95rem 1rem;"></i>Home<b></a></b></li>
        <li><a href="#"><b><h4>Sobre nós</h4></a></b></li>
        <li style="float: right" onclick="confirmar()"><a href="logout.php" style="padding: 0.5rem 2.3rem;"><b><h4>Log Out</h4></a></b></li>      
        </ul>
    </div>
<div class="conteudo">
<?php
include 'conectar.php';
include 'checkLogin.php';

$iduser = $_SESSION['id'];

    if(isset($_POST['sub'])){
    	
        $product_id = (int)$_POST['idProduto'];
        $quantity = (int)$_POST['quantity'];
        $nomeProduto = $_POST['nomeProduto'];

        $idCompra = $_SESSION['id'];  
        $sqlcompra="        
		select * from compra where fk_IdUser={$idCompra} and valorCompraTotal is NULL
		";
	$qu1=mysqli_query($con,$sqlcompra);
    while($id=  mysqli_fetch_assoc($qu1)){
    $idcarrinho = $id['IdCompra'];

        $sqlGetCompra="select * from compra_produto where FKCOMPRA={$idcarrinho} AND FKPRODUTO ={$product_id}";

        $queryGetCompra= mysqli_query($con, $sqlGetCompra);
        $resultCompra=mysqli_fetch_assoc($queryGetCompra);
        $ExisteCompra = isset($resultCompra);    
        if(isset($resultCompra)){
            if($quantity > 0){
            $sqlAddOrUpdate = "
            UPDATE compra_produto set QTD_PRODUTO={$quantity} 
            WHERE FKPRODUTO ={$product_id} and FKCOMPRA={$idcarrinho};
            ";
            }else {
            $sqlAddOrUpdate = "delete from compra_produto where FKPRODUTO ={$product_id} and FKCOMPRA={$idcarrinho}";
            }
        }        
    }
        mysqli_query($con, $sqlAddOrUpdate);
        // header('location:home.php');
    }
?>

<div class="container">
<div class="tablewrap">
    <div style="width: 100%; display: flex;">
    <div class="firstrow">
        <div class="rowitem">
            Id
        </div>

        <div class="rowitemimg">
            Imagem
        </div>

        <div class="rowitem1">
            Item
        </div>

        <div class="rowitem2">
            Preço(Unidade)
        </div>


    </div>
    <div class="txt">
    <span>Quantidade</span>
    </div>
    </div>
    

<div class="wrapt">
<?php
        $idCompra = $_SESSION['id'];  
        $sqlcompra="        
		select * from compra where fk_IdUser={$idCompra} and valorCompraTotal is NULL
		";
	$qu1=mysqli_query($con,$sqlcompra);
    while($id=  mysqli_fetch_assoc($qu1)){
    $idcarrinho = $id['IdCompra'];

$sq="
select * from produto as p
left join compra_produto as cp on cp.FKPRODUTO = P.IDPRODUTO where qtd_produto > 0 AND FKCOMPRA ={$idcarrinho}

";

$qu=mysqli_query($con,$sq);

while($produto=  mysqli_fetch_assoc($qu)){
    ?>  <div class="in">
        <div class="produtorow">
            <div class="produtoid"><?php echo $produto['IdProduto']?></div>
     
            <div class="ImgTable"><img width="auto" height="50px" src="<?php echo $produto['img']?>"></div>

            <div class="NomeProduto"><?php echo $produto['nomeProduto']?></div>
      
            <div class="PrecoProduto">R$ <?php echo $produto['preco']?></div>
        </div> 

            <div class="in2">
            <form method='POST' enctype='multipart/form-data' id='form' name='form'>
                <input class="inputnumbers" type="number" name="quantity" value="<?=$produto['QTD_PRODUTO']?>" min="0" placeholder="<?php echo $produto['qtd_produto']?>" required>
                <input type="hidden" name="idProduto" value="<?=$produto['IdProduto']?>">
                <input type="hidden" name="nomeProduto" value="<?=$produto['nomeProduto']?>">
                <input class="inputsend" type="submit" name="sub" value="+">
            </form>

            </div>

        </div>
    <?php
}
}
?>
</div>
</div>

<hr style="background-color: #9A9A9A; margin-top: 2rem; margin-bottom: 2rem;">


<div class="tablewrap">

    <div class="in">
    <div class="firstrow">
        <div class="rowitema">
            Produto
        </div>

        <div class="rowitemb">
            Preço
        </div>

        <div class="rowitemc">
            Quantidade
        </div>

        <div class="rowitemd">
           Preço Total
        </div>


    </div>
    </div>

<div class="wrapt">
<?php
$total = 0;

     $idCompra = $_SESSION['id'];  
        $sqlcompra="        
		select * from compra where fk_IdUser={$idCompra} and valorCompraTotal is NULL
		";
	$qu1=mysqli_query($con,$sqlcompra);
    while($id=  mysqli_fetch_assoc($qu1)){
    $idcarrinho = $id['IdCompra'];
$sq="

SELECT * FROM compra_produto as cp
inner join compra as c on c.IDCOMPRA = cp.FKCOMPRA
inner join produto as p on p.IDPRODUTO = cp.FKPRODUTO where idCompra={$idcarrinho}

";

$qu=mysqli_query($con,$sq);
while($compra_produto=  mysqli_fetch_assoc($qu)){
    ?>

    <div class="produtorow">
    
        <div class="Item1">
            <?php echo $compra_produto['nomeProduto']?>
        </div>
        <div class="Item2">
            R$ <?php echo $compra_produto['preco']?>
        </div>
        <div class="Item3">
            <?php echo $compra_produto['qtd_produto']?>
        </div>
        <div class="Item4">
            R$ <?php echo $compra_produto['qtd_produto']*$compra_produto['preco']?>
        </div>

    </div>
    <?php
    $total1 = $compra_produto['qtd_produto']*$compra_produto['preco'];
    $total += $total1;
}
   	if ( isset($_POST['fim']) )
    {
        $SQL = "
            UPDATE compra set valorCompraTotal={$total}, dataCompra= CURRENT_TIME
            WHERE IdCompra={$idcarrinho};
            ";
            header("Refresh:0");
        mysqli_query($con, $SQL);
    }
}
?>

</div>
</div>
</div> <!---->
<p>Total da compra: R$ <?php echo "$total"; ?></p>
<form method='POST' enctype='multipart/form-data' id='form1' name='form1'>
<button name="fim" methot="POST" class="finalizar">Finalizar compra</button>
</form>
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


</body>
</html>