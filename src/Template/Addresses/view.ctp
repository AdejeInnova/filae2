<section class="content-header">
  <h1>
    Address
    <small><?= __('View') ?></small>
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
            echo $this->Form->input('road_id', ['options' => $roads, $address->road_id, 'disabled' => true]);
            echo $this->Form->input('address', ['placeholder' => $address->address, 'disabled' => true]);
            echo $this->Form->input('number', ['placeholder' => $address->number, 'disabled' => true]);
            echo $this->Form->input('block', ['placeholder' => $address->block, 'disabled' => true]);
            echo $this->Form->input('floor', ['placeholder' => $address->floor, 'disabled' => true]);
            echo $this->Form->input('door', ['placeholder' => $address->door, 'disabled' => true]);
            echo $this->Form->input('default', ['placeholder' => $address->default, 'disabled' => true]);
            echo $this->Form->input('latlon', ['placeholder' => $address->latlon, 'disabled' => true]);
            echo $this->Form->input('town_id', ['options' => $towns, $address->town_id, 'disabled' => true]);
            echo $this->Form->input('person_id', ['placeholder' => $address->person_id, 'disabled' => true]);
            echo $this->Form->input('core', ['placeholder' => $address->core, 'disabled' => true]);
            echo $this->Form->input('postcode', ['placeholder' => $address->postcode, 'disabled' => true]);
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
