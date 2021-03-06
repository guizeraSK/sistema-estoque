<?php 
    //Iniciando conexão
    include("classe/conexao.php");

    //Iniciando Sessão
    session_start();

    if(isset($_POST['btn-entrar'])){
        $erros = array();
        $login = mysqli_escape_string($mysqli, $_POST['login']);
        $senha = mysqli_escape_string($mysqli, $_POST['senha']);

        //Verificação de autenticação
        //Obs: Eu tentei continuar usando o "if{}" mas estava dando erro e eu não entendi o porque até agora, então fiz com este modelo de "if"

        if(empty($login) or empty($senha)):
            $erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
        else:
    
            $sql = "SELECT login FROM usuarios WHERE login = '$login'";
            $resultado = mysqli_query($mysqli, $sql);		
    
            if(mysqli_num_rows($resultado) > 0):
            $senha = md5($senha);       
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
    
    
    
            $resultado = mysqli_query($mysqli, $sql);
    
                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);
                    mysqli_close($mysqli);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    echo "<script> location.href='index.php?p=it_cadastrados'</script>";
                else:
                    $erros[] = "<li> Usuário e senha não conferem </li>";
                endif;
    
            else:
                $erros[] = "<li> Usuário inexistente </li>";
            endif;
    
        endif;
             
        

    }
?>


<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <script src="https://kit.fontawesome.com/0844b1c776.js" crossorigin="anonymous"></script>
    </head>
    <body class="bb">
    <?php  
        if(!empty($erros)){
            foreach($erros as $erro){
                echo $erro;
            }
        }
    ?>
    
       <!-- Formulário criado para sessão de login -->
        <form class="form3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="box">
                <div class="icon-log-shop">SK Store<img src="https://i.pinimg.com/originals/d9/36/de/d936debe26c54ae7c9d1285f9ce920da.jpg" class="icon-loja"></div>
                <h1>Login</h1>
                <input type="text" name="login" placeholder="Username">
                <input type="password" name="senha" placeholder="Password">
               
                <button type="submit" name="btn-entrar"><i class="fas fa-sign-in-alt"></i> Entrar</button>
                <!-- Aqui eu tentei colocar o button mas se eu coloco ele não redireciona para o .php -->

                <button type="submit" onclick="redirecionar();"><i class="fas fa-user-plus"></i> Cadastrar</button>
            </div>
        </form>

        <script src="script.js"></script>


    </body>
</html>




<!-- <a href="index.php?p=cadastro_usu" target="_blank">  -->