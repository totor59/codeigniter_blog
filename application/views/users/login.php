<?php echo form_open('Admin/index'); ?>
// login_view
<p>
  <?php echo form_label('Identifiant: ', 'login'); ?>
  <?php echo form_input('user_name', set_value('user_name'), 'class="form-control" id="login" autofocus'); ?>
</p>
<p>
  <?php echo form_label('Mot de passe:', 'password'); ?>
  <?php echo form_password('user_password', '', 'class="form-control" id="password"'); ?>
</p>
<p class="pull-right">
  <?php echo form_submit('send', 'Envoyer', 'class="btn btn-default"'); ?>
</p>
<p>
  <?php echo form_close(); ?>
  <?php echo validation_errors(); ?>
</p>
