<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Provinces
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Provinces</h3>
          <div class="box-tools">
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
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('name') ?></th>
              <th><?= $this->Paginator->sort('region_id') ?></th>
              <th><?= $this->Paginator->sort('created') ?></th>
              <th><?= $this->Paginator->sort('modified') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($provinces as $province): ?>
              <tr>
                <td><?= $this->Number->format($province->id) ?></td>
                <td><?= h($province->name) ?></td>
                <td><?= $province->has('region') ? $this->Html->link($province->region->name, ['controller' => 'Regions', 'action' => 'view', $province->region->id]) : '' ?></td>
                <td><?= h($province->created) ?></td>
                <td><?= h($province->modified) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $province->id], ['class'=>'btn btn-primary btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $province->id], ['class'=>'btn btn-primary btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $province->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
