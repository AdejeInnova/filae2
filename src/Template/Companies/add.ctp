<section class="content-header">
    <h1>
        <?= __('Company') ?>
        <small><?= __('Add') ?></small>
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
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                <?php
                $this->Form->templates([
                    'inputContainer' => '<div class="form-group"><label class="col-sm-2 control-label">{{label}}</label><div class="col-sm-10">{{content}}</div></div>'
                ]);

                echo $this->Form->create($company, [
                    'role' => 'form',
                    'class' => 'form-horizontal',
                    'novalidate' => true
                ]);
                echo $this->Form->input('tradename', ['label' => __('Tradename') . '*']);

                echo $this->Form->input('name', ['label' => __('Razón Social')]);
                echo $this->Form->input('idcard_id', [
                    'options' => $idcards
                ]);
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
                ?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?= $this->Form->button(__('Save')) ?>
                    </div>
                </div>

                <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//Carga de Styles y Scripts necesarios para la view.

$this->start('css');
echo $this->element('styles');
$this->end();

$this->start('scriptBotton');
echo $this->element('scripts');
$this->end();
?>

