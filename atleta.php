<?php
  $banco="olimpiadas_paris";  // nome do banco de dados
  $user = "root";    // nome do usuário
  $servidor = "127.0.0.1"; //endereço do servidor
  $senha = ""; //senha do usuário

  //incluir

  $op = $_GET['op'];
  if ($op ==1) { //INCLUSAO
    //SABER QUAL ENTRADA A SER EXECUTADA
      $entrada = $_GET['entrada'];
      // ENTRADA 1 EXIBIR O FORMULÁRIO
        if ($entrada == 1){
          echo "
            <form method='GET' action='atleta.php'>

              Código do Atleta: <input type='number' name='cod_atleta'> <br>

              NOME: <input type='text' name='nome' > <br>

              Delegação: <input type='text' name='delegacao' > <br>

              Categoria:
              <input type='radio' name='categoria' value='M'>masculino
              <input type='radio' name='categoria' value='F'>feminino<br>

              Data de nascimento <input type='date' name='nascimento'> <br>

              Modalidade: <input type='text' name='modalidade' > <br>

              Passaporte: <input type='number' name='passaporte' > <br>

              <input type='hidden' name='op' value='1'>
              <input type='hidden' name='entrada' value='2'>

              <input type='submit' name='botao' > 
              <input type='reset' name='botao' ><br>
              <a href=parisolimpiadas.php> VOLTAR </a>
            </form>  
          ";
        }
  //ENTRADA 2 INSERIR NO BANCO DE DADOS DO NOVO ALUNO
        if ($entrada == 2) {
          //ENTRANDO OS DADOS E ARMAZENAMENTO NAS VARIÁVES $mat, $nom
            $cod = $_GET['cod_atleta'];
            $nom = $_GET['nome'];
            $deleg = $_GET['delegacao'];
            $modal = $_GET['modalidade'];
            $nasc = $_GET['nascimento'];
            $sex = $_GET['categoria'];
            $pass = $_GET['passaporte'];
          // MONTANDO O SQL PARA A INSERÇÃO DOS DADOS NA TABELA ALUNO
            $sql = "insert into atletas values ('$nom', '$cod', '$deleg','$sex','$nasc', '$modal', '$pass' ) ";
          // ABRINDO CONEXÃO
            $conn = mysqli_connect("$servidor", "$user", "$senha", "$banco")
            or die ("problemas na conexão");
          //APLICANDO SQL NA CONEXÃO, STATUS RECEBE O RETORNO
            $status = mysqli_query($conn, $sql);
          // DE ACODO COM O STATUS EXIBIR O RETORNO DO USUÁRIO
            if($status==TRUE) {
              echo "Cadastro do atleta Feito Com Sucesso :)<br>";


            } else{
              echo "ERRO NO CADASTRO :o <br>";
            }

          echo "<br> <a href='parisolimpiadas.php'>VOLTAR</a>";
            } 
                

          } 
