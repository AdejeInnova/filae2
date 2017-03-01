<?php

if (($address->lat) && ($address->lon)){
    ?>
    <div id="toolsMap">
        <?php
        echo $this->Html->link(
            'Reposicionar',
            [
                'controller' => 'Maps',
                'action' => 'geolocalizar',
                $dir->id,
                $address->id,
                $model
            ],[
                'class' => 'btn'
            ]
        );
        ?>
    </div>
    <?
}else{
    ?>
    <div id="disabledMap"></div>
    <div id="toolsMap">
        <?php
            echo $this->Html->link(
                'Geolocalizar',
                [
                    'controller' => 'Maps',
                    'action' => 'geolocalizar',
                    $dir->id,
                    $address->id,
                    $model
                ],[
                    'class' => 'btn'
                ]
            );
        ?>
    </div>
    <?
}
?>

<div id="map"></div>