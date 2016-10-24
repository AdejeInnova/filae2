<?php

$controller = $this->request->params['controller'];
$action = $this->request->params['action'];


switch ($controller){
    case 'Companies':
        switch ($action){
            case 'edit':
            case 'add':
                ?>
                <!-- plugin wysihtml5 -->
                <script src="/filae2/admin_l_t_e/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
                <script>
                    $(document).ready(function(){
                        $('#description').wysihtml5();
                    })
                </script>
                <?php
                break;
        }
        break;
}
?>