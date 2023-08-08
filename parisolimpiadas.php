<html>
    <head>
        <title> Olimpíadas Paris  </title>
    </head>
    <body>
        <h1><center>Olimpíadas de Paris</center></h1>
         <hr>
        <h2> cadastro atleta</h2>
        <form method='GET' action='atleta.php'>
            <input type='radio' name='op' value='1'> INCLUIR <br>
            <input type='radio' name='op' value='2'> LISTAR <br>
            <input type='radio' name='op' value='3'> PESQUISAR <br>
            <input type='radio' name='op' value='4'> EXCLUIR<br>
            <input type='radio' name='op' value='5'> ALTERAR<br>
            <input type='hidden' name='entrada' value='1'>
            <input type='submit' name='botao' > 
            <input type='reset' name='botao' >
        </form>


    </body>
</html>