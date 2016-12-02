<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>
        <?= $this->Html->link(
            '<i class="fa fa-chevron-left"></i> ' . __('Volver'),
            [
                'controller' => 'companies',
                'action' => 'edit',
                $this->request->params['pass'][0],
                'tab' => 'cnae'
            ],
            [
                'class'=>'btn btn-info btn-sm',
                'escape' => false
            ]
        ) ?>
        <span class="text-blue">Empresa: </span><?= h($company->tradename) ?>
        <small>Añadir cnae</small>
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
        <li>
            <?= $this->Html->link(
                __('Edit'),
                [
                    'controller' => 'companies',
                    'action' => 'edit',
                    $this->request->params['pass'][0],
                    'tab' => 'cnae'
                ]
            ); ?>

        </li>
        <li class="active"><?= __('Cnae') ?></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <div class="box-tools">
                            <form action="<?php echo $this->Url->build(); ?>" method="POST">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" value="<?= $search ?>" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                                    <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <?php
                    if (!empty($breadcrumb)) {
                        ?>
                        <ol class="breadcrumb">
                            <li>
                                <?php
                                    echo $this->Html->link(
                                        'Home',
                                        [
                                            'controller' => 'cnaes',
                                            'action' => 'index',
                                            $this->request->params['pass'][0]
                                        ]);
                                ?>
                            </li>
                            <?php
                            foreach ($breadcrumb as $key => $value) {
                                echo '<li>';
                                echo $this->Html->link(h($value[0]['titulo_cnae2009']), ['controller' => 'cnaes', 'action' => 'index', $this->request->params['pass'][0], 'cod_cnae' => $value[0]['cod_cnae2009']]);
                                echo '</li>';
                            }
                            ?>
                        </ol>
                        <?php
                    }

                    ////////////////////////





                    ////////////////////////
                    ?>

                    <table class="table table-hover">
                        <tr>
                            <th><?= $this->Paginator->sort('cod_cnae') ?></th>
                            <th><?= $this->Paginator->sort('codintegr', 'Cod. Íntegro') ?></th>
                            <th><?= $this->Paginator->sort('titulo_cnae') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cnaes as $cnae): ?>
                            <tr>
                                <td><?= h($cnae['cod_cnae2009']) ?></td>
                                <td><?= h($cnae['codintegr']) ?></td>
                                <td>
                                <?php
                                if (strlen($cnae['cod_cnae2009']) > 3){
                                    echo h($cnae['titulo_cnae2009']);
                                }else{
                                    echo $this->Html->link(h($cnae['titulo_cnae2009']), ['controller' => 'cnaes','action' => 'index', $this->request->params['pass'][0], 'cod_cnae' => $cnae['cod_cnae2009']]);
                                }
                                ?>
                                </td>
                                <td class="actions" style="white-space:nowrap">
                                    <?php
                                    $class = (strlen($cnae['cod_cnae2009']) > 3)?'btn btn-info btn-xs disabled':'btn btn-info btn-xs';
                                    echo $this->Html->link(
                                        __('Ver'),
                                        [
                                            'controller' => 'cnaes',
                                            'action' => 'index',
                                            $this->request->params['pass'][0],
                                            'cod_cnae' => $cnae['cod_cnae2009']
                                        ],
                                        [
                                            'class'=>$class,
                                        ]
                                    );

                                    $encontrado = false;
                                    $cnae_id = null;
                                    foreach ($cnaes_companies as $reg){
                                        if ($reg->cod_cnae === $cnae['cod_cnae2009']){
                                            $encontrado = true;
                                            $cnae_id = $reg->id;
                                        }
                                    }

                                    if (!$encontrado){
                                        echo '&nbsp;';
                                        echo $this->Form->postLink(
                                            __('Add'),
                                            [
                                                'action' => 'add',
                                                $this->request->params['pass'][0],
                                                'cnae' => $cnae['cod_cnae2009']
                                            ],
                                            [
                                                'class'=>'btn btn-success btn-xs'
                                            ]);
                                    }else{
                                        echo '&nbsp;';
                                        echo $this->Form->postLink(
                                            __('Del'),
                                            [
                                                'action' => 'delete',
                                                $this->request->params['pass'][0],
                                                $cnae_id,
                                                'origin' => 'cnaes'
                                            ],
                                            [
                                                'class'=>'btn btn-danger btn-xs'
                                            ]);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->
