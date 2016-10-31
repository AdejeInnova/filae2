<section class="content-header">
  <h1>
    Address
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($address, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('road_id', ['options' => $roads]);
            echo $this->Form->input('address');
            echo $this->Form->input('number');
            echo $this->Form->input('block');
            echo $this->Form->input('floor');
            echo $this->Form->input('door');
            echo $this->Form->input('default');
            echo $this->Form->input('latlon');
            echo $this->Form->input('town_id', ['options' => $towns]);
            echo $this->Form->input('person_id');
            echo $this->Form->input('core');
            echo $this->Form->input('postcode');
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
