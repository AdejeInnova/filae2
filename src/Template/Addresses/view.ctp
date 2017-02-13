<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <dl class="dl-horizontal">
                <dt>Comunidad</dt>
                <dd><?= $address->COM ?></dd>
                <dt>Provincia</dt>
                <dd><?= $address->PRO ?></dd>
                <dt>Dirección</dt>
                <dd>
                    <?=
                    h($address->TVIA) . ' ' .
                    h($address->NVIAC) . ' ' .
                    h($address->number) . ' ' .
                    h($address->NNUCLE50) . ', ' .
                    h($address->CPOS) . ' - ' .
                    h($address->NENTSI50)  . '  ' .
                    h($address->DMUN50)
                    ?>
                </dd>
                <dt>Bloque</dt>
                <dd><?= $address->block ?></dd>
                <dt>Piso</dt>
                <dd><?= $address->floor ?></dd>
                <dt>Puerta</dt>
                <dd><?= $address->door ?></dd>
                <dt>Ubicación</dt>
                <dd><?= $address->ubicacion_id?\Cake\Core\Configure::read('Ubicaciones')[$address->ubicacion_id]:''; ?></dd>
                <dt>Nombre Ubicación</dt>
                <dd><?= $address->ubicacion_name ?></dd>

            </dl>

            <hr/>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="<?= $this->Url->build(['controller' => 'maps', 'action' => 'vermapa', $address->companie_id, $address->id]); ?>"></iframe>
            </div>
        </div>
    </div>
</section>
