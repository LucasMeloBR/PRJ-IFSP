<?php 

    // Arquivo comum de conexão com o Banco de dados 
    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        // Garante que um usuario inserido não é um usuário vazio
        if(empty($_POST['nome'])) 
        { 
            
            die("Por favor insira seu nome."); 
        } 
         
        // Garante que uma senha inserida não é uma senha em branco
        if(empty($_POST['password'])) 
        { 
            die("Por favor insira uma senha."); 
        } 
         
        // Garante que um e-mail inserido é um e-mail válido 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
			die("Endereço de E-mail inválido.");
        } 
          
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        // Retorna se já existe um e-mail igual cadastrado na base.
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
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
            die("Esse endereço de E-mail já está registrado"); 
        } 
         
        $query = " 
            INSERT INTO users ( 
                nome, 
                password, 
                salt, 
                email
				
            ) VALUES ( 
                :nome, 
                :password, 
                :salt, 
                :email
            ) 
        "; 
         
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
     
        $password = hash('sha256', $_POST['password'] . $salt); 
        
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
          
        $query_params = array( 
            ':nome' => $_POST['nome'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email']
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
         
        // Redireciona para a página de login.
        header("Location: index.html"); 
         
        die("Redirecting to index.html"); 
    } 
     
?> 
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro - PRJPDCA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="font/iconsmind/style.css" />
    <link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>

<body class="background show-spinner">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="image-side">
                            <p class="text-white h4" align="center">
                                Por favor, preencha os campos para efetuar o cadastro de novo usuário.
                            </p>
                        </div>
                        <div class="form-side">
                            <a href="#">
                                <span class="logo-single"></span>
                            </a>
                            <h6 class="mb-4">Cadastro de novo usuário</h6>

                            <form action="cadastro.php" method="post">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="nome" value=""/>
                                    <span>Nome</span>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="email" value="" />
                                    <span>E-mail</span>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="" name="password" value="" />
                                    <span>Senha</span>
                                </label>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit" name='btn_login' value="Register">CADASTRAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>