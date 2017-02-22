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
                <?= $this->Form->create($contact, [
                        'role' => 'form',
                        'url' => [
                            'controller' => 'contacts',
                            'action' => 'add',
                            $company_id
                        ]
                    ]
                )
                ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name');
                    echo $this->Form->input('position',['label' => __('Cargo')]);
                    echo $this->Form->hidden('companie_id', ['value' => $company_id]);
                    echo $this->Form->input('email');
                    //echo $this->Form->input('communications._ids', ['options' => $communications]);
                    ?>
                    <div class="box no-border">
                        <div class="box-body">
                            <?php
                                echo $this->Form->hidden('communications.0.id', ['value' => 1]);

                                echo $this->Form->input('communications.0.communications_contacts.0.communication_id', [
                                    'label' => 'Tipo',
                                    'type' => 'select',
                                    'options' => $communications]
                                );

                                echo $this->Form->input('communications.0.communications_contacts.0.value');
                            ?>
                        </div>
                    </div>
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
