<?php
session_start();

if (!isset($_SESSION['tasks'])){
    $_SESSION['tasks'] = array();
}

if (isset($_GET['clear'])){
    unset($_SESSION['tasks']);
    unset($_GET['clear']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas com PHP</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght?@400;500;700&display=swap">
    
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Gerenciador de Tarefas</h1>
        </div>

        <div class="form">
            <form action="task.php" method="post">
                <input type="hidden" name="insert" value="insert">
                <label for="task_name">Tarefa</label>

                <input type="text" name="task_name" placeholder="Nome da Tarefa">
                <label for="task_description">Descrição:</label>

                <input type="text" name="task_description" placeholder="Descrição da Tarefa">
                <label for="task_date">Data</label>

                <input type="date" name="task_date">
                <button type="submit">Cadastrar</button>
            </form>
            
            <?php
                if (isset($_SESSION['message'])) {
                    echo "<p style='color: #ef5350'>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
            ?>

        <div class="separator">

        </div>

        <div class="list-tasks">
            <?php
                if (isset($_SESSION['tasks'])){
                    echo "<ul>";

                    foreach($_SESSION['tasks'] as $key => $task){
                        echo "<li>
                            <span>  " . $task['task_name'] . " </span>
                            <button type='button' class='btn-clear' onclick='deletar$key()'>Remover</button>
                            <script>
                                function deletar$key() {
                                    if (confirm('Confirmar remoção')){
                                        window.location = 'http://localhost/tasklist-php/task.php?key=$key';
                                    }
                                    return false;
                                }   

                            </script>
                            
                            </li>";
                    }                    

                    echo "</ul>";
                }
            ?>    
        </div>
        <div class="limpar">
            <form action="" method="get">
                <input type="hidden" name="clear" value="clear">
                <button type="submit" class="btn-clear">Limpar</button>
            </form>
        </div>


        <div class="footer">
            <p>Desenvolvido por FRNaves através do curso <a href="https://www.youtube.com/watch?v=dJ49I-QYYUk"><strong>Gerenciador de Tarefas - Monolito PHP</strong></a></p>
        </div>

    </div>

    
</body>
</html>