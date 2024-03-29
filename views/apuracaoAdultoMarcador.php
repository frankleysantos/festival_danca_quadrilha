<h4 align="center">Avaliação de Notas Adulto (Quesito Marcador)</h4>
<form action="" method="POST" role="form">
	<legend>Participante: <?=utf8_encode($info_part['nome'])?></legend>
	
	<div class="row form-group">
		<div class="col-md">
			<label for="">Desenvoltura</label>
			<input type="number" class="form-control" id="" name="desenvoltura" min="5" max=10 required="required">
		</div>
		<div class="col-md">
			<label for="">Liderança</label>
			<input type="number" class="form-control" id="" name="lideranca" min="5" max=10 required="required">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md">
			<label for="">Animação</label>
			<input type="number" class="form-control" id="" name="animacao" min="5" max=10 required="required">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md">
			<label for="">Figurino</label>
			<input type="number" class="form-control" id="" name="figurino" min="5" max=10 required="required">
		</div>
	</div>

 	<div class="row form-group">
 		<div class="col-md d-flex justify-content-start">
 			<a href="<?=BASE_URL?>adulto" class="btn btn-dark">Voltar</a>
 		</div>
 		<div class="col-md d-flex justify-content-end">
 			<button type="submit" class="btn btn-primary">Avaliar</button>
 		</div>
	</div>
</form>