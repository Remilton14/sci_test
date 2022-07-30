<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include 'includes/header.php'; ?>
<body>
    <main class="main" id="main">
        <div class="container-menu shadow">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center login_height">
                    <form class="form_login shadow p-lg-5" method="post" id="form_login">
                        <h3 class="text-center mb-4">SCI Test</h3>
                        <div class="mb-4">
                            <label for="exampleInputEmail1" class="form-label">Usuário</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Entrar</button>
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