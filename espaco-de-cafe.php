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
    #table_espaco_cafe_filter{
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
                            <form action="class/Class.cadastro.espaco.cafe.php" method="post" id="form_cadastro_espaco_cafe">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nome_espaco_cafe" class="form-label">Nome do espaço de café</label>
                                        <input type="text" class="form-control" name="nome_espaco_cafe" id="nome_espaco_cafe">
                                    </div>  
                                    <div class="col mb-3">
                                        <label for="lotacao_max_cafe" class="form-label">Lotacao Máxima</label>
                                        <input type="number" class="form-control" name="lotacao_max_cafe" id="lotacao_max_cafe">
                                    </div>              
                                </div>
                               
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <input type="button" class="btn btn-primary" name="btn_cadastra_espaco_cafe" id="btn_cadastra_espaco_cafe" value="Cadastrar">
                                </div>
                            </form>
                            <div class="error_msg_notification position-absolute text-danger" id="error_msg_notification" style="bottom: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim novo cadastro -->
            <div class="tabela">
                <table class="table table-striped" id="table_espaco_cafe">
                    <thead>
                        <tr>
                            <th scope="col">Cód</th>
                            <th scope="col">Nome espaço café</th>
                            <th scope="col">Lotação máx.</th>
                            <th scope="col">Data criação</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $arr_espaco_cafe = array();
                            $sql_espaco_cafe = "SELECT * FROM `espaco_cafe` WHERE 1";
                            $sql_espaco_cafe_query = mysqli_query($conn, $sql_espaco_cafe);

                            while($sql_espaco_cafe_assoc = mysqli_fetch_assoc($sql_espaco_cafe_query)){
                                array_push($arr_espaco_cafe,$sql_espaco_cafe_assoc['id_espaco_cafe']);
                                ?>
                                    <tr style="font-size:0.8769rem;">
                                        <th scope="row"><?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?></th>
                                        <td><?= $sql_espaco_cafe_assoc['nome_espaco_cafe'] ?></td>
                                        <td><?= $sql_espaco_cafe_assoc['lotacao_max_cafe'] ?></td>
                                        <td><?= date('d/m/Y',strtotime($sql_espaco_cafe_assoc['datecreate'])) ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <!-- Visualização -->
                                                <a type="button" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;" data-bs-toggle="modal" data-bs-target="#visualizacao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>"><i class='bx bx-zoom-in'></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="visualizacao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" tabindex="-1" aria-labelledby="visualizacao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="visualizacao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>Label">Edição <?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nome_espaco_cafe_edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" class="form-label">Nome do espaço de café</label>
                                                                            <input type="text" class="form-control" value="<?= $sql_espaco_cafe_assoc['nome_espaco_cafe'] ?>" disabled>
                                                                        </div>  
                                                                        <div class="col mb-3">
                                                                            <label for="lotacao_max_cafe_edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" class="form-label">Lotacao Máxima</label>
                                                                            <input type="number" class="form-control" value="<?= $sql_espaco_cafe_assoc['lotacao_max_cafe'] ?>" disabled>
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
                                                <a type="button" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;" data-bs-toggle="modal" data-bs-target="#edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>"><i class='bx bxs-edit'></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" tabindex="-1" aria-labelledby="edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>Label">Editar <?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="class/Class.edicao.espaco.cafe.php" method="post" id="form_espaco_cafe_edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>">
                                                                    <input type="hidden" name="id_espaco_cafe" value="<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nome_espaco_cafe_edicao" class="form-label">Nome sala de Eventos</label>
                                                                            <input type="text" class="form-control" name="nome_espaco_cafe_edicao" id="nome_espaco_cafe_edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" value="<?= $sql_espaco_cafe_assoc['nome_espaco_cafe'] ?>">
                                                                        </div> 
                                                                        <div class="col mb-3">
                                                                            <label for="lotacao_max_cafe_edicao" class="form-label">Lotação máxima</label>
                                                                            <input type="number" class="form-control" name="lotacao_max_cafe_edicao" id="lotacao_max_cafe_edicao<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" value="<?= $sql_espaco_cafe_assoc['lotacao_max_cafe'] ?>">
                                                                        </div>              
                                                                    </div>
                                                                
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                                        <input type="button" class="btn btn-primary" name="btn_editar_espaco_cafe" id="btn_editar_espaco_cafe<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" value="Cadastrar">
                                                                    </div>
                                                                </form>
                                                                <div class="error_msg_notification_edicao position-absolute text-danger" id="error_msg_notification_edicao" style="bottom: 10px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim edição -->

                                                <!-- Delete -->
                                                <a href="class/Class.delete.espaco.cafe.php?id_espaco_cafe=<?= $sql_espaco_cafe_assoc['id_espaco_cafe'] ?>" class="d-flex justify-content-center align-items-center bg-primary text-light rounded-circle me-2" style="width:31px;height:31px;text-decoration: none;"><i class='bx bx-message-alt-x'></i></a>

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
    <script type="text/javascript" src="assets/js/espaco_cafe.js"></script>
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
            var arr_espaco_cafe = ["<?php echo implode('","',$arr_espaco_cafe); ?>"];

            $.each(arr_espaco_cafe,function(index,value){

                $('#nome_espaco_cafe_edicao' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });

                $('#lotacao_max_cafe_edicao' + value).blur(function(){
                    if($(this).val() != ''){
                        $(this).removeClass('border border-danger');
                    }
                });

                $('#btn_editar_espaco_cafe' + value).click(function(){

                    var nome_espaco_cafe_edicao = $('#nome_espaco_cafe_edicao' + value).val();
                    var lotacao_max_cafe_edicao = $('#lotacao_max_cafe_edicao' + value).val();

                    if(nome_espaco_cafe_edicao == ''){

                        $('#nome_espaco_cafe_edicao' + value).addClass('border border-danger');
                        $('#nome_espaco_cafe_edicao' + value).focus();
                        
                        $('#error_msg_notification_edicao').append('<span">O campo nome precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                    }else if(lotacao_max_cafe_edicao == ''){

                        $('#lotacao_max_cafe_edicao' + value).addClass('border border-danger');
                        $('#lotacao_max_cafe_edicao' + value).focus();
                        
                        $('#error_msg_notification_edicao').append('<span">O campo nome precisa ser preenchido corretamente</span>');
                        setTimeout(() => {
                            $('#error_msg_notification_edicao').empty();
                        }, 3200);

                    }else{
                        $('#form_espaco_cafe_edicao' + value).submit();
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