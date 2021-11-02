<?php
	/*
	private $para = $_POST['para'];
	private $assunto = $_POST['assunto'];
	private $mensagem = $_POST['mensagem'];
	*/

	class Mensagem {

		private $para = null;
		private $assunto = null;
		private $mensagem = null;

		public function __get($attr) {

			return $this->$attr;

		}

		public function __set($atributo, $valor) {

			$this->$atributo = $valor;

		}

		public function mensagemValida() {
			//
		}

	}

	$mensagem = new Mensagem();

	$mensagem->__set('para', $_POST['para']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem', $_POST['mensagem']);


	print_r($mensagem);
?>