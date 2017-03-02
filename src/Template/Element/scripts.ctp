<?php

$controller = $this->request->params['controller'];
$action = $this->request->params['action'];

switch ($controller){
    case 'Companies':
        switch ($action){
            case 'edit':
                ?>
                <!-- plugin wysihtml5 -->
                <?= $this->Html->script("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") ?>

                <!-- plugin select2 -->
                <?= $this->Html->script("/plugins/select2/select2.full.min.js") ?>

                <!-- plugin inputmask -->
                <?= $this->Html->script("/plugins/input-mask/jquery.inputmask.js") ?>
                <?= $this->Html->script("/plugins/input-mask/jquery.inputmask.date.extensions.js") ?>


                <!-- GeoApi - Angular.js -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.17/angular.min.js"></script>
                <script type="text/javascript" src="https://rawgit.com/GeoAPI-es/geoapi.es-js/1.0.2/GeoAPI.js"></script>

                <?php echo $this->Html->script('main-geoapi'); ?>

                <?php echo $this->Html->script('fileinput'); ?>

                <?php echo $this->element('scripts/script_qcalles'); ?>

                <script>
                    //<!-- /Modal -->
                    //Events Modal Bootstrap
                    $('#myModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var modal = $(this)


                        switch (button.data('type')){
                            case 'address':
                                //Valor actual
                                var address = button.data('value');

                                //Ajustamos el tamaño de la ventana
                                modal.find('.modal-dialog').addClass('modal-lg');

                                //Title
                                modal.find('.modal-title').text('Localización');

                                //var html = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="<?= $this->Url->build(['controller' => 'maps', 'action' => 'vermapa', $company->id]); ?>/' + address +  '"></iframe></div>';

                                //Contenido modal-body
                                $.ajax({
                                    type: 'GET',
                                    url: "<?= $this->Url->build(['controller' => 'Addresses', 'action' => 'view','Companies'])?>/" + address,
                                    //data: { id: exercise },
                                    error:function(data){
                                    },
                                    success: function(data){
                                        //Cargamos data en el body de la ventana modal
                                        modal.find('.modal-body').html(data);
                                    }
                                });

                                //modal.find('.modal-body').html(html);

                                modal.find('.modal-footer').remove();
                                break;
                            case 'contact':
                                //Ajustamos el tamaño de la ventana
                                modal.find('.modal-dialog').addClass('modal-lg');

                                //Title
                                modal.find('.modal-title').text('Contactos');

                                //Contenido modal-body

                                var contact_id = button.data('value');
                                if (!contact_id){
                                    var url = "<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'add', $company->id, 'companies'])?>";
                                }else{
                                    var url = "<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'edit'])?>/" + contact_id;
                                }

                                $.ajax({
                                    type: 'GET',
                                    url: url,
                                    error:function(data){
                                    },
                                    success: function(data){
                                        //Cargamos data en el body de la ventana modal
                                        modal.find('.modal-body').html(data);
                                    }
                                });
                                modal.find('.modal-footer').remove();
                                break;
                        }


                    });
                    //<!-- /Modal -->


                    function addCommunication(){

                        var id = $('#communication_id').val();
                        var label = $("#communication_id option:selected").text();
                        var value = $('#communication_value').val();

                        //Validamos que el valor sea válido
                        var expreg = /^(6|7|9)[0-9]{8}$/ ;

                        if(expreg.test(value)){
                            //add to ul list
                            var indice = $('#ul_communications li').length + 1;

                            var html = '<li>'+
                                '<input type="hidden" name="communications[' + indice +  '][id]" value="' + id + '">'+
                                '<input type="hidden" name="communications[' + indice + '][_joinData][value]" value="' + value +'">'+
                                '<span class="text-muted">' + label + '</span>'+
                                '<span class="text">' + value + '</span>'+
                                '<div class="tools"><a href="javascript:void(0)" onclick="removeCommunication(this)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></div>'+
                                '</li>';

                            //Añadimos al listado de comunicaciones
                            $('#ul_communications').append(html);
                            $('#communication_value').val('');

                        }else{
                            alert('Teléfono no válido');
                        }
                    }

                    function removeCommunication(e){
                        //Eliminamos el elemento li de la lista ul
                        if($(e).parent().parent().is('[id]')) {
                            $(e).parent().parent().children('input.del').val(1);
                            $(e).parent().parent().hide();
                        } else {
                            $(e).parent().parent().remove();
                        }
                    }
                </script>

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
                    //<!-- /Bootstrapt-fileinput -->

                    //Select 2 to Tags
                    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                        if ($(this).text() == "Datos"){
                            $("#tags").select2({
                                tags: true
                            });
                        }

                    })

                    $(document).ready(function(){
                        //Añadimos a las imágenes la class img-responsive
                        $('.kv-file-content img').addClass('img-responsive');
                        //Bootstrapt-wysihtml5
                        $('#description').wysihtml5();

                        //Select 2 to Tags
                        $("#tags").select2({
                            tags: true
                        });

                        $('.hours').inputmask('h:s',{
                            placeholder : '00:00'
                        });
                    });

                </script>
                <?php
                break;

            case 'add':
                ?>
                <!-- plugin wysihtml5 -->
                <?= $this->Html->script("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") ?>
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
    case 'Locales':
        switch ($action){
            case 'add':
                ?>
                <!-- plugin wysihtml5 -->
                <?= $this->Html->script("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") ?>

                <!-- plugin select2 -->
                <?= $this->Html->script("/plugins/select2/select2.full.min.js") ?>
                <script>
                    $(document).ready(function(){
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
            case 'edit':
                ?>
                <!-- plugin wysihtml5 -->
                <?= $this->Html->script("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") ?>

                <!-- plugin select2 -->
                <?= $this->Html->script("/plugins/select2/select2.full.min.js") ?>

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
                        deleteUrl: '<?= $this->Url->build(['controller' => 'locales', 'action' => 'deleteimage']); ?>',
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
                        $(location).attr('href', '<?= $this->Url->build(); ?>?tab=media');
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
                                console.log(data);
                            },
                            success: function(data){
                                $(location).attr('href', '<?= $this->Url->build(); ?>?tab=media');
                            }
                        });
                    });

                    $('.btn-profile[data-key=' + profile_id + '] i').removeClass('glyphicon-user').addClass('glyphicon-ok');
                    //<!-- /Bootstrapt-fileinput -->


                    //<!-- /Modal -->
                    //Events Modal Bootstrap
                    $('#myModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var modal = $(this)


                        switch (button.data('type')){
                            case 'address':
                                //Valor actual
                                var address = button.data('value');

                                //Ajustamos el tamaño de la ventana
                                modal.find('.modal-dialog').addClass('modal-lg');

                                //Title
                                modal.find('.modal-title').text('Localización');

                                //Contenido modal-body
                                $.ajax({
                                    type: 'GET',
                                    url: "<?= $this->Url->build(['controller' => 'Addresses', 'action' => 'view','Locales'])?>/" + address,
                                    error:function(data){
                                    },
                                    success: function(data){
                                        //Cargamos data en el body de la ventana modal
                                        modal.find('.modal-body').html(data);
                                    }
                                });

                                //modal.find('.modal-body').html(html);

                                modal.find('.modal-footer').remove();
                                break;
                            case 'contact':
                                //Ajustamos el tamaño de la ventana
                                modal.find('.modal-dialog').addClass('modal-lg');

                                //Title
                                modal.find('.modal-title').text('Contactos');

                                //Contenido modal-body
                                var contact_id = button.data('value');
                                if (!contact_id){
                                    var url = "<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'add', $local->id,'locales'])?>";
                                }else{
                                    var url = "<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'edit'])?>/" + contact_id;
                                }

                                console.log(url);


                                $.ajax({
                                    type: 'GET',
                                    url: url,
                                    error:function(data){
                                    },
                                    success: function(data){
                                        //Cargamos data en el body de la ventana modal
                                        modal.find('.modal-body').html(data);
                                    }
                                });
                                modal.find('.modal-footer').remove();
                                break;
                        }


                    });
                    //<!-- /Modal -->


                    function addCommunication(){

                        var id = $('#communication_id').val();
                        var label = $("#communication_id option:selected").text();
                        var value = $('#communication_value').val();

                        //Validamos que el valor sea válido
                        var expreg = /^(6|7|9)[0-9]{8}$/ ;

                        if(expreg.test(value)){
                            //add to ul list
                            var indice = $('#ul_communications li').length + 1;

                            var html = '<li>'+
                                '<input type="hidden" name="communications[' + indice +  '][id]" value="' + id + '">'+
                                '<input type="hidden" name="communications[' + indice + '][_joinData][value]" value="' + value +'">'+
                                '<span class="text-muted">' + label + '</span>'+
                                '<span class="text">' + value + '</span>'+
                                '<div class="tools"><a href="javascript:void(0)" onclick="removeCommunication(this)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></div>'+
                                '</li>';

                            //Añadimos al listado de comunicaciones
                            $('#ul_communications').append(html);
                            $('#communication_value').val('');

                        }else{
                            alert('Teléfono no válido');
                        }
                    }

                    function removeCommunication(e){
                        //Eliminamos el elemento li de la lista ul
                        if($(e).parent().parent().is('[id]')) {
                            $(e).parent().parent().children('input.del').val(1);
                            $(e).parent().parent().hide();
                        } else {
                            $(e).parent().parent().remove();
                        }
                    }

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
        }
        break;
    case 'Maps':
        switch ($action){
            case 'view':
                    ?>
                    <script>
                        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        var labelIndex = 0;
                        //Obtenemos las direcciones de la empresa
                        var addresses = <?php echo json_encode($dir->addresses, JSON_FORCE_OBJECT); ?>;
                        var map;
                        function initMap() {
                            map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: 28.122060, lng: -16.733821},
                                zoom: 14
                            });

                            if (!$.isEmptyObject(addresses)){
                                $.each(addresses, function(i,item){
                                    if ((item.lat) && (item.lon)){
                                        var myLatLng = {lat: parseFloat(item.lat), lng: parseFloat(item.lon)};
                                        var marker = new google.maps.Marker({
                                            position: myLatLng,
                                            label: labels[labelIndex++ % labels.length],
                                            title: item.TVIA + ' ' + item.NVIAC + ' ' + item.number + ' ' + item.NNUCLE50 + ' ' + item.CPOS + ' ' + item.NENTSI50  + ' ' + item.DMUN50,
                                            map: map

                                        });
                                    }
                                });
                            }

                        }
                    </script>
                    <?php
                break;
            case 'vermapa':
                //Mostramos el código de la carga de mapas
                if($address->lat && $address->lon){
                    ?>
                    <script>
                    function initMap() {
                        var myLatLng = {lat: <?= $address->lat; ?>, lng: <?= $address->lon; ?>};

                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 16,
                            center: myLatLng
                        });

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map
                        });
                    }
                    </script>

                    <?php
                }else{
                    ?>
                    <script>
                    var map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: 28.122060, lng: -16.733821},
                        zoom: 14
                    });
                    }
                    </script>
                    <?
                }

                break;

            case 'geolocalizar':
                ?>
                <script>
                    // Note: This example requires that you consent to location sharing when
                    // prompted by your browser. If you see the error "The Geolocation service
                    // failed.", it means you probably did not give permission for the browser to
                    // locate you.

                    <? if($address->lat && $address->lon){ ?>
                        document.getElementById("lat").value = <?= $address->lat ?>;
                        document.getElementById("lon").value = <?= $address->lon ?>;
                    <? } else { ?>
                        document.getElementById("lat").value = '28.117087';
                        document.getElementById("lon").value = '-16.738014';
                    <? } ?>

                    function initMap() {
                        var map = new google.maps.Map(document.getElementById('map'), {
                            <? if($address->lat && $address->lon){ ?>
                                center: {lat:<?= $address->lat ?>, lng: <?= $address->lon ?>},
                            <? }else{ ?>
                                center: {lat: 28.117087, lng: -16.738014},
                            <? } ?>
                            zoom: 18
                        });

                        <? if($address->lat && $address->lon){ ?>

                        <? }else{ ?>

                            var infoWindow = new google.maps.InfoWindow({map: map});

                            // Try HTML5 geolocation.
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };

                                    infoWindow.setPosition(pos);
                                    infoWindow.setContent('Geolocaliz. correcta.');
                                    map.setCenter(pos);
                                    document.getElementById("lat").value = pos.lat;
                                    document.getElementById("lon").value = pos.lng;
                                }, function() {
                                    handleLocationError(true, infoWindow, map.getCenter());
                                });
                            } else {
                                // Browser doesn't support Geolocation
                                handleLocationError(false, infoWindow, map.getCenter());
                            }

                        <? } ?>

                        map.addListener('drag', function() {
                            var pos = map.getCenter();
                            document.getElementById("lat").value = pos.lat();
                            document.getElementById("lon").value = pos.lng();
                        });

                        map.addListener('dragend', function() {
                            var pos = map.getCenter();
                            document.getElementById("lat").value = pos.lat();
                            document.getElementById("lon").value = pos.lng();
                        });

                    }

                    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                        infoWindow.setPosition(pos);
                        infoWindow.setContent(browserHasGeolocation ?
                            'Error: La geolocalizac. no funciona.' :
                            'Error: Este navegador no soporta geolocalizac.');
                    }
                </script>
                <?php
                break;
        }
        break;
}
?>