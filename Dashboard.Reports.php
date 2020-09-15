<?php

	require("db.php");
	require("common.php");

?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h1>Tabela de Action Itens</h1>
        <div class="top-right-button-container">
          <div class="btn-group">
            <button class="btn btn-outline-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EXPORT</button>
            <div class="dropdown-menu">
				<a class="dropdown-item" id="dataTablesCopy" href="#">COPIAR</a> 
				<a class="dropdown-item" id="dataTablesExcel" href="#">EXCEL</a> 
				<a class="dropdown-item" id="dataTablesCsv" href="#">CSV</a> 
				<a class="dropdown-item" id="dataTablesPdf" href="#">PDF</a>
			  </div>
          </div>
        </div>
        <div class="mb-2"><a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">Display Options <i class="simple-icon-arrow-down align-middle"></i></a>
          <div class="collapse dont-collapse-sm" id="displayOptions">
            <div class="d-block d-md-inline-block">
              <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                <input class="form-control" placeholder="Buscar na tabela" id="searchDatatable">
              </div>
            </div>
            <div class="float-md-right dropdown-as-select" id="pageCountDatatable"><span class="text-muted text-small">Displaying 1-10 of 40 items </span>
              <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">10</button>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">5</a> <a class="dropdown-item active" href="#">10</a> <a class="dropdown-item" href="#">20</a></div>
            </div>
          </div>
        </div>
        <div class="separator"></div>
      </div>
    </div>
		<div class="row">
			<div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
				<table id="datatableRows" class="data-table responsive nowrap" data-order="[[ 1, &quot;desc&quot; ]]">
					<thead>
						<tr>
							<th>ID</th>
							<th>DESCRIÇÃO</th>
							<th>STATUS</th>
							<th>SQUAD / TEAM</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	
	<script src="js/vendor/jquery-3.3.1.min.js"></script>
	<script src="js/vendor/bootstrap.bundle.min.js"></script>
	<script src="js/vendor/perfect-scrollbar.min.js"></script>
	<script src="js/vendor/jquery.validate/jquery.validate.min.js"></script>
	<script src="js/vendor/jquery.validate/additional-methods.min.js"></script>
	<script src="js/vendor/datatables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
	<script src="js/vendor/select2.full.js"></script>
	<script src="js/dore.script.js"></script>
	<script src="js/scripts.js"></script>

<script>
	$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});
</script>
<script>
		
  $(document).ready(function() {
      $('#datatableRows').dataTable({
        "bProcessing": true,
        "sAjaxSource": "reports_data.php",
        "aoColumns": [
              { mData: 'id_ac' },
              { mData: 'nome_ac' },
              { mData: 'status' },
				{ mData: 'where_ac' },
			
            ]
      });  
  });
</script>