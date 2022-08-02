<?php
    session_start();
    if(isset($_POST['btn_entrar'])){
        if(!empty($_POST['usuario']) && !empty($_POST['senha'])){
            $usuario = "Remilton";
            $senha   = "123456";

            if($usuario === $_POST['usuario'] && $senha === $_POST['senha']){
                $_SESSION['usuario'] = $_POST['usuario'];
                $_SESSION['senha']   = $_POST['senha'];
                header('Location: pessoa');
            }else{
                $_SESSION['msg_error'] = "<p style='background-color: #eb7373;color: #fff;font-size: 14px;padding: 8px 5px;text-align: center;'>Usuário não encontrado!</p>";
            }
        }else{
            $_SESSION['msg_error'] = "<p style='background-color: #eb7373;color: #fff;font-size: 14px;padding: 8px 5px;text-align: center;'>Campos vazios!</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include 'includes/header.php'; ?>
<body>
    <main class="main main_login" id="main">
        <div class="container-menu">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center login_height">
                    <form class="form_login text-light shadow_login p-lg-5" method="post" id="form_login">
                        <?php
                            if(isset($_SESSION['msg_error'])){
                                echo $_SESSION['msg_error'];
                                unset($_SESSION['msg_error']);
                            }
                        ?>
                        <h3 class="text-center mb-4">SCI Test</h3>
                        <div class="mb-4">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Escreva seu usuário" required>
                        </div>

                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Escreva sua senha" required>
                        </div>

                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" name="btn_entrar" id="btn_entrar" value="Entrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>