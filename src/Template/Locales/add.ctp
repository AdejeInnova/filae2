<section class="content-header">
    <h1>
        Locale
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
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Form') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($local, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name');
                    echo $this->Form->input('description',['id' => 'description']);
                    echo $this->Form->input('email');
                    echo $this->Form->input('superficie_id', [
                        'options' => $superficies,
                        'empty' => true,
                        'label' => __('Superficie del Local')
                    ]);

                    //Obtenemos las tags seleccionadas.
                    echo $this->Form->input('tags',[
                        'id' => 'tags',
                        'options' => $tags,
                        'label' => 'Tags Actividad',
                        'class' => 'select2',
                        'multiple' => true,
                    ]);
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


<?php
//Carga de Styles y Scripts necesarios para la view.

$this->start('css');
echo $this->element('styles');
$this->end();

$this->start('scriptBotton');
echo $this->element('scripts');
$this->end();


?>