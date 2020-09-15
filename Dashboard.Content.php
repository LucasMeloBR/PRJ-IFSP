<?php 


    require("common.php");
	require("db.php");
  
    if(empty($_SESSION['email'])) 
    { 
    
        header("Location: index.html"); 
   
        die("Redirecting to index.html"); 
    } 

    if(!empty($_POST)) 
    { 

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Endereço de E-mail inválido"); 
        } 

        if($_POST['email'] != $_SESSION['email']['email']) 
        { 
        
            $query = " 
                SELECT 
                     * 
                FROM users 
                WHERE 
                    email = :email,
					nome = :nome
					
            "; 
             
   
            $query_params = array( 
                ':email' => $_POST['email'],
                ':nome' => $_POST['nome']
            ); 
             
            try 
            { 
     
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params);
            } 
            catch(PDOException $ex) 
            { 
 
                die("Falha ao rodar a query: " . $ex->getMessage()); 
            } 
  
            $row = $stmt->fetch(); 
            if($row) 
            { 
                $die("Esse endereço de E-mail já está em uso"); 
            } 
        } 
         
        if(!empty($_POST['password'])) 
        { 
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
            $password = hash('sha256', $_POST['password'] . $salt); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $password = hash('sha256', $password . $salt); 
            } 
        } 
        else 
        { 

            $password = null; 
            $salt = null; 
        } 
         

        $query_params = array( 
            ':email' => $_POST['email'],
			':nome' => $_POST['nome'],
            ':user_id' => $_SESSION['email']['id']
			
        ); 

        if($password !== null) 
        { 
            $query_params[':password'] = $password; 
            $query_params[':salt'] = $salt; 
        } 
         
        $query = " 
            UPDATE users 
            SET 
                email = :email,
				nome = :nome
				
        "; 
         
        if($password !== null) 
        { 
            $query .= " 
                , password = :password 
                , salt = :salt
            "; 
        } 

        $query .= " 
            WHERE 
                id = :user_id
        "; 
        try 
        { 

            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
      
            die("Falha ao rodar a query: " . $ex->getMessage()); 
        } 
    
        $_SESSION['email']['email'] = $_POST['email']; 
		$_SESSION['email']['nome'] = $_POST['nome'];
		
        header("Location: Dashboard.Content.php"); 
         
        die("Redirecting to Dashboard.Content.php"); 
    }
     
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PRJPDCA - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="font/iconsmind/style.css" />
    <link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/fullcalendar.min.css" />
    <link rel="stylesheet" href="css/vendor/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="css/vendor/datatables.responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="css/vendor/select2.min.css" />
    <link rel="stylesheet" href="css/vendor/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="css/vendor/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="css/vendor/nouislider.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="css/main.css" />
	<style>
		a.theme-button{
			position: 0 !important;
		}
	</style>
</head>

