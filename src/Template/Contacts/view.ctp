<section class="content-header">
  <h1>
    <?php echo __('Contact'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                                <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($contact->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Position') ?></dt>
                                        <dd>
                                            <?= h($contact->position) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Company') ?></dt>
                                <dd>
                                    <?= $contact->has('company') ? $contact->company->tradename : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Email') ?></dt>
                                        <dd>
                                            <?= h($contact->email) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                                                                                                                                                                                
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Communications']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($contact->communications)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    Class
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($contact->communications as $communications): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($communications->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($communications->name) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($communications->class) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Communications', 'action' => 'view', $communications->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Communications', 'action' => 'edit', $communications->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Communications', 'action' => 'delete', $communications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $communications->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
