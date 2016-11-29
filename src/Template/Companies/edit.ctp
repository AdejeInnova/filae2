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
                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>

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

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> <?= __('Notes')?></strong>

                    <p><?= h($company->description) ?></p>
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
                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?= $tab == 'settings'?'active':''; ?>" id="settings">
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
                            echo $this->Form->input('description',['label' => __('Notes')]);
                            echo $this->Form->input('company_id', ['label' => __('Parent Company')]);
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
