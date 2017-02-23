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
                    <div class="box no-padding box-info">
                        <div class="box-header">
                            <h4>Añadir Teléfono:</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <?php
                                echo $this->Form->input('communication_id',
                                    [
                                        'id' => 'communication_id',
                                        'label' => false,
                                        'type' => 'select',
                                        'options' => $communications,
                                        'templates' => [
                                            'inputContainer' => '<div class="col-xs-3">{{content}}</div>'
                                        ]
                                    ]
                                );

                                echo $this->Form->input('communication_value',
                                    [
                                        'id' => 'communication_value',
                                        'label' => false,
                                        'templates' => [
                                            'inputContainer' => '<div class="col-xs-3">{{content}}</div>'
                                        ]
                                    ]
                                );
                                ?>
                                <div class="col-xs-3">
                                    <?= $this->Html->link(
                                        '<i class="fa fa-plus"></i>',
                                        'javascript:addCommunication()',
                                        [
                                            'class'=>'btn btn-success btn-xs',
                                            'escape' => false
                                        ])
                                    ?>
                                </div>
                            </div>
                            <!-- ./row-->
                        </div>
                    </div>


                    <ul class="todo-list" id="ul_communications">
                        <?php
                        foreach ($contact->communications as $key => $communication) {
                            echo '<li id="' . $communication->_joinData->id . '">';
                            echo $this->Form->hidden('communications.' . $key . '.id', ['value' => $communication->id]);
                            echo $this->Form->hidden('communications.' . $key . '._joinData.id', ['value' => $communication->_joinData->id]);
                            echo $this->Form->hidden('communications.' . $key . '._joinData.value', ['value' => $communication->_joinData->value]);
                            echo $this->Form->hidden('communications.' . $key . '._joinData.delete', ['value' => 0, 'class' => 'del']);

                            echo '<span class="text-muted">' . $communication->name . '</span>';
                            echo '<span class="text">' . $communication->_joinData->value . '</span>';
                            echo '<div class="tools">';
                            echo $this->Html->Link(
                                '<i class="fa fa-trash-o"></i>',
                                'javascript:void(0)',
                                [
                                    'escape' => false,
                                    'class'=>'btn btn-danger btn-xs',
                                    'onclick' => 'javascript:removeCommunication(this)'
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
