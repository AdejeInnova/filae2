<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Locales
        <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> <?= __('Locales') ?></h3>
                    <div class="box-tools" style="margin-left: 10px;">
                        <form action="<?php echo $this->Url->build(); ?>" method="POST">
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" value="<?= $search ?>" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                                <span class="input-group-btn">
                                    <?php
                                        if ($search){
                                            echo $this->Html->link(
                                                '<i class="fa fa-close"></i>',
                                                ['action' => 'index'],
                                                [
                                                    'escape' => false,
                                                    'class' => 'btn btn-default'
                                                ]
                                            );
                                        }
                                    ?>
                                    <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('name') ?></th>
                            <th><?= $this->Paginator->sort('email') ?></th>
                            <th><?= __('Superficie') ?></th>
                            <th><?= __('Contacto') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($locales as $local): ?>
                            <tr>
                                <td><?= $this->Number->format($local->id) ?></td>
                                <td><?= h($local->name) ?></td>
                                <td><?= h($local->email) ?></td>
                                <td><?= $superficies[$local->superficie_id] ?></td>
                                <td><?php
                                        if ($local->communications) {
                                            echo $local->communications['0']['_joinData']['value'];

                                            echo sizeof($local->communications)>1?' +':'';
                                        }

                                    ?></td>
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $local->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $local->id], ['confirm' => __('¿Confirma eliminar este local?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php echo $this->Paginator->numbers(); ?>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->
