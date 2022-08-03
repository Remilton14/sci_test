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
            Espaço de café
        </div>
  
    </main>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
</body>
</html>
<?php
    }
?>