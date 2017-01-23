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
<section class="content">

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
                            echo $this->Html->Link($network->_joinData->url);
                        echo '</span>';
                        echo '</p>';
                    }
                    ?>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> <?= __('Location') ?></strong>

                    <p class="text-muted">Malibu, California</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                    <p>
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">Node.js</span>
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
                                'class' => ['select2'],
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
                        <div class="box-body">
                            <div class="pull-right">
                                <?= $this->Html->link(__('New'), ['controller' => 'cnaes','action' => 'index', $company->id], ['class'=>'btn btn-success btn-xs']) ?>
                            </div>
                            <strong><i class="fa fa-book margin-r-5"></i> Direcciones</strong>
                            <p class="text-muted">
                                Direcciones de la empresa
                            </p>
                            <hr/>
                            <?php
                            echo $this->Form->create($company,
                                [
                                    'url' => [
                                        'action' => 'edit',
                                        'tab' => 'addresses'
                                    ],
                                    'role' => 'form',
                                    'class' => 'form-horizontal',
                                    'novalidate' => true
                                ]
                            );

                            /*echo $this->Form->input('addresses_companies.0.communication_id', [
                                'label' => 'Tipo',
                                'type' => 'select',
                                'options' => $communications
                            ]);*/

                            echo $this->Form->input('addresses_companies.0.communication_id', [
                                'label' => 'Tipo',
                                'type' => 'select',
                                'options' => $communications
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
