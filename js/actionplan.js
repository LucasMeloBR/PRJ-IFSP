$('#add_actionplan').submit(function () {

	var categoria_kpi = $('#inpuCkpi2').val();
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
        type: 'post',
        url: 'funcoes.php',
        dataType: 'JSON',
        data: {
            categoria_kpi:categoria_kpi,
            indicador:indicador,
            description:description,
            inputstatus:inputstatus,
            whattext:whattext,
			whotext:whotext,
			whotext:whotext,
			whytext:whytext,
			howtext:howtext,
			wheretext:wheretext,
			howmuch:howmuch,
			benefitstext:benefitstext,
			dataini:dataini,
			datafim:datafim,
			focaltext:focaltext,
			ownertext:ownertext,
			managertext:managertext,
			inputGroupFile01:inputGroupFile01,
            add_actionplan:''

        },
        success: function (response) {
            if (response.done == true){
                document.getElementById("add_actionplan").reset();
                $('.emp-response').html('<div class="alert alert-primary rounded" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>Plano cadastrado com sucesso</div>');
            }else{
                $('.emp-response').html('<div class="alert alert-primary rounded" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
            }
        }
    });

    return false;
});// JavaScript Document