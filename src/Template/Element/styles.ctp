<?php

$controller = $this->request->params['controller'];
$action = $this->request->params['action'];


switch ($controller){
    case 'Companies':
        switch ($action){
            case 'edit':
            case 'add':
            ?>
            <link rel="stylesheet" href="/filae2/admin_l_t_e/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>
            <?php
                break;
        }
        break;
}
?>