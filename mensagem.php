<?php
//session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once './conexao.php';
//Load Composer's autoloader
require './lib/vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<?php
include_once './head.php';
?>

<body>
    <?php
    include_once './nav.php';
    ?>

    <div class="form_title">
        <div class="form_border">
            <h3>Mensagem</h3>
            <br>

            <?php

            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            // echo "<pre>", var_dump($data), "</pre>";

            if(!empty($data['SendAddMsg'])){

            
            
                $query_msg = "INSERT INTO contact_msgs (name, email, subject, content, created) VALUES (:name, :email, :subject, :content, NOW())";
                $add_msg = $conn->prepare($query_msg);

                $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
                $add_msg->bindParam(':email', $data['email'], PDO::PARAM_STR);
                $add_msg->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
                $add_msg->bindParam(':content', $data['content'], PDO::PARAM_STR);

                $add_msg->execute();

                if ($add_msg->rowCount()) {

                    $mail = new PHPMailer(true);
                    try {
                        $mail->CharSet = 'UTF-8';  //A mensagem tera caracteres especiais
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'admin';                     //SMTP username
                        $mail->Password   = '**********';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                        
                        //Recipients
                        $mail->setFrom('atendimento@crudphp.com.br', 'Atendimento');
                        $mail->addAddress($data['email'], $data['name']);     //Add a recipient

                        //Enviar e-mail para o cliente
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = $data['subject'];
                        $mail->Body = "Nome " . $data['name'] . "<br>E-mail: " . $data['email'] . "<br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                        $mail->AltBody = "Nome " . $data['name'] . "\nE-mail: " . $data['email'] . "\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];

                        $mail->send();
                        $mail->clearAddresses();

                        //Enviar e-mail para o colaborador da empresa
                        $mail->setFrom('atendimento@crudphp.com.br', 'Atendimento');
                        $mail->addAddress('wagner.lorddf@gmail.com', 'Wagner');     //Add a recipient

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Recebi a mensagem de contato';
                        $mail->Body = "Prezado(a) " . $data['name'] . "<br><br>Recebi o seu e-mail.<br>Será lido o mais rápido possível.<br>Em breve será respondido.<br><br>Assunto: " . $data['subject'] .
                            "<br>Conteúdo: " . $data['content'];
                        $mail->AltBody = "Prezado(a) " . $data['name'] . "\n\nRecebi o seu e-mail.\nSerá lido o mais rápido possível.\nEm breve será respondido.\n\nAssunto: " . $data['subject'] .
                            "\nConteúdo: " . $data['content'];

                        $mail->send();
                        unset($data);
                        echo "<p style='color: green;'>Mensagem de contato enviada com sucesso!</p>";

                    } catch (Exception $e) {
                        echo "<p style='color: #f00;'>Erro: Mensagem de contato não pode ser enviada!</p>";
                    }
                    
                } else {
                    
                    echo "<p style='color: #f00;'>Erro: Mensagem de contato não pode ser enviada!</p>";
                }
                
            }

            ?>



            <form name="add_msg" action="" method="POST">

                <div class="form-group row col-md-5 mb-3">
                    <label for="inputNome" class="col-sm-2 col-form-label">Nome: </label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nome completo" value="<?php if(isset($data['name'])){echo $data['name'];} ?>" required autofocus>
                    </div>
                </div>

                <div class="form-group row col-md-5 mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">E-mail: </label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" placeholder="O melhor e-mail" value="<?php if(isset($data['email'])){echo $data['email'];} ?>" required>
                    </div>
                </div>

                <div class="form-group row col-md-5 mb-3">
                    <label for="inputAssunto" class="col-sm-2 col-form-label">Assunto: </label>
                    <div class="col-sm-10">
                        <input type="text" name="subject" class="form-control" id="subject" placeholder="Assunto da mensagem" value="<?php if(isset($data['subject'])){echo $data['subject'];} ?>" required>
                    </div>
                </div>

                <div class="form-group row col-md-5 mb-3">
                    <label for="inputConteudo" class="col-sm-2 col-form-label">Conteúdo: </label>
                    <div class="col-sm-10">
                        <input type="text" name="content" class="form-control" id="content" placeholder="Conteudo da mensagem" value="<?php if(isset($data['content'])){echo $data['content'];} ?>" required>
                    </div>
                </div>

                <div class="form-group row col-md-5 mb-3">
                    <input type="submit" value="Enviar" name="SendAddMsg" class="btn btn-primary">
                </div>


            </form>

        </div>
    </div>
    <br>
    <?php
    include_once './footer.php';
    ?>

</body>

</html>