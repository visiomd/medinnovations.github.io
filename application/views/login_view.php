<?php if(!isset($username)): ?> 
    <?php $this->load->view('login_not_logged_in'); ?>
<?php elseif(isset($username)): ?>
    <?php $this->load->view('login_logged_in'); ?>
<?php endif; ?> 
<div style="display:none;color:red" id="capsIndicator">Нажат CapsLock</div>
