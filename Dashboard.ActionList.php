<?php
	require("db.php");
?>
<div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>Planos de Ação</h1>
						
                        <div class="float-sm-right text-zero">
							
                                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-lg mr-1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ADICIONAR NOVO
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" data-toggle="modal" href="#addkpi">KPI</a>
                                        <a class="dropdown-item" data-toggle="modal" href="#addactionplan">PLANO DE AÇÃO</a>
                                    </div>
                        </div>
                    </div>
					<!-- Modal KPI -->
					<div class="modal fade" id="addkpi" tabindex="-1" role="dialog"
                            aria-labelledby="addModallabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModallabel">Adicionar Novo KPI</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addkpi" method="post" action="adicionakpi.php">
                                			<div class="form-row">
												<div class="col-md-12 mb-3">
                                        			<label for="inputCkpi">Selecione uma categoria cadastrada abaixo ou informe o nome da nova categoria</label>
                                        			<select id="inputCkpi" name="inputCkpi" class="form-control">
														<option selected></option>
                                            			<?php
                                        				$query = "SELECT * FROM kpi";
                                        				$result = mysqli_query($connection, $query);
                                        				if (mysqli_num_rows($result) > 0) {
                                            			while ($inputCkpi = mysqli_fetch_assoc($result)) {
                                                		echo '<option value="'.$inputCkpi['id_kpi'].'">'.$inputCkpi['nome_kpi'].'</option>';
                                            					}
                                        					}
                                        				?>
                                        			</select>
                                    			</div>
                                			</div>
											<div class="form-row">
											<div class="col-md-12 mb-3">
                                        			<label for="categoria">Nome da categoria do KPI</label>
													<input type="text" class="form-control" id="categoria" name="categoria" placeholder=""required>
                                        			<div class="invalid-feedback">Por favor, informe uma descrição.</div>
                                    			</div>
											</div>
											
											<div class="form-row">
                                    			<div class="col-md-12 mb-3">
                                        			<label for="indicadornew">Nome do Indicador</label>
													<input type="text" class="form-control" id="indicadornew" name="indicadornew" placeholder="Por favor, informe o nome do indicador."required>
                                    			</div>
											</div>
											<div class="modal-footer justify-content-center">
                                        		<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        		<button type="submit" class="btn btn-primary">Adicionar</button>
                                    		</div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
					<div class="modal fade" id="addactionplan" tabindex="-1" role="dialog"
                            aria-labelledby="addModallabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModallabel">Adicionar Novo Plano</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form data-toggle="validator" action="funcoes.php" method="post">
                                            <div class="form-row">
                                    			<div class="col-md-6 mb-3">
                                        			<label for="inputCkpi2">Categoria do KPI</label>
                                        			<select id="inputCkpi2" name="inputCkpi2" class="form-control">
														<option selected></option>
                                            			<?php
                                        				$query = "SELECT * FROM kpi";
                                        				$result = mysqli_query($connection, $query);
                                        				if (mysqli_num_rows($result) > 0) {
                                            			while ($inputCkpi2 = mysqli_fetch_assoc($result)) {
                                                		echo '<option value="'.$inputCkpi2['id_kpi'].'">' . $inputCkpi2['nome_kpi'] . '</option>';
                                            					}
                                        					}
                                        				?>
                                        			</select>
                                    			</div>
                                    			<div class="col-md-6 mb-3">
                                        			<label for="indicador2">Indicador</label>
                                        			<select id="indicador2" name="indicador2" class="form-control">
                                            			<option selected></option>
                                        			</select>
                                    			</div>
                                			</div>
                                			<div class="form-row">
                                    			<div class="col-md-9 mb-3">
                                        			<label for="description">Descrição</label>
													<input type="text" class="form-control" id="description" name="description" placeholder="Descrição"required>
                                        			<div class="invalid-feedback">Por favor, informe uma descrição.</div>
                                    			</div>
                                    			<div class="col-md-3 mb-3">
                                        			<label for="inputstatus">Status</label>
                                        			<input type="text" class="form-control" id="inputstatus" name="inputstatus" value="EM ABERTO" readonly="true">
                                    			</div>
                                			</div>
											<div class="form-row">
                                    			<div class="col-md-6 mb-3">
                                        			<label for="whattext">WHAT</label>
													<input type="text" class="form-control" id="whattext" name="whattext" placeholder="Por favor, informe o que ocorreu."required>
                                    			</div>
                                    			<div class="col-md-6 mb-3">
                                        			<label for="whotext">WHO</label>
													<input type="text" class="form-control" id="whotext" name="whotext" placeholder="Por favor, informe quem irá atuar."required>
                                    			</div>
                                			</div>
											<div class="form-row">
                                    			<div class="col-md-6 mb-3">
                                        			<label for="whytext">WHY</label>
													<input type="text" class="form-control" id="whytext" name="whytext" placeholder="Por favor, informe por quê ocorreu."required>
                                    			</div>
                                    			<div class="col-md-6 mb-3">
                                        			<label for="howtext">HOW</label>
													<input type="text" class="form-control" id="howtext" name="howtext" placeholder="Por favor, informe como será resolvido."required>
                                    			</div>
                                			</div>
											<div class="form-row">
                                    			<div class="col-md-4 mb-3">
                                        			<label for="wheretext">WHERE</label>
													<input type="text" class="form-control" id="wheretext" name="wheretext" placeholder="Por favor, informe onde será feita a correção."required>
                                    			</div>
                                    			<div class="col-md-4 mb-3">
													<label for="howmuch">HOW MUCH</label>
                                					<div class="input-group-prepend">
                                    					<span class="input-group-text">R$</span>
														<input type="text" id="howmuch" name="howmuch" class="form-control" aria-label="Amount (to the nearest real)">
                                					<div class="input-group-append">
                                    					<span class="input-group-text">,00</span>
                                					</div>
                                					</div>
                            					</div>
												<div class="col-md-4 mb-3">
                                        			<label for="benefitstext">BENEFÍCIOS</label>
													<input type="text" class="form-control" id="benefitstext" name="benefitstext" placeholder="Por favor, informe os benefícios."required>
                                    			</div>
                                			</div>
											<div class="col-md12 mb-3">
                                    			<div class="form-group mb-3">
                                        			<label>DATAS</label>
                                        			<div class="input-daterange input-group" id="datepicker">
                                            			<input type="text" class="input-sm form-control" id="dataini" name="dataini" placeholder="DATA INÍCIO" />
                                            			<span class="input-group-addon"></span>
                                            			<input type="text" class="input-sm form-control" id="datafim" name="datafim" placeholder="DATA FINAL" />
                                        			</div>
                                    			</div>
                        					</div>
											<div class="form-row">
                                    			<div class="col-md-4 mb-3">
                                        			<label for="focaltext">FOCAL POINT</label>
													<input type="text" class="form-control" id="focaltext" name="focaltext" placeholder="Por favor, informe o ponto focal."required>
                                    			</div>
                                    			<div class="col-md-4 mb-3">
                                        			<label for="ownertext">OWNER</label>
													<input type="text" class="form-control" id="ownertext" name="ownertext" placeholder="Por favor, informe o owner."required>
                                    			</div>
												<div class="col-md-4 mb-3">
                                        			<label for="managertext">MANAGER</label>
													<input type="text" class="form-control" id="managertext" name="managertext" placeholder="Por favor, informe o gerente."required>
                                    			</div>
                                			</div>
											<div class="modal-footer justify-content-center">
                                        		<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        		<button type="submit" id="enviar" class="btn btn-primary">Adicionar</button>
                                    		</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="modal fade" id="editaractionplan" tabindex="-1" role="dialog"
                            aria-labelledby="addModallabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    
                                </div>
                            </div>
                        </div>
						<div class="modal fade" id="actiondel" tabindex="-1" role="dialog"
                            aria-labelledby="delModallabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    
                                </div>
                            </div>
                        </div>

                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                            role="button" aria-expanded="true" aria-controls="displayOptions">
                            Mostrar Opções
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse d-md-block" id="displayOptions">
                            <div class="float-md-right">
								<?php
                    				$query = "SELECT * FROM action_plan";
                    				$result = mysqli_query($connection, $query);
									$num_rows = mysqli_num_rows($result);
									echo '<span class="text-muted text-small">Mostrando 1-10 de '.$num_rows.' items </span>'
                    			?>
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    10
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item active" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                    <a class="dropdown-item" href="#">50</a>
                                    <a class="dropdown-item" href="#">100</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 list" data-check-all="checkAll">
					
					<?php
                    	$query = "SELECT * FROM action_plan ORDER BY id_ac DESC";
                    	$result = mysqli_query($connection, $query);
                    		if (mysqli_num_rows($result) > 0) {
                    		while ($actionplan = mysqli_fetch_assoc($result)) {
                    		echo '
						<div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
							
                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <a class="list-item-heading mb-1 truncate w-40 w-xs-100">'.$actionplan['nome_ac'].'</a>
                                <p class="mb-1 text-muted text-medium w-15 w-xs-100">'.$actionplan['focal_point'].'</p>
								<p class="mb-1 text-muted text-medium w-15 w-xs-100">'.$actionplan['where_ac'].'</p>
								<p class="mb-1 text-muted text-medium w-15 w-xs-100">R$ '.$actionplan['how_much'].',00</p>
								<p class="mb-1 text-muted text-medium w-15 w-xs-100">'.$actionplan['start_up'].'</p>
                                <p class="mb-1 text-muted text-medium w-15 w-xs-100">'.$actionplan['final_date'].'</p>
                                <div class="w-15 w-xs-100">
                                    <span class="badge badge-pill badge-secondary">'.$actionplan['status'].'</span>
                                </div>
                            </div>
                            <div class="btn-group-xs align-self-center justify-content-center mr-2  mb-1" role="group">
                              		<button type="button" data-toggle="modal" href="#editaractionplan" data-id="'.$actionplan['id_ac'].'" value="'.$actionplan['id_ac'].'" name="btn" class="btn btn-info mb-1 btn-outline-dark openModal" id="btn_edit">EDITAR</button>
                              		<button type="button"href="#actiondel" data-toggle="modal" data-id="'.$actionplan['id_ac'].'" value="'.$actionplan['id_ac'].'" class="btn btn-outline-danger mb-1 excluir">EXCLUIR</button>
                         	</div>
                        </div>
                    </div>';
                    		}
                    	}
                    ?>
                    <!--<nav class="mt-4 mb-3">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item ">
                                <a class="page-link first" href="#">
                                    <i class="simple-icon-control-start"></i>
                                </a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link prev" href="#">
                                    <i class="simple-icon-arrow-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link next" href="#" aria-label="Next">
                                    <i class="simple-icon-arrow-right"></i>
                                </a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link last" href="#">
                                    <i class="simple-icon-control-end"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>-->
                </div>
            </div>
