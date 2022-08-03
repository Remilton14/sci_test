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
    #table_sala_evento_filter{
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
                <table class="table table-striped" id="table_sala_evento">
                    <thead>
                        <tr>
                            <th scope="col">Cód</th>
                            <th scope="col">Nome da sala</th>
                            <th scope="col">Lotação max.</th>
                            <th scope="col">Inscritos</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $arr_salas = array();
                            $sql_salas = "SELECT * FROM `sala_evento` WHERE 1";
                            $sql_salas_query = mysqli_query($conn, $sql_salas);

                            while($sql_salas_assoc = mysqli_fetch_assoc($sql_salas_query)){
                                array_push($arr_salas,$sql_salas_assoc['id_sala']);
                                ?>
                                    <tr style="font-size:0.8769rem;">
                                        <th scope="row"><?= $sql_salas_assoc['id_sala'] ?></th>
                                        <td><?= $sql_salas_assoc['nome_sala'] ?></td>
                                        <td><?= $sql_salas_assoc['lotacao_sala'] ?></td>
                                        <td><?= $sql_salas_assoc['qnt_inscritos'] ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <!-- Visualização -->
                                                <a type="button" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;" data-bs-toggle="modal" data-bs-target="#visualizacao<?= $sql_salas_assoc['id_sala'] ?>"><i class='bx bx-zoom-in'></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="visualizacao<?= $sql_salas_assoc['id_sala'] ?>" tabindex="-1" aria-labelledby="visualizacao<?= $sql_salas_assoc['id_sala'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="visualizacao<?= $sql_salas_assoc['id_sala'] ?>Label">Visialização <?= $sql_salas_assoc['id_sala'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nome_sala_de_evento" class="form-label">Nome sala de Eventos</label>
                                                                            <input type="text" class="form-control" value="<?= $sql_salas_assoc['nome_sala'] ?>" disabled>
                                                                        </div>
                                                                        <div class="col mb-3">
                                                                            <label for="lotacao_sala_evento" class="form-label">Lotação da sala</label>
                                                                            <input type="number" class="form-control" value="<?= $sql_salas_assoc['lotacao_sala'] ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim Visualização -->


                                                <!-- Edição -->
                                                <a type="button" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;" data-bs-toggle="modal" data-bs-target="#edicao<?= $sql_salas_assoc['id_sala'] ?>"><i class='bx bxs-edit'></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="edicao<?= $sql_salas_assoc['id_sala'] ?>" tabindex="-1" aria-labelledby="edicao<?= $sql_salas_assoc['id_sala'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="edicao<?= $sql_salas_assoc['id_sala'] ?>Label">Visialização <?= $sql_salas_assoc['id_sala'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="class/Class.edicao.sala.eventos.php" method="post" id="sala_evento_edicao<?= $sql_salas_assoc['id_sala'] ?>">
                                                                    <input type="hidden" name="id_sala" value="<?= $sql_salas_assoc['id_sala'] ?>"">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nome_sala_de_evento" class="form-label">Nome sala de Eventos</label>
                                                                            <input type="text" class="form-control" name="nome_sala_de_evento" id="nome_sala_de_evento<?= $sql_salas_assoc['id_sala'] ?>" value="<?= $sql_salas_assoc['nome_sala'] ?>">
                                                                        </div>
                                                                        <div class="col mb-3">
                                                                            <label for="lotacao_sala_evento" class="form-label">Lotação da sala</label>
                                                                            <input type="number" class="form-control" name="lotacao_sala_evento" id="lotacao_sala_evento<?= $sql_salas_assoc['id_sala'] ?>" value="<?= $sql_salas_assoc['lotacao_sala'] ?>">
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                                                                        <input type="button" class="btn btn-primary btn-sm" name="btn_edicao_evento" id="btn_edicao_evento<?= $sql_salas_assoc['id_sala'] ?>" value="Editar">
                                                                    </div>
                                                                </form>
                                                                <div class="error_msg_notification_edicao position-absolute text-danger" id="error_msg_notification_edicao" style="bottom: 10px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim edição -->

                                                <!-- Delete -->
                                                <a href="class/Class.delete.sala.evento.php?id_sala=<?= $sql_salas_assoc['id_sala'] ?>" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;"><i class='bx bx-message-alt-x'></i></a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
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
            var arr_salas = ["<?php echo implode('","',$arr_salas); ?>"];

            $.each(arr_salas,function(index,value){

                $('#nome_sala_de_evento' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });

                $('#lotacao_sala_evento' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });

                $('#btn_edicao_evento' + value).click(function(){

                    var nome_sala_de_evento = $('#nome_sala_de_evento' + value).val();
                    var lotacao_sala_evento = $('#lotacao_sala_evento' + value).val();

                    if(nome_sala_de_evento == ''){

                        $('#nome_sala_de_evento' + value).addClass('border border-danger');
                        $('#nome_sala_de_evento' + value).focus();
                        
                        $('#error_msg_notification_edicao').append('<span">O campo nome precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                    }else if(lotacao_sala_evento == ''){

                        $('#lotacao_sala_evento' + value).addClass('border border-danger');
                        $('#lotacao_sala_evento' + value).focus();
                        
                        $('#error_msg_notification_edicao').append('<span">O campo nome precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                    }else{
                        $('#sala_evento_edicao' + value).submit();
                    }

                });

            });
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