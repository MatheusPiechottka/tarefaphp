<!DOCTYPE html>

<html>
<head>

<head>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <title>Carrinho</title>
    <link rel="stylesheet" type="text/css" href="home3.css">
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
include 'checkadm.php';
?>



<div class="container">
<div class="tablewrap">
    <div style="width: 100%; display: flex;">
    <div class="firstrow">
        <div class="rowitem">
            Id
        </div>

        <div class="rowitemimg">
            Ação
        </div>

        <div class="rowitem1">
            Tempo
        </div>

        <div class="rowitem2">
            User(ID/Username)
        </div>


    </div>
    <div class="txt">
    <span></span>
    </div>
    </div>


<div class="wrapt">
<div class="in">
<?php
$sql = "select * from log as p
left join logtipo as cp on cp.logtipoID = P.fk_logtipo
left join users as pc on pc.Iduser = P.fk_Idusuario
";

$result = $con->query($sql);

while ($row = mysqli_fetch_array($result)) 
{   
?>    
     <div class="produtorow">
            <!--LOGS-->
            <div class="logid"><?php echo $row['logID']?></div>
     
            <div class="logtipo"><?php echo $row['logtipotexto']?></div>

            <div class="tempolog"><?php echo $row['tempolog'] ?></div>
      
            <div class="fkusuario"><?php echo $row['fk_Idusuario'] ?>  <?php echo $row['Username'] ?></div>
        </div>
<?php 
} 
?>


</div>

</div>
</div>

<hr style="background-color: #9A9A9A; margin-top: 2rem; margin-bottom: 2rem;">

</div>
</div> <!---->
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