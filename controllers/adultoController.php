<?php  
/**
 * 
 */
class adultoController extends controller
{
	
    public function index()
	{
		if (isset($_SESSION['LOGIN']) && !empty($_SESSION['LOGIN'])) {

		$adulto = new modelAdulto();

		$dados = array
		(
			'info_adulto' 	=> $adulto->listarAll(),
			'info_casamento' 	=> $adulto->listarCasamentos(),
			'info_quadrilha' 	=> $adulto->listarQuadrilhas(),
			'info_marcador' 	=> $adulto->listarMarcador()

		);

		$this->loadTemplate('homeAdulto', $dados);
		
		}else{
			header('Location:'.BASE_URL.'usuario');
		}
	}

	public function quadrilha($id_participante, $id_categoria)
	{
		if (isset($_SESSION['LOGIN']) && !empty($_SESSION['LOGIN'])) {
		$dquadrilha 		= new modelQuadrilha();
		$dado_quadrilha 	= $dquadrilha->listarQuadrilhas($id_participante, $id_categoria);
		$info_participante 	= new modelParticipante();

		$dados = array
		(
			'info_part' => $info_participante->participante($id_participante), 
		);

		//verifica se quadrilha não está inserido, se não estiver encaminha consegue inserir notas e acessar form

		if (isset($_POST['evolucao']) && !empty($_POST['evolucao'])) {
			$evolucao 		= $_POST['evolucao'];
			$figurino 		= $_POST['figurino'];
			$animacao 		= $_POST['animacao'];
			$alinhamento	= $_POST['alinhamento'];
			$coreografia 	= $_POST['coreografia'];
			$harmonia 		= $_POST['harmonia'];
			$dquadrilha -> cadastrar($evolucao, $figurino, $animacao, $alinhamento, $coreografia, $harmonia, $id_participante, $id_categoria);
			header('Location:'.BASE_URL.'adulto');
		}

		if (empty($dado_quadrilha)) {
		$this->loadTemplate('apuracaoAdultoQuadrilha', $dados);
		}else{
		header('Location:'.BASE_URL.'adulto');
		}

		}else{
			header('Location:'.BASE_URL.'usuario');
		}
	}
	public function casamento($id_participante, $id_categoria)
	{
		if (isset($_SESSION['LOGIN']) && !empty($_SESSION['LOGIN'])) {
		$dcasamento 				= new modelCasamento();
		$info_participante 			= new modelParticipante();
		$dado_casamento 			= $dcasamento->listarCasamentos($id_participante, $id_categoria);

		//verifica se quadrilha não está inserido, se não estiver encaminha consegue inserir notas e acessar form
		$dados = array
		(
			'info_part' => $info_participante->participante($id_participante), 
		);

		if (isset($_POST['vest_tradicional']) && !empty($_POST['vest_tradicional'])) {
			$vest_tradicional 		= $_POST['vest_tradicional'];
			$originalidade 			= $_POST['originalidade'];
			$deprec_preconceituoso	= $_POST['deprec_preconceituoso'];
			$dcasamento -> cadastrar($vest_tradicional, $originalidade, $deprec_preconceituoso, $id_participante, $id_categoria);
			header('Location:'.BASE_URL.'adulto');
		}

		if (empty($dado_casamento)) {
		$this->loadTemplate('apuracaoAdultoCasamento', $dados);
		}else{
		header('Location:'.BASE_URL.'adulto');
		}

		}else{
			header('Location:'.BASE_URL.'usuario');
		}
	}

	public function marcador($id_participante, $id_categoria)
	{
		if (isset($_SESSION['LOGIN']) && !empty($_SESSION['LOGIN'])) {
		$dmarcador 				= new modelMarcador();
		$info_participante 		= new modelParticipante();
		$dado_marcador 			= $dmarcador->listarMarcador($id_participante, $id_categoria);
		$dados = array
		(
			'info_part' => $info_participante->participante($id_participante), 
		);
		//verifica se quadrilha não está inserido, se não estiver encaminha consegue inserir notas e acessar form

		if (isset($_POST['desenvoltura']) && !empty($_POST['desenvoltura'])) {
			$desenvoltura 		= $_POST['desenvoltura'];
			$lideranca 			= $_POST['lideranca'];
			$animacao			= $_POST['animacao'];
			$figurino			= $_POST['figurino'];
			$dmarcador -> cadastrar($desenvoltura, $lideranca, $animacao, $figurino, $id_participante, $id_categoria);
			header('Location:'.BASE_URL.'adulto');
		}

		if (empty($dado_marcador)) {
		$this->loadTemplate('apuracaoAdultoMarcador', $dados);
		}else{
		header('Location:'.BASE_URL.'adulto');
		}

		}else{
			header('Location:'.BASE_URL.'usuario');
		}
	}

	public function classificacao()
	{
		if (isset($_SESSION['LOGIN']) && !empty($_SESSION['LOGIN'])) {
		
		$user = explode('-', $_SESSION['LOGIN']);
		//verifica as permissões do usuario
		if ($user[3] == 'comissao') {

		$adulto = new modelAdulto();

		$dados = array();
		$categoria = '';
		if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
			$categoria = $_POST['categoria'];
		}

		if ($categoria == '1') {
		
			$dados = array
				(
					'info_adulto' => $adulto->classificacaoQuadrilha(),
					'val_categoria' => $categoria
				);
		}

		if ($categoria == '2') {
		
			$dados = array
				(
					'info_adulto' => $adulto->classificacaoCasamento(),
					'val_categoria' => $categoria
				);
		}

		if ($categoria == '3') {
		
			$dados = array
				(
					'info_adulto' => $adulto->classificacaoMarcador(),
					'val_categoria' => $categoria
				);
		}

		if ($categoria == '') {
			$dados = array
				(
					'classificacao_quadrilha' => $adulto->classificacaoQuadrilha(),
					'classificacao_casamento' => $adulto->classificacaoCasamento(),
					'classificacao_marcador' => $adulto->classificacaoMarcador(),
				);
		}
		
		$this->loadTemplate('classificacaoAdulto', $dados); 
		//se não tiver permissão
		}else{
			echo "não tem permissão";
		}
		}else{
			header('Location:'.BASE_URL.'usuario');
		}
	}

	public function quesitos()
	{
		if (isset($_SESSION['LOGIN']) && !empty($_SESSION['LOGIN'])) {
		$dquesitos = new modelAdulto();
		$user = explode('-', $_SESSION['LOGIN']);
		//verifica as permissões do usuario
		if ($user[3] == 'comissao') {

		$dados = array
		(
			'info_quesitos_quadrilha' => $dquesitos->fQuesitosQuadrilha(), 
			'info_quesitos_casamento' => $dquesitos->fQuesitosCasamento(),
			'info_quesitos_marcador' => $dquesitos->fQuesitosMarcador(),  
		);	
		
		$this->loadTemplate('classificacaoQuesitoAdulto', $dados);

		}else{
			header('Location:'.BASE_URL.'usuario');
		}
		}
	}

}
?>