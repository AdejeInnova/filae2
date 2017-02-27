<?php

$controller = $this->request->params['controller'];
$action = $this->request->params['action'];


switch ($controller) {
    case 'Companies':
        switch ($action) {
            case 'edit':
            case 'add':
                ?>
                <!-- plugin wysihtml5 -->
                <?php echo $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>

                <!-- plugin select2 -->
                <?php echo $this->Html->css('/plugins/select2/select2.css'); ?>

                <!-- Bootstrap 3.3.5 -->
                <?php echo $this->Html->css('fileinput'); ?>
                <?php
                break;
        }
        break;
    case 'Locales':
        switch ($action){
            case 'add':
            case 'edit':
            ?>
                <!-- plugin wysihtml5 -->
                <?php echo $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>

                <!-- plugin select2 -->
                <?php echo $this->Html->css('/plugins/select2/select2.css'); ?>

            <?php
            break;
        }
        break;
}
?>





