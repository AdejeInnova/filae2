<section class="content-header">
  <h1>
    Company
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
        <?= $this->Form->create($company, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('name', ['placeholder' => $company->name, 'disabled' => true]);
            echo $this->Form->input('tradename', ['placeholder' => $company->tradename, 'disabled' => true]);
            echo $this->Form->input('idcard_id', ['options' => $idcards, $company->idcard_id, 'disabled' => true]);
            echo $this->Form->input('identity_card', ['placeholder' => $company->identity_card, 'disabled' => true]);
            echo $this->Form->input('description', ['placeholder' => $company->description, 'disabled' => true]);
            echo $this->Form->input('company_id', ['placeholder' => $company->company_id, 'disabled' => true]);
            echo $this->Form->input('address_id', ['options' => $addresses, 'empty' => true, 'placeholder' => $company->address_id, 'disabled' => true]);
            echo $this->Form->input('communications._ids', ['options' => $communications]);
            echo $this->Form->input('networks._ids', ['options' => $networks]);
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
