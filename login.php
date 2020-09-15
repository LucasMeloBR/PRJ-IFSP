<?php 

    // Arquivo comum de conexão com o Banco de dados 
    require("common.php"); 
     
    // Variavel para mostrar o e-mail enviado.
    $submitted_email =''; 
     
    // Checa se o form foi submetido
    if(!empty($_POST)) 
    { 
        // Recebe as informações do banco utilizando o usuario inserido.
        $query = " 
            SELECT 
                id,
                nome, 
                password, 
                salt, 
                email
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        // Valores de parametro
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
            // Executa a query no banco
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        {   
            die("Falha ao executar a query: " . $ex->getMessage()); 
        } 
         
        //Informa se o usuario foi logado com sucesso ou nao.
        $login_ok = false; 
         
        $row = $stmt->fetch(); 
        if($row) 
        { 
            // Criptografia de senha para o banco de dados.
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
                $login_ok = true; 
            } 
        } 
         
        // ISe logado com sucesso, vai para a página de dados privados
        if($login_ok) 
        { 
             
            unset($row['salt']); 
            unset($row['password']); 
             
            $_SESSION['email'] = $row; 
             
            // Reredicionamento para a pagina privada.  
            header("Location: Dashboard.Content.php"); 
            die("Redirecting to: Dashboard.Content.php"); 
        } 
        else 
        { 
       
            print("Falha no Login."); 
             
            $submitted_email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'); 
        } 
    }
     
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - PRJPDCA</title>
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
                                Por favor, use suas credenciais para fazer login no sistema.
                            </p>
                        </div>
                        <div class="form-side">
                            <a href="#">
                                <span class="logo-single"></span>
                            </a>
                            <h6 class="mb-4">Login</h6>
                            <form action="login.php" method="post">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="email" id='email' value="<?php echo $submitted_email; ?>" />
                                    <span>E-mail</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type='password' name="password" id='password'  value="" />
                                    <span>Senha</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="RecuperaSenha.html">Esqueceu sua senha?</a>
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit" name='btn_login' value="Login" action="index.php">ENTRAR</button>
                                </div>
								<a href="cadastro.php">Efetuar cadastro.</a>
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