//listar
          if ($op == 2) {
            //MONTANDO SQL PARA SELECIONAR DADOS NA TABELA ALUNO
            $sql = "select * from atletas";
            //abrindo conexão
            $conn = mysqli_connect("$servidor", "$user", "$senha", "$banco")
                      or die ("problemas na conexão");
            // aplicando sql  na conexão, status recebe o retorno
            $dados = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($dados);
            echo "
            <center><h1>Listagem de atletas</h1><hr>
            <table border=3>
            <tr>
              <th>Nome</th>
              <th>Código do Atleta</td>
              <th>Delegação</th>
              <th>Categoria</th>
              <th>Data de nascimento</th>
              <th>Modalidade:</th>
              <th>Passaporte</th>
            </tr>
            ";
        
            //exibindo os dados
            $linha = mysqli_fetch_array($dados); //linha recebe a prmeira linha
            for($i=0; $i<$total; $i++){
              $cod = $linha['cod_atleta'];
              $nom = $linha['nome'];
              $deleg = $linha['delegacao'];
              $modal = $linha['modalidade'];
              $nasc = $linha['data_nascimento'];
              $sex = $linha['categoria'];
              $pass = $linha['passaporte'];
            
            echo "
            <tr>
            <td>$nom</td>
            <td>$cod</td>
            <td>$deleg</td>
            <td>$modal</td>
            <td>$nasc</td>
            <td>$sex</td>
            <td>$pass</td>
            </tr>
            ";
            $linha =  mysqli_fetch_assoc($dados); //linha recebe o próximo
            }
            echo "</table>";
        
            echo "<br> <a href='parisolimpiadas.php'>VOLTAR</a>";
            
        
          }

 //pesquisar
          
          if ($op ==3) {
            //SABER QUAL ENTRADA A SER EXECUTADA
            $entrada = $_GET['entrada'];
            // ENTRADA 1 EXIBIR O FORMULÁRIO
              if ($entrada == 1){
                echo "
                <h1>Pesquisa do atleta</h1><hr>
                  <form method='GET' action='atleta.php'>
                    Digite o código
                    Código do atleta:<input type='number' name='cod_atleta'> <br>
                    <input type='hidden' name='op' value='3'>
                    <input type='hidden' name='entrada' value='2'>
                    <input type='submit' name='botao' > 
                    <input type='reset' name='botao' ><br>
                    <a href=parisolimpiadas.php> VOLTAR </a>
                  </form>  
                ";
          }
        
          if ($entrada == 2){
        
                $cod = $_GET['cod_atleta'];
                //MONTANDO SQL PARA SELECIONAR DADOS NA TABELA ALUNO
                $sql = "select * from atletas where cod_atleta=$cod";
                //abrindo conexão
                $conn = mysqli_connect("$servidor", "$user", "$senha", "$banco")
                          or die ("problemas na conexão");
                // aplicando sql  na conexão, status recebe o retorno
                $dados = mysqli_query($conn, $sql);
                $total = mysqli_num_rows($dados);
        
        
        
                if($total==0){
                  echo"Não encontrou!!!";
                  echo"<a href=parisolimpiadas.php> VOLTAR </a>";
                  exit(0);
                }
                
        
        
                echo "
                <center><h1>Listagem de alunos</h1><hr>
                <table border=3>
             <tr>
              <th>Nome</th>
              <th>Código do Atleta</td>
              <th>Delegação</th>
              <th>Categoria</th>
              <th>Data de nascimento</th>
              <th>Modalidade:</th>
              <th>Passaporte</th>
             </tr>
                ";
        
                  //exibindo os dados
                  $linha = mysqli_fetch_array($dados); //linha recebe a prmeira linha
                  for($i=0; $i<$total; $i++){
                    $cod = $linha['cod_atleta'];
                    $nom = $linha['nome'];
                    $deleg = $linha['delegacao'];
                    $modal = $linha['modalidade'];
                    $nasc = $linha['data_nascimento'];
                    $sex = $linha['categoria'];
                    $pass = $linha['passaporte'];
                  
                  echo "
                  <tr>
                    <td>$cod</td>
                    <td>$nom</td>
                    <td>$deleg</td>
                    <td>$sex</td>
                    <td>$nasc</td>
                    <td>$modal</td>
                    <td>$pass</td>
                   </tr>
                  ";
                  $linha =  mysqli_fetch_assoc($dados); //linha recebe o próximo
                  
                  }
                  echo "</table>";
              
                  echo "<br> <a href='parisolimpiadas.php'>VOLTAR</a>";
           }
          
        
        }
        
          //excluir
          if ($op ==4) {
            //SABER QUAL ENTRADA A SER EXECUTADA
            $entrada = $_GET['entrada'];
            // ENTRADA 1 EXIBIR O FORMULÁRIO
              if ($entrada == 1){
                echo "
                <h1>Exclusão do atleta</h1><hr>
                  <form method='GET' action='atleta.php'>
                    Digite o código
                    :<input type='number' name='cod_atleta'> <br>
                    <input type='hidden' name='op' value='4'>
                    <input type='hidden' name='entrada' value='2'>
                    <input type='submit' name='botao' > 
                    <input type='reset' name='botao' ><br>
                    <a href=parisolimpiadas.php> VOLTAR </a>
                  </form>  
                ";
          }
          if ($entrada == 2){
            $cod = $_GET['cod_atleta'];
            //MONTANDO SQL PARA SELECIONAR DADOS NA TABELA ALUNO
            $sql = "select * from atletas where cod_atleta=$cod";
            //abrindo conexão
            $conn = mysqli_connect("$servidor", "$user", "$senha", "$banco")
                      or die ("problemas na conexão");
            // aplicando sql  na conexão, status recebe o retorno
            $dados = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($dados);
    
    
    
            if($total==0){
              echo"Não encontrou!!!";
              echo"<a href=parisolimpiadas.php> VOLTAR </a>";
              exit(0);
            }
            
    
    
            echo "
            <center><h1>Excluir atleta</h1><hr>
            <table border=3>
            <tr>
            <th>Nome</th>
            <th>Código do Atleta</td>
            <th>Delegação</th>
            <th>Categoria</th>
            <th>Data de nascimento</th>
            <th>Modalidade:</th>
            <th>Passaporte</th>
            </tr>
            ";
    
              //exibindo os dados
              $linha = mysqli_fetch_array($dados); //linha recebe a prmeira linha

                $cod = $linha['cod_atleta'];
                $nom = $linha['nome'];
                $deleg = $linha['delegacao'];
                $modal = $linha['modalidade'];
                $nasc = $linha['data_nascimento'];
                $sex = $linha['categoria'];
                $pass = $linha['passaporte'];
              
              echo "
              <tr>
              <td>$cod</td>
              <td>$nom</td>
              <td>$deleg</td>
              <td>$modal</td>
              <td>$nasc</td>
              <td>$sex</td>
              <td>$pass</td>
              </tr>
              ";

              

              echo "</table>";
              echo" <h3> Deseja confirmar?</h3>
              <form method='GET' action='atleta.php'>
              <input type='hidden' name='op' value='4'>
              <input type='hidden' name='cod_atleta' value='$cod' ><br>
              <input type='hidden' name='entrada' value='3'>
              <input type='submit' name='botao' >
              </form>
              ";
          
              echo "<br> <a href='parisolimpiadas.php'>VOLTAR</a>";
          }
          if ($entrada == 3){
          
                $cod = $_GET['cod_atleta'];
                //MONTANDO SQL PARA SELECIONAR DADOS NA TABELA ALUNO
                $sql = "delete  from atletas where cod_atleta=$cod";
          
                //abrindo conexão
                $conn = mysqli_connect("$servidor", "$user", "$senha", "$banco")
                          or die ("problemas na conexão");
          
                // aplicando sql  na conexão, status recebe o retorno
                $status = mysqli_query($conn, $sql);
               
          
          
          
                if($status==TRUE){
                  echo"Excluído com muito sucesso!!!";
                  echo"<a href=parisolimpiadas.php> VOLTAR </a>";
                  exit(0);
                } else{
                  echo 'Erro!';
                }
                
          
           }
          
          
          }
  //alterar
        if ($op ==5) {
    //saber qual entrada a ser executada
    $entrada = $_GET['entrada'];
    if ($entrada ==1) {
      echo "
      <h1> Pesquisa para alteração do atleta</h1>
      <hr>
      <form method='GET' action='atleta.php'>
        Código do atleta: <input type='number' name='cod_atleta'> <br>
        
        
        <input type='hidden' name='op' value='5'>
        <input type='hidden' name='entrada' value='2'>

        <input type='submit' name='botao' > 
        <input type='reset' name='botao' ><br>
        <a href=parisolimpiadas.php> VOLTAR </a>
      </form>  
    ";

    }
     
        if ($entrada == 2){

          $cod = $_GET['cod_atleta'];
          //MONTANDO SQL PARA SELECIONAR DADOS NA TABELA ALUNO
          $sql = "select * from atletas where cod_atleta=$cod";
          //abrindo conexão
          $conn = mysqli_connect("$servidor", "$user", "$senha", "$banco")
                    or die ("problemas na conexão");
          // aplicando sql  na conexão, status recebe o retorno
          $dados = mysqli_query($conn, $sql);
          $total = mysqli_num_rows($dados);
  
  
  
          if($total==0){
            echo"Não encontrou!!!";
            echo"<a href=parisolimpiadas.php> VOLTAR </a>";
            exit(0);
          }
          
  
  
  
            //exibindo os dados
            $linha = mysqli_fetch_array($dados); //linha recebe a prmeira linha
          
            $cod = $linha['cod_atleta'];
            $nom = $linha['nome'];
            $deleg = $linha['delegacao'];
            $modal = $linha['modalidade'];
            $nasc = $linha['data_nascimento'];
            $sex = $linha['categoria'];
            $pass = $linha['passaporte'];
            //exibindo formulário já preenchido
            echo "
            <form method='GET' action='atleta.php'>
            Código: <input type='number' name='cod_atleta' value='$cod'> <br>
            NOME: <input type='text' name='nome'value='$nom' > <br>
            Delegação <input type='date' name='delegacao' value='$deleg'> <br>
            Data de nascimento <input type='text' name='data_nascimento' value='$nasc'> <br>
            Modalidade: <input type='text' name='modalidade' value='$modal'> <br>
            Passaporte <input type='text' name='passaporte' value='$pass'> <br>
            Categoria:
              <input type='radio' name='categoria' value='M' ";
             
              if($sex=='M') echo " checked "; 
              
             echo" >masculino
              <input type='radio' name='categoria' value='F'";
              
              if($sex=='F') echo " checked ";   

             echo" 
              >feminino<br>

            <input type='hidden' name='op' value='5'>
            <input type='hidden' name='entrada' value='3'>

            <input type='submit' name='botao' > 
            <input type='reset' name='botao' ><br>
            <a href=parisolimpiadas.php> VOLTAR </a>
          </form>  
            ";
            $linha =  mysqli_fetch_assoc($dados); //linha recebe o próximo
            
            
            echo "</table>";
        
            
     }

      
      if ($entrada ==3){
            //RECEBENDO OS DADOS
            $cod = $_GET['cod_atleta'];
            $nom = $_GET['nome'];
            $deleg = $_GET['delegacao'];
            $modal = $_GET['modalidade'];
            $nasc = $_GET['data_nascimento'];
            $sex = $_GET['categoria'];
            $pass = $_GET['passaporte'];

            //MONTANDO O SQL
            $sql = "update atletas set nome='$nom', delegacao='$deleg', modalidade='$modal',
                    data_nascimento='$nasc', categoria='$sex' where cod_atleta='$cod'";
                
            // ABRINDO CONEXÃO
            $conn = mysqli_connect("$servidor","$user","$senha","$banco") 
                    or die ("problemas na conexao");				
                
            // APLICANDO O SQL NA CONEXÃO, STATUS RECEBE O RETORNO
            $status = mysqli_query($conn, $sql);

            // DE ACORDO COM O STATUS EXIBIR O RETORNO AO USUÁRIO
            if($status==TRUE) {
              echo "ALTERACAO FEITA COM SUCESSO<BR>";
            }  else  { 
              echo "ERRO NO ALTERACAO<BR>";
              }

            // EXIBIR O LINK DE VOLTAR
              echo "<br> <a href='parisolimpiadas.php'>VOLTAR</A>";

      }
  }
 
?>
 
