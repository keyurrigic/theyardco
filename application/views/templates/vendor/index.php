<?php $this->load->view('templates/vendor/header'); ?>
<div class="wrapper">
    <?php $this->load->view('templates/vendor/sidebar'); ?>
    <?php 
        if(!empty($error)) {
            echo $error;
        }
        if(!empty($success)){
            echo $success;
        }
    ?>
    <?php $this->load->view($main_content); ?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('templates/vendor/header'); ?>