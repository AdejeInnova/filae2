<section class="content-header">
    <h1>
        Province
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
                    <h3 class="box-title"><?= __('View') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <h4><?= __('Name')?></h4>
                    <?php
                    echo $province->name;
                    ?>

                    <h4><?= __('Region')?></h4>
                    <?php
                    echo $province->region->name;
                    ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>

            </div>
        </div>
    </div>
</section>
