<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Company') ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link(
                '<i class="fa fa-dashboard"></i> Home',
                [
                    'controller' => 'pages',
                    'action' => 'display',
                    'home'
                ],
                [
                    'escape' => false
                ]
            ); ?>
        </li>
        <li>
            <?= $this->Html->link(
                __('Companies'),
                [
                    'controller' => 'companies',
                    'action' => 'index'
                ]
            ); ?>
        </li>
        <li class="active"><?= __('Edit') ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content" ng-app="app" ng-controller="myCtrl">

    <!-- Modal -->
    <div class="modal fade" id="ModalCalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>

                <div class="modal-body">

                    <div class="list-group">
                        <a href="javascript:void(0)" class="list-group-item" ng-repeat="c in res_qcalles | filter:criteriaMatch()" ng-click="selCalle(c)" data-dismiss="modal">
                            <strong>Población:</strong> {{ c.NENTSI50 }} - <strong>Nucleo:</strong> {{ c.NNUCLE50 }} - {{ c.CPOS }} - {{ c.TVIA }} - {{ c.NVIAC }}
                        </a>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Contenido de myModal
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">

                    <?php
                        $profile = false;
                        foreach ($company->images as $image){
                            if ($image->profile){
                                $profile = true;
                                echo $this->Html->image(
                                    '/files/images/photo/' . $image->get('photo_dir') . '/square_' . $image->get('photo'),
                                    [
                                        'class' => ['profile-user-img', 'img-responsive', 'img-circle']
                                    ]
                                );
                            }
                        }

                        if (!$profile){
                            echo $this->Html->image(
                                'no_img_profile.png',
                                [
                                    'class' => ['profile-user-img', 'img-responsive', 'img-circle']
                                ]
                            );
                        }
                    ?>
                    <h3 class="profile-username text-center"><?= $company->tradename ?></h3>
                    <p class="text-muted text-center"><?= $company->name ?></p>
                    <p class="text-muted text-center"><?= $company->identity_card ?></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('About') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Redes Sociales</strong>

                    <?php
                    foreach ($company->networks as $network) {
                        echo '<p class="no-margin">';
                        echo '<i class="fa ' . $network->class . '"></i> ';
                        echo '<span class="text">';
                            echo $this->Html->Link(
                                strlen($network->_joinData->url)>25?'...'.substr($network->_joinData->url,-25):$network->_joinData->url,
                                $network->_joinData->url
                            );
                        echo '</span>';
                        echo '</p>';
                    }
                    ?>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> <?= __('Location') ?></strong>

                    <?php
                        foreach ($company->addresses as $address){
                            if ($address->principal){
                                echo '<p class="text-muted">' .
                                    h($address->TVIA) . ' ' .
                                    h($address->NVIAC) . ' ' .
                                    h($address->number) . ' ' .
                                    h($address->NNUCLE50) . ', ' .
                                    h($address->CPOS) . ' - ' .
                                    h($address->NENTSI50)  . '  ' .
                                    h($address->DMUN50) .
                                    '</p>';
                            }
                        }
                    ?>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Actividades</strong>
                    <p>
                    <?php
                        foreach ($company->tags as $tag){
                            ?>
                            <span class="label label-info"><?= $tag->label ?></span>
                            <?php
                        }
                    ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> <?= __('Observaciones Internas')?></strong>

                    <p><?= $company->description ?></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="<?= $tab == 'settings'?'active':''; ?>"><a href="#settings" data-toggle="tab">Datos</a></li>
                    <li class="<?= $tab == 'media'?'active':''; ?>"><a href="#media" data-toggle="tab">Media</a></li>
                    <li class="<?= $tab == 'networks'?'active':''; ?>"><a href="#networks" data-toggle="tab"><?=__('Networks')?></a></li>
                    <li class="<?= $tab == 'communications'?'active':''; ?>"><a href="#communications" data-toggle="tab"><?=__('Comunicaciones')?></a></li>
                    <li class="<?= $tab == 'cnae'?'active':''; ?>"><a href="#cnae" data-toggle="tab"><?=__('Cnae')?></a></li>
                    <li class="<?= $tab == 'addresses'?'active':''; ?>"><a href="#addresses" data-toggle="tab"><?=__('Direcciones')?></a></li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?= $tab == 'settings'?'active':''; ?>" id="settings">
                        <strong><i class="fa fa-book margin-r-5"></i> Datos de Empresa</strong>
                        <p class="text-muted">
                            Datos de identificación de la empresa
                        </p>

                        <hr>

                        <?php
                        $this->Form->templates([
                            'inputContainer' => '<div class="form-group"><label class="col-sm-2 control-label">{{label}}</label><div class="col-sm-10">{{content}}</div></div>'
                        ]);

                        echo $this->Form->create($company,
                            [
                                'url' => [
                                    'action' => 'edit',
                                    'tab' => 'settings'
                                ],
                                'role' => 'form',
                                'class' => 'form-horizontal',
                                'novalidate' => true
                            ]
                        );
                            echo $this->Form->input('tradename');
                            echo $this->Form->input('name', ['label' => __('Razón Social')]);
                            echo $this->Form->input('idcard_id', ['options' => $idcards]);
                            echo $this->Form->input('identity_card');
                            echo $this->Form->input('description',['label' => __('Observaciones Internas')]);
                            echo $this->Form->input('superficie_id', [
                                'options' => $superficies,
                                'empty' => true,
                                'label' => __('Superficie de Venta')
                            ]);
                            echo $this->Form->input('company_id', [
                                'options' => $companies,
                                'empty' => true,
                                'label' => __('Parent Company')
                            ]);

                            //Obtenemos las tags seleccionadas.
                            $tags_select = [];
                            foreach ($company->tags as $tag){
                                array_push($tags_select, $tag->label);
                            }

                            echo $this->Form->input('tags',[
                                'options' => $tags,
                                'label' => 'Tags Actividad',
                                'class' => 'select2',
                                'multiple' => true,
                                'value' => $tags_select
                            ]);

                            ?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <?= $this->Form->button(__('Save')) ?>
                            </div>
                        </div>

                        <?= $this->Form->end() ?>

                        <h5>
                            <strong><i class="fa fa-book margin-r-5"></i> Horario Comercial</strong>
                        </h5>
                        <p class="text-muted">
                            Editar horario comercial. Elige el horario de apertura de la empresa.
                        </p>

                        <hr/>
                        <?
                        echo $this->Form->create($company,
                            [
                                'url' => [
                                    'action' => 'edit',
                                    'tab' => 'communications'
                                ],
                                'role' => 'form',
                                'class' => 'form-horizontal',
                                'novalidate' => true
                            ]
                        );

                        echo '<div class="col-md12 box">';

                        echo '<div class="btn-group" data-toggle="buttons">';
                            echo '<label class="btn btn-primary">';
                                echo 'Lun.';
                                echo $this->Form->checkbox('timetables[0].day1',[
                                    'autocomplete' => 'off'
                                ]);
                            echo '</label>';
                        echo '</div>';

                        echo '<div class="btn-group" data-toggle="buttons">';
                        echo '<label class="btn btn-primary">';
                        echo 'Lun.';
                        echo $this->Form->checkbox('timetables[0].day1',[
                            'autocomplete' => 'off'
                        ]);
                        echo '</label>';
                        echo '</div>';

                        echo '<div class="btn-group" data-toggle="buttons">';
                        echo '<label class="btn btn-primary">';
                        echo 'Mar.';
                        echo $this->Form->checkbox('timetables[0].day2',[
                            'autocomplete' => 'off'
                        ]);
                        echo '</label>';
                        echo '</div>';

                        echo '<div class="btn-group" data-toggle="buttons">';
                        echo '<label class="btn btn-primary">';
                        echo 'Mier.';
                        echo $this->Form->checkbox('timetables[0].day3',[
                            'autocomplete' => 'off'
                        ]);
                        echo '</label>';
                        echo '</div>';

                        echo '<div class="btn-group" data-toggle="buttons">';
                        echo '<label class="btn btn-primary">';
                        echo 'Jue.';
                        echo $this->Form->checkbox('timetables[0].day4',[
                            'autocomplete' => 'off'
                        ]);
                        echo '</label>';
                        echo '</div>';

                        echo '<div class="btn-group" data-toggle="buttons">';
                        echo '<label class="btn btn-primary">';
                        echo 'Vie.';
                        echo $this->Form->checkbox('timetables[0].day5',[
                            'autocomplete' => 'off'
                        ]);
                        echo '</label>';
                        echo '</div>';

                        echo '<div class="btn-group" data-toggle="buttons">';
                        echo '<label class="btn btn-primary">';
                        echo 'Sab.';
                        echo $this->Form->checkbox('timetables[0].day6',[
                            'autocomplete' => 'off'
                        ]);
                        echo '</label>';
                        echo '</div>';

                        echo '<div class="btn-group" data-toggle="buttons">';
                        echo '<label class="btn btn-primary">';
                        echo 'Dom.';
                        echo $this->Form->checkbox('timetables[0].day7',[
                            'autocomplete' => 'off'
                        ]);
                        echo '</label>';
                        echo '</div>';

                        echo '</div>';

                        /*echo $this->Form->input('timetables[0].days',[
                                'label' => 'Días',
                                'type' => 'text',
                                'value' => '-------'
                            ]);

                        echo $this->Form->input('timetables[0].24hours',[
                            'label' => '24 Horas',
                            'type' => 'checkbox'
                        ]);*/


                        echo $this->Form->button('Save');



                        echo $this->Form->end();
                        ?>


                        <ul >
                        <?php
                            //Mostramos el listado de horarios comerciales
                            foreach ($company->timetables as $timetable) {
                                echo '<li>' . $timetable->days . '</li>';
                            }

                        ?>
                        </ul>

                        <hr>

                        <!-- Mostramos la sección para introducir el horario de la empresa de atención al público. -->


                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane <?= $tab == 'media'?'active':''; ?>" id="media">
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Archivos Multimedia</strong>
                            <p class="text-muted">
                                Galería de Imágines de la empresa
                            </p>
                            <hr>
                            <?= $this->Form->create(null,['type' => 'file']);?>
                            <?= $this->Form->input('key_profile',
                                [
                                    'type' => 'hidden',
                                    'id' => 'key_profile'
                                ]) ?>
                            <div class="form-group">
                                <input id="images" type="file" multiple class="file" data-overwrite-initial="false">
                            </div>
                            <?= $this->Form->end();?>
                        </div>


                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane <?= $tab == 'networks'?'active':''; ?>" id="networks">
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Redes Sociales</strong>
                            <p class="text-muted">
                                Crear las diferentes redes sociales que tiene la empresa.
                            </p>
                            <hr>
                            <?php
                            echo $this->Form->create($company,
                                [
                                    'url' => [
                                        'action' => 'edit',
                                        'tab' => 'networks'
                                    ],
                                    'role' => 'form',
                                    'class' => 'form-horizontal',
                                    'novalidate' => true
                                ]
                            );

                            echo $this->Form->input('companies_networks.0.network_id', [
                                'label' => 'Red Social',
                                'type' => 'select',
                                'options' => $networks
                            ]);
                            echo $this->Form->input('companies_networks.0.url');

                            ?>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?= $this->Form->button(__('Save')) ?>
                                </div>
                            </div>
                            <?php
                                echo  $this->Form->end();
                            ?>
                        </div>
                        <hr>
                        <ul class="todo-list">
                            <?php
                            foreach ($company->networks as $network) {
                                echo '<li>';
                                    echo '<i class="fa ' . $network->class . '"></i> ';
                                    echo '<span class="text">' . $network->_joinData->url . '</span>';
                                    echo '<div class="tools">';
                                        echo $this->Form->PostLink(
                                            '<i class="fa fa-trash-o"></i>',
                                            [
                                                'controller' => 'companies_networks',
                                                'action' => 'delete',
                                                $network->_joinData->id,
                                                $network->_joinData->company_id,
                                            ],
                                            [
                                                'escape' => false,
                                                'confirm' => __('Confirm to delete this network?'),
                                                'class'=>'btn btn-danger btn-xs'
                                            ]
                                        );
                                    echo '</div>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane <?= $tab == 'communications'?'active':''; ?>" id="communications">
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Comunicaciones</strong>
                            <p class="text-muted">
                                Medios de comunicación con la empresa
                            </p>
                            <hr>
                            <?php
                            echo $this->Form->create($company,
                                [
                                    'url' => [
                                        'action' => 'edit',
                                        'tab' => 'communications'
                                    ],
                                    'role' => 'form',
                                    'class' => 'form-horizontal',
                                    'novalidate' => true
                                ]
                            );

                            echo $this->Form->input('communications_companies.0.communication_id', [
                                'label' => 'Tipo',
                                'type' => 'select',
                                'options' => $communications
                            ]);
                            echo $this->Form->input('communications_companies.0.value');

                            ?>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?= $this->Form->button(__('Save')) ?>
                                </div>
                            </div>
                            <?php
                            echo  $this->Form->end();
                            ?>
                        </div>
                        <hr>
                        <ul class="todo-list">
                            <?php
                            foreach ($company->communications as $communication) {
                                echo '<li>';
                                echo '<i class="fa ' . $communication->class . '"></i> ' . $communication->name;
                                echo '<span class="text">' . $communication->_joinData->value . '</span>';
                                echo '<div class="tools">';
                                echo $this->Form->PostLink(
                                    '<i class="fa fa-trash-o"></i>',
                                    [
                                        'controller' => 'communications_companies',
                                        'action' => 'delete',
                                        $communication->_joinData->id,
                                        $communication->_joinData->company_id,
                                    ],
                                    [
                                        'escape' => false,
                                        'confirm' => __('Confirm to delete this communication?'),
                                        'class'=>'btn btn-danger btn-xs'
                                    ]
                                );
                                echo '</div>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane <?= $tab == 'cnae'?'active':''; ?>" id="cnae">
                        <div class="box-body">
                            <div class="pull-right">
                                <?= $this->Html->link(__('New'), ['controller' => 'cnaes','action' => 'index', $company->id], ['class'=>'btn btn-success btn-xs']) ?>
                            </div>
                            <strong><i class="fa fa-book margin-r-5"></i> CNAE</strong>
                            <p class="text-muted">
                                Código Nacional de Actividades Económicas
                            </p>
                            <table class="table table-hover ">
                                <tr>
                                    <th><?= $this->Paginator->sort('cod_cnae', 'Código') ?></th>
                                    <th class="hidden-xs"><?= $this->Paginator->sort('codintegr', 'Código Full') ?></th>
                                    <th class="hidden-xs"><?= $this->Paginator->sort('titulo_cnae', 'Título') ?></th>
                                    <th><?= __('Actions') ?></th>
                                </tr>
                                <?php foreach ($cnaes as $cnae): ?>
                                    <tr>
                                        <td><?= h($cnae->cod_cnae) ?></td>
                                        <td class="hidden-xs"><?= h($cnae->codintegr) ?></td>
                                        <td class="hidden-xs"><?= h($cnae->titulo_cnae) ?></td>
                                        <td class="actions" style="white-space:nowrap">
                                            <?php
                                            echo $this->Form->postLink(
                                            '<i class="fa fa-trash"></i>',
                                            [
                                                'controller' => 'cnaes',
                                                'action' => 'delete',
                                                $company->id,
                                                $cnae->id
                                            ],
                                            [
                                                'confirm' => __('Confirm to Delete this cnae?'),
                                                'class'=>'btn btn-xs text-red',
                                                'escape'=>false

                                            ]);
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>

                    </div>

                    <!-- /.tab-pane -->
                    <div class="tab-pane <?= $tab == 'addresses'?'active':''; ?>" id="addresses">
                        <!-- /.tab-pane -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#address" data-toggle="tab">Dirección</a></li>
                                <li class=""><a href="#new_address" data-toggle="tab">New Dirección</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="address">
                                    <?php
                                    if ($company->dirty('addresses')){
                                        $addresses = $company->extractOriginal($company->visibleProperties())['addresses'];
                                    }else{
                                        $addresses = $company->addresses;
                                    }
                                    ?>

                                    <div class="box-body" ng-app="app" ng-controller="myCtrl">
                                        <table class="table table-hover ">
                                            <tr>
                                                <th class="visible-xs"><?= __('Dirección') ?></th>

                                                <th class="hidden-xs"><?= __('ID') ?></th>
                                                <th class="hidden-xs"><?= __('Vía') ?></th>
                                                <th class="hidden-xs"><?= __('Calle') ?></th>
                                                <th class="hidden-xs"><?= __('Número') ?></th>
                                                <th class="hidden-xs"><?= __('Núcleo') ?></th>
                                                <th class="hidden-xs"><?= __('CP') ?></th>
                                                <th class="hidden-xs"><?= __('Población') ?></th>
                                                <th class="hidden-xs"><?= __('Municipio') ?></th>
                                                <th><?= __('Actions') ?></th>
                                            </tr>

                                            <?php

                                            $labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                            $cont = 0;
                                            foreach ($addresses as $address):?>
                                                <tr class="<?= $address->principal?'text-success':'';?>">
                                                    <td class="visible-xs">
                                                        <?=
                                                        $labels[$cont] . ' ' .
                                                        h($address->TVIA) . ' ' .
                                                        h($address->NVIAC) . ' ' .
                                                        h($address->number) . ' ' .
                                                        h($address->NNUCLE50) . ', ' .
                                                        h($address->CPOS) . ' - ' .
                                                        h($address->NENTSI50)  . '  ' .
                                                        h($address->DMUN50)
                                                        ?>

                                                    </td>

                                                    <td class="hidden-xs"><?= $labels[$cont] ?></td>
                                                    <td class="hidden-xs"><?= h($address->TVIA) ?></td>
                                                    <td class="hidden-xs"><?= h($address->NVIAC) ?></td>
                                                    <td class="hidden-xs"><?= h($address->number) ?></td>
                                                    <td class="hidden-xs"><?= h($address->NNUCLE50) ?></td>
                                                    <td class="hidden-xs"><?= h($address->CPOS) ?></td>
                                                    <td class="hidden-xs"><?= h($address->NENTSI50) ?></td>
                                                    <td class="hidden-xs"><?= h($address->DMUN50) ?></td>
                                                    <td class="actions" style="white-space:nowrap">
                                                        <?= $this->Form->postLink(
                                                            '<i class="fa fa-trash"></i>',
                                                            [
                                                                'controller' => 'addresses',
                                                                'action' => 'delete',
                                                                $address->id,
                                                                $address->companie_id
                                                            ],
                                                            [
                                                                'confirm' => __('¿Eliminar Dirección?'),
                                                                'class'=>'btn btn-danger btn-xs',
                                                                'escape' => false
                                                            ]) ?>

                                                        <?= $this->Form->button(
                                                            '<i class="fa fa-map-marker"></i>'   ,
                                                            [
                                                                'id' => 'btn_map',
                                                                'class' => 'btn btn-success btn-xs',
                                                                'data-toggle' => 'modal',
                                                                'data-target' => '#myModal',
                                                                'data-value' => $address->id
                                                            ]
                                                        );
                                                        ?>

                                                        <?php
                                                        if (!$address->principal) {
                                                            echo $this->Form->postLink(
                                                                '<i class="fa fa-check"></i>',
                                                                [
                                                                    'controller' => 'addresses',
                                                                    'action' => 'setdefault',
                                                                    $address->id
                                                                ],
                                                                [
                                                                    'confirm' => __('¿Establecer como principal?'),
                                                                    'class' => 'btn btn-xs',
                                                                    'escape' => false
                                                                ]);
                                                        }else{
                                                            echo $this->Html->link(
                                                                '<i class="fa fa-check"></i>',
                                                                'javascript:void(0)',
                                                                [
                                                                    'class' => 'btn btn-primary btn-xs',
                                                                    'escape' => false
                                                                ]
                                                            );
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $cont++;
                                                endforeach;
                                            ?>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box box-info">
                                        <div class="box-header">
                                            <h5>Localizar</h5>
                                        </div>
                                        <div class="box-body">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" src="<?= $this->Url->build(['controller' => 'maps', 'action' => 'view', $company->id]); ?>"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="new_address">
                                    <div class="box-body" ng-app="app">
                                        <strong><i class="fa fa-book margin-r-5"></i> Direcciones</strong>
                                        <p class="text-muted">
                                            Direcciones de la empresa
                                        </p>
                                        <div class="input-group input-group-sm">
                                            <?php
                                            echo $this->Form->input('search',[
                                                'label' => false,
                                                'type' => 'text',
                                                'templates' => [
                                                    'inputContainer' =>'{{content}}'
                                                ],
                                                'ng-model' => 'qcalles',
                                                'placeholder' => __('Fill in to start search')
                                            ]);
                                            echo '<span class="input-group-btn">';
                                            echo $this->Form->button(
                                                __('Filter'),
                                                [
                                                    'id' => 'btn_search',
                                                    'class' => 'btn btn-info btn-flat',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#ModalCalles',
                                                    'ng-click' => 'buscar_calles()'
                                                ]
                                            );
                                            echo '</span>';
                                            ?>
                                        </div>
                                        <p class="text-muted text-sm">
                                            NOTA: El filtro de la búsqueda se hara en función de los valores seleccionados de <strong>Comunidad</strong>, <strong>Provincia</strong> y <strong>Municipio</strong>.
                                        </p>
                                        <hr/>
                                        <?php
                                        echo $this->Form->create(null,
                                            [
                                                'url' => [
                                                    'action' => 'edit',
                                                    'tab' => 'addresses',
                                                    $company->id
                                                ],
                                                'role' => 'form',
                                                'class' => 'form-horizontal',
                                                'novalidate' => true
                                            ]
                                        );

                                        echo $this->Form->input('addresses.0.CCOM', [
                                            'label' => 'Comunidad',
                                            'type' => 'select',
                                            'ng-model' => 'comunidad',
                                            'ng-options' => "comunidad.COM for comunidad in comunidades track by comunidad.CCOM",
                                            'empty' => 'Comunidad'
                                        ]);

                                        echo $this->Form->hidden('addresses.0.COM',[
                                            'value' => "{{ comunidad.COM }}"
                                        ]);


                                        echo $this->Form->input('addresses.0.CPRO', [
                                            'label' => 'Provincia',
                                            'type' => 'select',
                                            'ng-model' => 'provincia',
                                            'ng-options' => "provincia as provincia.PRO for provincia in provincias track by provincia.CPRO",
                                            'ng-change' => "clean('provincia')",
                                            'empty' => 'Provincia'
                                        ]);

                                        echo $this->Form->hidden('addresses.0.PRO',[
                                            'value' => "{{ provincia.PRO }}"
                                        ]);

                                        echo $this->Form->input('addresses.0.CMUM', [
                                            'label' => 'Municipio',
                                            'type' => 'select',
                                            'ng-model' => 'munic',
                                            'ng-options' => "munic as munic.DMUN50 for munic in munics track by munic.CMUM",
                                            'empty' => 'Municipio'
                                        ]);

                                        echo $this->Form->hidden('addresses.0.DMUN50',[
                                            'value' => "{{ munic.DMUN50 }}"
                                        ]);


                                        echo $this->Form->input('addresses.0.NENTSI50', [
                                            'label' => 'Población',
                                            'type' => 'select',
                                            'ng-model' => 'poblacion',
                                            'ng-options' => "poblacion as poblacion.NENTSI50 for poblacion in poblaciones track by poblacion.NENTSI50",
                                            'empty' => 'Población'
                                        ]);

                                        echo $this->Form->input('addresses.0.CUN', [
                                            'label' => 'Núcleo',
                                            'type' => 'select',
                                            'ng-model' => 'nucleo',
                                            'ng-options' => "nucleo as nucleo.NNUCLE50 for nucleo in nucleos track by nucleo.CUN",
                                            'empty' => 'Núcleo'
                                        ]);

                                        echo $this->Form->hidden('addresses.0.NNUCLE50',[
                                            'value' => "{{ nucleo.NNUCLE50 }}"
                                        ]);


                                        echo $this->Form->input('addresses.0.CPOS', [
                                            'label' => 'Código Postal',
                                            'type' => 'select',
                                            'ng-model' => 'cp',
                                            'ng-options' => "cp as cp.CPOS for cp in cps track by cp.CPOS",
                                            'empty' => 'Código Postal'
                                        ]);

                                        echo $this->Form->input('addresses.0.CVIA', [
                                            'label' => 'Calle',
                                            'type' => 'select',
                                            'ng-model' => 'calle',
                                            'ng-options' => "calle.NVIAC + ' , ' + calle.TVIA for calle in calles track by calle.CVIA",
                                            'empty' => 'Calle'
                                        ]);

                                        echo $this->Form->hidden('addresses.0.NVIAC',[
                                            'value' => "{{ calle.NVIAC }}"
                                        ]);

                                        echo $this->Form->hidden('addresses.0.TVIA',[
                                            'value' => "{{ calle.TVIA }}"
                                        ]);


                                        echo $this->Form->input('addresses.0.number',[
                                            'label' => 'Número',
                                            'type' => 'text'
                                        ]);

                                        echo $this->Form->input('addresses.0.block',[
                                            'label' => 'Bloque',
                                            'type' => 'text'
                                        ]);

                                        echo $this->Form->input('addresses.0.floor',[
                                            'label' => 'Piso',
                                            'type' => 'text'
                                        ]);

                                        echo $this->Form->input('addresses.0.door',[
                                            'label' => 'Puerta',
                                            'type' => 'text'
                                        ]);

                                        echo $this->Form->input('addresses.0.ubicacion_id', [
                                            'options' => $ubicaciones,
                                            'empty' => 'Elije Ubicación',
                                            'label' => __('Ubicación'),
                                            'templates' => [
                                                'inputContainer' =>'<div class="form-group has-warning">{{content}}</div>'
                                            ]
                                        ]);

                                        echo $this->Form->input('addresses.0.ubicacion_name', [
                                            'type' => 'text',
                                            'label' => __('Nombre Ubicación'),
                                            'templates' => [
                                                'inputContainer' =>'<div class="form-group has-warning">{{content}}</div>'
                                            ]
                                        ]);
                                        ?>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <?= $this->Form->button(__('Save')) ?>
                                            </div>
                                        </div>
                                        <?php
                                        echo  $this->Form->end();
                                        ?>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->


<?php
//Carga de Styles y Scripts necesarios para la view.

$this->start('css');
echo $this->element('styles');
$this->end();

$this->start('scriptBotton');
echo $this->element('scripts');
$this->end();


?>
