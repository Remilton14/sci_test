<?php
    session_start();
    if(isset($_SESSION['usuario']) && isset($_SESSION['senha'])){

        include_once 'class/Class.Conection.php';
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include 'includes/header.php'; ?>
<style>
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px !important;
        padding:5px 12px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 100% !important;
        padding: 5px 15px !important;
    }
    #tabela_pessoas_filter{
        margin-right:10% !important;
    }
    .form-control:focus ,.form-select:focus {
        box-shadow: none !important;
    }
</style>
<body>
    <main class="main" id="main">
        <div class="container-menu shadow-sm">
            <div class="container">

                <div class="menu pt-1 pb-1" id="menu">
                    <?php include 'includes/menu.php'; ?>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <!-- Botão novo cadastro -->
            <div class="text-end">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo Cadastro</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Novo cadastro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="class/Class.cadastro.sala.evento.php" method="post" id="form_cadastro_evento">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nome_sala_de_evento" class="form-label">Nome sala de Eventos</label>
                                        <input type="text" class="form-control" name="nome_sala_de_evento" id="nome_sala_de_evento">
                                    </div>
                                    <div class="col mb-3">
                                        <label for="lotacao_sala_evento" class="form-label">Lotação da sala</label>
                                        <input type="number" class="form-control" name="lotacao_sala_evento" id="lotacao_sala_evento">
                                    </div>
                                </div>
                               
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <input type="button" class="btn btn-primary" name="btn_cadastra_evento" id="btn_cadastra_evento" value="Cadastrar">
                                </div>
                            </form>
                            <div class="error_msg_notification position-absolute text-danger" id="error_msg_notification" style="bottom: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim novo cadastro -->
            <div class="tabela">
                <table class="table table-striped" id="table_sala_eventos">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            if(isset($_SESSION['msg_success'])){
                echo $_SESSION['msg_success'];
            }elseif(isset($_SESSION['msg_error'])){
                echo $_SESSION['msg_error'];
            }
        ?>
    </main>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/sala_eventos.js"></script>
    <script>
        $(document).ready(function(){
            const msg_success = <?php echo (isset($_SESSION['msg_success'])) ? 1 : 0 ?>;
            const msg_error = <?php echo (isset($_SESSION['msg_error'])) ? 1 : 0 ?>;
            if(msg_success === 1 || msg_error === 1){
                setTimeout(() => {
                    $('#msg').remove();
                }, 3200);
            }

            //edição
        });    
    </script>
</body>
</html>
<?php
        if(isset($_SESSION['msg_success'])){
            unset($_SESSION['msg_success']);
        }elseif(isset($_SESSION['msg_error'])){
            unset($_SESSION['msg_error']);
        }

    }
?>