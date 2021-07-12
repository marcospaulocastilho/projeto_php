<?php

		$conexao = new PDO ('mysql:host=localhost;dbname=lista_produtos',"root","");


		$select = $conexao->prepare("SELECT * FROM produtos");
		$select->execute();
		$fetch = $select->fetchALL();

		foreach ($fetch as $produtos) {
				echo 'Nome do  Produto: '.$produtos['nome_produto'].' &nbsp; Quantidade: ' .$produtos['qts_produto'].'
				&nbsp; Preço: R$ '.number_format($produtos['preco-produto'],2,",",".").'
				<a href="carrinho.php?add=carrinho&id_produto='.$produtos['id_produto'].'">Adicionar ao Carrinho </a> <br/>';

					}
			
