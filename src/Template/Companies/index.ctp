<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Companies') ?>
        <div class="pull-right">
            <?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?>
        </div>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> <?= __('Companies') ?></h3>
                    <div class="box-tools" style="margin-left: 10px;">
                        <form action="<?php echo $this->Url->build(); ?>" method="POST">
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
				<span class="input-group-btn">
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
                            <th><?= $this->Paginator->sort('Nombre', 'Nombre Comercial') ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('Razón Social') ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('idcard_id') ?></th>
                            <th class="hidden-xs"><?= $this->Paginator->sort('identity_card') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($companies as $company): ?>
                            <tr>
                                <td>
                                    <p class="product-description"><span class="visible-xs text-bold">Nombre Comercial:</span> <?= h($company->tradename) ?></p>
                                    <p class="visible-xs"><span class="visible-xs-inline text-bold"><?= $company->idcard->name ?>:</span> <?= h($company->identity_card) ?></p>
                                </td>
                                <td class="hidden-xs"><?= h($company->name) ?></td>
                                <td class="hidden-xs"><?= $company->has('idcard') ? $this->Html->link($company->idcard->name, ['controller' => 'Idcards', 'action' => 'view', $company->idcard->id]) : '' ?></td>
                                <td class="hidden-xs"><?= h($company->identity_card) ?></td>
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $company->id], ['class'=>'btn btn-primary btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $company->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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


<?php
//Carga de Styles y Scripts necesarios para la view.

$this->start('css');
echo $this->element('styles');
$this->end();

$this->start('scriptBotton');
echo $this->element('scripts');
$this->end();
?>
