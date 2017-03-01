<div id="markPositionCruz">
    <?= $this->Html->image('markposition.png');?>
</div>

<div id="toolsMap">
    <?php
        echo $this->Form->create(null,
            [
                'url' => [
                    'action' => 'geolocalizar',
                    $dir->id,
                    $address->id,
                    $model
                ]
            ]
        );
        echo $this->Form->create(null);
            echo $this->Form->input('lat',[
                    'label' => false,
                    'type' => 'hidden'
                ]
            );

        echo $this->Form->input('lon',[
                'label' => false,
                'type' => 'hidden'
            ]
        );

        echo $this->Form->button(
            __('Guardar'),
            [
                'class' => 'btnt'
            ]
        );
        echo $this->Form->end();
    ?>
</div>

<div id="map"></div>