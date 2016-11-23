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

                <?php echo $this->Html->script('fileinput'); ?>

                <script>
                    var images = <?php echo json_encode($images); ?>;

                    //Bootstrapt-fileinput
                    $("#images").fileinput({
                        uploadUrl: '<?= $this->Url->build(); ?>', // you must set a valid URL here else you will get an error
                        initialPreview: images,
                        initialPreviewAsData: true,
                        initialPreviewConfig: <?php echo json_encode($captions); ?>,
                        /*initialPreviewConfig: [
                            {caption: "Moon.jpg", size: 930321, width: "120px", key: 1, showDelete: false},
                            {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2, showZoom: false}
                        ],*/
                        allowedFileExtensions : ['jpg', 'png','gif'],
                        //overwriteInitial: true,
                        maxFileSize: 1000,
                        maxFilesNum: 10,
                        //deleteUrl: '<?= $this->Url->build(['controller' => 'companies', 'action' => 'deleteimage']); ?>',
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
                            '       {upload} {delete} {zoom} {other}' +
                            '    </div>\n' +
                            '    <div class="file-upload-indicator" title="{indicatorTitle}">{indicator}</div>\n' +
                            '    <div class="clearfix"></div>\n' +
                            '</div>'
                        },
                        otherActionButtons:  '<button type="button" class="btn btn-xs btn-default btn-edit" {dataKey}><i class="glyphicon glyphicon-user"></i></button>'


                    }).on('fileuploaded', function(event, data, previewId, index) {
                        var form = data.form, files = data.files, extra = data.extra,
                            response = data.response, reader = data.reader;
                            console.log(response);
                            //$(location).attr('href', '<= $this->Url->build(); ?>')
                    });


                    $(".btn-edit").on("click", function() {
                        var key = $(this).data('key');
                        $('#key_profile').attr('value',key);
                        
                        console.log(id);
                        alert(id);

                        /*
                        $.ajax({

                            type: 'POST',
                            url: '<?= $this->Url->build(['action' => 'profile']);?>',
                            data: {
                                images: {
                                    id:key,
                                    profile:true
                                }
                            }
                        })*/

                        // you can use the key in your ajax actions or using data-key
                        // trace back to the preview container DOM and its children
                    });



                    $(document).ready(function(){
                        //Añadimos a las imágenes la class img-responsive
                        $('.kv-file-content img').addClass('img-responsive');
                        //Bootstrapt-wysihtml5
                        //$('#description').wysihtml5();

                    });

                </script>
                <?php
                break;
        }
        break;
}
?>