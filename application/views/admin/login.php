<?php
echo form_open('verifylogin');
     echo form_label('Login','username');
     echo form_input('username');

     echo form_label('Mot de passe','password');
     echo form_password('password');

     echo form_submit('submit','Connexion');
echo form_close();
echo validation_errors();
echo @$error_credentials;
?>