<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>

            <div class="search" data-search-path="Layouts.Search.html?q=">
                <input placeholder="Buscar...">
                <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
            </div>
        </div>


        <a class="navbar-logo" href="Dashboard.Content.php">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <a class="btn btn-sm btn-outline-primary mr-2 d-none d-md-inline-block mb-2" href="#">&nbsp;INTRANET&nbsp;</a>
				
                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">Olá <?php echo htmlentities($_SESSION['email']['nome'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span>
                        <img alt="Profile Picture" src="img/profile-pic-l-6.jpg" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight">Editar Perfil</a>
                    <a class="dropdown-item" href="logout.php" id="close" href="#">Sair</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li class="active">
                        <a href="Dashboard.Content.php">
                            <i class="iconsmind-Home-Window"></i>
                            DASHBOARD
                        </a>
                    </li>
                    <li>
                        <a href="##" id="processos">
                            <i class="simple-icon-loop"></i> PROCESSOS
                        </a>
                    </li>
                    <li>
                        <a href="##" id="actionplan">
                            <i class="simple-icon-list"></i> PLANO DE AÇÃO
                        </a>
                    </li>
					<li>
                        <a href="##" id="relatorios">
                            <i class="simple-icon-chart"></i> RELATÓRIOS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
		<div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
				<div class="modal-dialog" role="document">
								<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Editar Usuário</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">

												<form action="Dashboard.Content.php" method="post">

									<div class="form-group">
										<label for="name">Nome Completo</label>
										<input type="text" class="form-control" id="name" name="nome" value="<?php echo htmlentities($_SESSION['email']['nome'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Informe um nome">
									</div>
									<div class="form-group">
										<label for="email">Endereço de E-mail</label>
										<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
											placeholder="Informe um endereço de e-mail" value="<?php echo htmlentities($_SESSION['email']['email'], ENT_QUOTES, 'UTF-8'); ?>">
										<small id="emailHelp" class="form-text text-muted">Não iremos compartilhar seu e-mail com ninguém.</small>
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Informe uma Senha</label>
										<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Caso não queira alterar a senha, deixe esse campo em branco" value="">
									</div>
									<div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" value="Atualizar Conta">Atualizar</button>
                                    </div>
								</form>
								</div>
							</div>
				</div>
		 </div>
	<div id="principal">
	<main id="main">
		<div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 progress-banner">
                        <?php $query = "SELECT * FROM action_plan";$result = mysqli_query($connection, $query); $num_total_rows = mysqli_num_rows($result);?>
						<?php
                    		$query = "SELECT * FROM action_plan WHERE status = 'EM ANDAMENTO'";
                    		$result = mysqli_query($connection, $query);
							$num_rows = mysqli_num_rows($result);
							echo '<div class="card-body justify-content-between d-flex flex-row align-items-center">
                            <div>
                                <i class="iconsmind-Gears mr-2 text-white align-text-bottom d-inline-block"></i>
                                <div>
									<p class="lead text-white">'.$num_rows.' Plano(s)</p>
                                    <p class="text-small text-white">Em execução com status (EM ANDAMENTO)</p>
                                </div>
                            </div>
                            <div>
                                <div role="progressbar" class="progress-bar-circle progress-bar-banner position-relative"
                                    data-color="white" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="'.$num_rows.'" aria-valuemax="'.$num_total_rows.'" data-show-percent="false">
                                </div>
                            </div>
                        </div>'
                    	?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4 progress-banner">
						<?php $query = "SELECT * FROM action_plan";$result = mysqli_query($connection, $query); $num_total_rows = mysqli_num_rows($result);?>
						<?php
                    		$query = "SELECT * FROM action_plan WHERE status = 'EM ABERTO'";
                    		$result = mysqli_query($connection, $query);
							$num_rows = mysqli_num_rows($result);
							echo '<div class="card-body justify-content-between d-flex flex-row align-items-center">
                            <div>
                                <i class="iconsmind-Add-File mr-2 text-white align-text-bottom d-inline-block"></i>
                                <div>
									<p class="lead text-white">'.$num_rows.' Plano(s)</p>
                                    <p class="text-small text-white">Pendentes Preenchimento com estatus (EM ABERTO)</p>
                                </div>
                            </div>
                            <div>
                                <div role="progressbar" class="progress-bar-circle progress-bar-banner position-relative"
                                    data-color="white" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="'.$num_rows.'" aria-valuemax="'.$num_total_rows.'" data-show-percent="false">
                                </div>
                            </div>
                        </div>'
                    	?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4 progress-banner">
                        <?php $query = "SELECT * FROM action_plan";$result = mysqli_query($connection, $query); $num_total_rows = mysqli_num_rows($result);?>
						<?php
                    		$query = "SELECT * FROM action_plan WHERE status = 'CONCLUÍDO'";
                    		$result = mysqli_query($connection, $query);
							$num_rows = mysqli_num_rows($result);
							echo '<div class="card-body justify-content-between d-flex flex-row align-items-center">
                            <div>
                                <i class="iconsmind-Like mr-2 text-white align-text-bottom d-inline-block"></i>
                                <div>
									<p class="lead text-white">'.$num_rows.' Plano(s)</p>
                                    <p class="text-small text-white">Planos de ação concluídos com status (CONCLUÍDO)</p>
                                </div>
                            </div>
                            <div>
                                <div role="progressbar" class="progress-bar-circle progress-bar-banner position-relative"
                                    data-color="white" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="'.$num_rows.'" aria-valuemax="'.$num_total_rows.'" data-show-percent="false">
                                </div>
                            </div>
                        </div>'
                    	?>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Planos de ação por status</h5>
                            <div class="chart-container">
                                <canvas id="polarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <div class="chart-container">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Planos de Ação Concluídos por Tipo KPI</h5>
                            <div class="dashboard-line-chart">
                                <canvas id="productChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</main>
	</div>
	
	<script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
	<script src="js/vendor/perfect-scrollbar.min.js"></script>
	<script src="js/vendor/jquery.validate/jquery.validate.min.js"></script>
	<script src="js/vendor/jquery.validate/additional-methods.min.js"></script>
	<script src="js/vendor/datatables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="js/vendor/Chart.bundle.min.js"></script>
    <script src="js/vendor/chartjs-plugin-datalabels.js"></script>
    <script src="js/vendor/moment.min.js"></script>
    <script src="js/vendor/fullcalendar.min.js"></script>
    <script src="js/vendor/datatables.min.js"></script>
    <script src="js/vendor/perfect-scrollbar.min.js"></script>
    <script src="js/vendor/owl.carousel.min.js"></script>
    <script src="js/vendor/progressbar.min.js"></script>
    <script src="js/vendor/jquery.barrating.min.js"></script>
    <script src="js/vendor/select2.full.js"></script>
    <script src="js/vendor/nouislider.min.js"></script>
    <script src="js/vendor/bootstrap-datepicker.js"></script>
    <script src="js/vendor/Sortable.js"></script>
    <script src="js/vendor/mousetrap.min.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>
	<script>
		$(document).ready(function(){
    		$('#actionplan').click(function(){
        	$('#main').load("Dashboard.ActionList.php");
    		});
			$("#processos").click(function(){
        	$("#main").load("Dashboard.Processos.php");
    		});
			$("#relatorios").click(function(){
        	$("#main").load("Dashboard.Reports.php");
    		});
		});
	</script>
	<script>
		$(function(){
    		$(".nav li a").click(function(e){
        	e.preventDefault();
        	var url = this.href;
        	$(".main").load(url);
    		});
		});
	</script>
</body>
</html>