</div>
	<script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/fullcalendar.min.js"></script>
    <script src="js/vendor/bootstrap-datepicker.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>

	<script>
  	$('.openModal').on("click",function(){
      var id = $(this).attr('data-id');
      $.ajax({url:"modaledit.php?id="+id,cache:false,success:function(result){
          $(".modal-content").html(result);
      }});
  	});
	</script>
	<script>
  	$('.excluir').on("click",function(){
      var id = $(this).attr('data-id');
      $.ajax({url:"modaldelete.php?id="+id,cache:false,success:function(result){
          $(".modal-content").html(result);
      }});
  	});
	</script>

<script type="text/javascript">
	
    var kpi_textbox = document.getElementById('categoria');
    var kpi_dropdown = document.getElementById('inputCkpi');

    kpi_dropdown.onchange = function(){
			kpi_textbox.value = "";
          kpi_textbox.value = kpi_textbox.value  + this.value; //to appened
         //mytextbox.innerHTML = this.value;
    }
	</script>
	<script>
		$(document).ready(function(){

    $("#inputCkpi2").change(function(){
        var indid = $(this).val();

        $.ajax({
            url: 'getindicador.php',
            type: 'post',
            data: {indicadorid:indid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#indicador2").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id_tipo_kpi'];
                    var name = response[i]['nome_tipo_kpi'];
                    
                    $("#indicador2").append("<option value="+id+">"+name+"</option>");

                }
            }
        });
    });

});
	</script>

	<!--<script>
		$(document).ready(function(){
    		$("#edituser").click(function(){
        	$("#main").load("useredit.php");
		});
	</script>--><!--
	<script>
	$(function(){
    	$(".nav li a").click(function(e){
        e.preventDefault();
        var url = this.href;
        $(".main").load(url);
    	});
	});
	</script>
	<script>
	$(document).ready(function(){	
	$('#AddActionPlan').submit(function () {

	var categoria_kpi = $('#inputCkpi2').val();
    var indicador = $('#indicador2').val();
    var description = $('#description').val();
    var inputstatus = $('#inputstatus').val();
    var whattext = $('#whattext').val();
    var whotext = $('#whotext').val();
    var whytext = $('#whytext').val();
    var howtext = $('#howtext').val();
    var wheretext = $('#wheretext').val();
	var howmuch = $('#howmuch').val();
	var benefitstext = $('#benefitstext').val();
	var dataini = $('#dataini').val();
	var datafim = $('#datafim').val();
	var focaltext = $('#focaltext').val();
	var ownertext = $$('#ownertext').val();
	var managertext = $$('#managertext').val();
	var inputGroupFile01 = $('#inputGroupFile01').val();
	
	
    $.ajax({
        url: 'funcoes.php',
		type: 'post',
        dataType: 'json',
        data: {
            categoria_kpi: categoria_kpi,
            indicador: indicador,
            description: description,
            inputstatus: inputstatus,
            whattext: whattext,
			whotext: whotext,
			whotext: whotext,
			whytext: whytext,
			howtext: howtext,
			wheretext: wheretext,
			howmuch: howmuch,
			benefitstext: benefitstext,
			dataini: dataini,
			datafim: datafim,
			focaltext: focaltext,
			ownertext: ownertext,
			managertext: managertext,
			inputGroupFile01: inputGroupFile01,
            add_actionplan: ''

        },
		success: function (response) {
            if (response.done == true) {
                $('#AddActionPlan').modal('hide');
                window.location.href = 'Dashboard.ActionList.php';
            } else {
                $('.response').html('<div class="alert alert-primary rounded" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
            }
        }
    });

    return false;
});
	});
	</script>-->
