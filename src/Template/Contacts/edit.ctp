<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Contact') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($contact, [
                        'role' => 'form',
                        'url' => [
                            'controller' => 'contacts',
                            'action' => 'edit',
                            $contact->id
                        ]
                    ]
                )
                ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name');
                    echo $this->Form->input('position',['label' => __('Cargo')]);
                    echo $this->Form->input('email');

                    ?>
                    <h4>Comunicaciones:</h4>
                    <div class="box no-border">
                        <div class="box-header">Nueva Comunicación:</div>
                        <div class="box-body no-margin no-pad-top">
                        </div>
                    </div>


                    <ul class="todo-list">
                        <?php
                        foreach ($contact->communications as $key => $communication) {
                            echo '<li>';
                            echo $this->Form->hidden('communications.' . $key . '.id', ['value' => $communication->id]);
                            echo $this->Form->hidden('communications.' . $key . '.communications_contacts.' . $key . '.id', ['value' => $communication->_joinData->id]);
                            echo $this->Form->hidden('communications.' . $key . '.communications_contacts.' . $key . '.communication_id', ['value' => $communication->_joinData->communication_id]);
                            echo $this->Form->hidden('communications.' . $key . '.communications_contacts.' . $key . '.contact_id', ['value' => $communication->_joinData->contact_id]);
                            echo $this->Form->hidden('communications.' . $key . '.communications_contacts.' . $key . '.value', ['value' => $communication->_joinData->value]);
                            echo $this->Form->hidden('communications.' . $key . '.communications_contacts.' . $key . '.delete', ['value' => 0]);

                            echo $communication->name;
                            echo '<span class="text">' . $communication->_joinData->value . '</span>';
                            echo '<div class="tools">';
                            echo $this->Html->Link(
                                '<i class="fa fa-trash-o"></i>',
                                'javascript:console.log(this)',
                                [
                                    'escape' => false,
                                    'confirm' => __('Confirm to delete this communication?'),
                                    'class'=>'btn btn-danger btn-xs'
                                ]
                            );
                            echo '</div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>


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
