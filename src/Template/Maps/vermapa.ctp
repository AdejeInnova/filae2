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
                $company->id,
                $address->id
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
                    $company->id,
                    $address->id
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