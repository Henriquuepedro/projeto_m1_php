<?php 
if(isset($_SESSION['ID'])){
	$cod_user = $_SESSION['ID'];
	$sql_pedido = "SELECT * FROM pedido_finalizado WHERE NCODUSER = $cod_user";
	$query_pedido = mysqli_query($conn, $sql_pedido);
	$resultado_pedido = mysqli_fetch_assoc($query_pedido);
	$qnt_merc_pedido = mysqli_num_rows($query_pedido);

	if($qnt_merc_pedido > 0){
?>
<br>
<table class="tabela-prod">
	<thead class="head-cart">
		<tr bgcolor="#CD853F">
			<td style="padding:10px">COD</td>
			<td style="padding:10px">STATUS</td>
			<td style="padding:10px">VALOR LÌQUIDO</td>
			<td style="padding:10px">QUANTIDADE</td>
			<td style="padding:10px">DATA DO PEDIDO</td>
			<td style="padding:10px">VISUALIZAR</td>
		</tr>
	</thead>
	<tbody class="body-cart">
		<?php
		$a = 0;
		$vlr_total = 0;
			while (($a < 1) || ($resultado_pedido = mysqli_fetch_assoc($query_pedido))){
				$id_fim = $resultado_pedido['NCODPEDIDO'];
				$quantidade = $resultado_pedido['QNT_PEDIDO'];
				$valor = $resultado_pedido['VALOR_PEDIDO'];
				$data = $resultado_pedido['DATA'];
				$a =$a + 1;
		?>
		<tr>
			<td width="5%" style="padding-left:10px"> 				
				<p><?php echo $id_fim ?></p>
			</td>
			<td width="45%" style="padding-left:10px"> 				
				<p>PEDIDO FINALIZADO</p>
			</td>
			<td width="15%" style="padding-left:10px"> 				
				<p>R$ <?php echo $valor ?></p>
			</td>
			<td width="5%" style="padding-left:10px"> 				
				<p align="center"><?php echo $quantidade ?></p>
			</td>
			<td width="15%" style="padding-left:10px"> 				
				<p><?php echo date('d/m/Y H:i',  strtotime($data))?></p>
			</td>
			<td width="15%" style="padding-left:10px"> 				
				<a class="botao" href="index.php?url=pedido&COD=<?php echo $id_fim ?>">Ver Detalhes</a>
			</td>
			
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
	<?php
	}else{
		echo '<h3 align="center">Você ainda não fez nenhum pedido!</h3>
				<div align="center"><a class="botao" href="index.php?url=produtos">Fazer Pedido Agora</a></div>';
	}
	}else{
		header("Location: index.php?url=login");
	}
	?>