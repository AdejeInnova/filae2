<?php

$controller = $this->request->params['controller'];
$action = $this->request->params['action'];

switch ($controller){
    case 'Companies':
        switch ($action){
            case 'edit':
                ?>
                <!-- plugin wysihtml5 -->
                <script src="/filae2/admin_l_t_e/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

                <!-- plugin select2 -->
                <script src="/filae2/admin_l_t_e/plugins/select2/select2.full.min.js"></script>

                <!-- GeoApi - Angular.js -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.17/angular.min.js"></script>
                <script type="text/javascript" src="https://rawgit.com/GeoAPI-es/geoapi.es-js/1.0.2/GeoAPI.js"></script>
                <?php echo $this->Html->script('main-geoapi'); ?>

                <?php echo $this->Html->script('fileinput'); ?>

                <?php echo $this->element('scripts/script_qcalles'); ?>

                <script>
                    var images = <?php echo json_encode($images); ?>;
                    var profile_id = <?php echo $profile_id;?>

                    //Bootstrapt-fileinput
                    $("#images").fileinput({
                        uploadUrl: '<?= $this->Url->build(); ?>', // you must set a valid URL here else you will get an error
                        initialPreview: images,
                        initialPreviewAsData: true,
                        initialPreviewConfig: <?php echo json_encode($captions); ?>,
                        allowedFileExtensions : ['jpg', 'png','gif'],
                        //overwriteInitial: true,
                        maxFileSize: 1000,
                        maxFilesNum: 10,
                        deleteUrl: '<?= $this->Url->build(['controller' => 'companies', 'action' => 'deleteimage']); ?>',
                        slugCallback: function(filename) {
                            return filename.replace('(', '_').replace(']', '_');
                        },
                        showCaption: false,
                        showRemove: false,
                        layoutTemplates: {
                            preview: '<div class="file-preview {class}">\n' +
                            '    <div class="{dropClass}">\n' +
                            '    <div class="file-preview-thumbnails">\n' +
                            '    </div>\n' +
                            '    <div class="clearfix"></div>' +
                            '    <div class="file-preview-status text-center text-success"></div>\n' +
                            '    <div class="kv-fileinput-error"></div>\n' +
                            '    </div>\n' +
                            '</div>',
                            actions: '<div class="file-actions">\n' +
                            '    <div class="file-footer-buttons">\n' +
                            '       {delete} {zoom} {other}' +
                            '    </div>\n' +
                            '    <div class="file-upload-indicator" title="{indicatorTitle}">{indicator}</div>\n' +
                            '    <div class="clearfix"></div>\n' +
                            '</div>'
                        },
                        otherActionButtons:  '<button type="button" class="btn btn-xs btn-default btn-profile" {dataKey}><i class="glyphicon glyphicon-user"></i></button>'
                    }).on('filebatchuploadcomplete', function(event, files, extra) {
                        $(location).attr('href', '<?= $this->Url->build(); ?>');
                    });

                    $(".btn-profile").on("click", function() {
                        var key = $(this).data('key');
                        $('#key_profile').attr('value',key);

                        $.ajax({
                            type: 'POST',
                            url: '<?= $this->Url->build();?>',
                            data: {
                                images: {
                                    0: {
                                        id: key,
                                        profile: '1'
                                    }
                                }
                            },
                            error: function(data){
                                alert(data);
                            },
                            success: function(data){
                                $(location).attr('href', '<?= $this->Url->build(); ?>');
                            }
                        });
                    });

                    $('.btn-profile[data-key=' + profile_id + '] i').removeClass('glyphicon-user').addClass('glyphicon-ok');


                    $(document).ready(function(){
                        //Añadimos a las imágenes la class img-responsive
                        $('.kv-file-content img').addClass('img-responsive');
                        //Bootstrapt-wysihtml5
                        $('#description').wysihtml5();

                        //Select 2 to Tags
                        $("#tags").select2({
                            tags: true
                        });
                    });

                </script>
                <?php
                break;

            case 'add':
                ?>
                <!-- plugin wysihtml5 -->
                <script src="/filae2/admin_l_t_e/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
                <script>
                    $(document).ready(function(){
                        //Bootstrapt-wysihtml5
                        $('#description').wysihtml5();
                    });
                </script>
                <?php
                break;
        }
        break;
}
?>