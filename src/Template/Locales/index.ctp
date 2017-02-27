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
              <th><?= $this->Paginator->sort('email') ?></th>
              <th><?= $this->Paginator->sort('superficie_id') ?></th>
              <th><?= $this->Paginator->sort('tag_count') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($locales as $locale): ?>
              <tr>
                <td><?= $this->Number->format($locale->id) ?></td>
                <td><?= h($locale->email) ?></td>
                <td><?= $this->Number->format($locale->superficie_id) ?></td>
                <td><?= $this->Number->format($locale->tag_count) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $locale->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $locale->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $locale->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
