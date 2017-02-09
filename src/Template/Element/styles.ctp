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
                <link rel="stylesheet" href="/filae2/admin_l_t_e/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>

                <!-- plugin select2 -->
                <link rel="stylesheet" href="/filae2/admin_l_t_e/plugins/select2/select2.min.css"/>

                <!-- Bootstrap 3.3.5 -->
                <?php echo $this->Html->css('fileinput'); ?>

                <style>
                    #map {
                        width:400px;
                        height:400px;
                    }
                </style>

                <?php
                break;
        }
        break;
}
?>





