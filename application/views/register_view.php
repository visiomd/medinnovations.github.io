<?php 
if (!isset($username)): 
    $this->load->view($not_logged_in);
elseif(isset($username)): 
    $this->load->view($already_logged_in); 
endif; 
?>	