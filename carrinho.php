<?php
	session_start();
	if(!isset($_SESSION['itens']))
	{

		$_SESSION['itens'] = $arrayName = array( );

	}

	if (isset($_GET['add']) && $_GET['add'] == "carrinho"){
		/*Adiciona ao Carrinho*/
		$idProduto = $_GET['id_produto'];
		if(!isset($_SESSION['itens'][$idProduto]))
		{
			$_SESSION['itens'][$idProduto] = 1;
		}else{

			$_SESSION['itens'][$idProduto] += 1;
		}
	}
	/*Exibe o Carrinho*/
	if(count($_SESSION['itens']) == 0){
		echo 'Carrinho Vazio<br><a href="index.php">Adicionar itens</a>';
	}else{

		$conexao = new PDO ('mysql:host=localhost;dbname=lista_produtos',"root","");
		
		foreach ($_SESSION['itens'] as $idProduto => $quantidade) {
		
		$select = $conexao->prepare("SELECT * FROM produtos WHERE id_produto=?");
		$select->bindParam(1,$idProduto);
		$select->execute();
		$produtos = $select->fetchALL();
		$total = $quantidade * $produtos[0]["preco-produto"];

		echo 
			'Nome: '.$produtos[0]["nome_produto"].'<br/>
				Preço:' .number_format($produtos[0]["preco-produto"],2,",",".").'<br/>
					Quantidade: '.$quantidade.'<br/>
					Total:  '.number_format($total,2,",",".").'<br/>
						<a href="remover.php?remover=carrinho&id_produto='.$idProduto.'">Remover</a>
						

						<hr/>
					';


	}
		echo 'Continuar Comprando<br><a href="index.php">Clique aqui</a>';
	}
