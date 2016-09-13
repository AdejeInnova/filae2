<section class="content-header">
  <h1>
    User
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
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($user, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('username', ['placeholder' => $user->username, 'disabled' => true]);
            echo $this->Form->input('email', ['placeholder' => $user->email, 'disabled' => true]);
            echo $this->Form->input('password', ['placeholder' => $user->password, 'disabled' => true]);
            echo $this->Form->input('first_name', ['placeholder' => $user->first_name, 'disabled' => true]);
            echo $this->Form->input('last_name', ['placeholder' => $user->last_name, 'disabled' => true]);
            echo $this->Form->input('token', ['placeholder' => $user->token, 'disabled' => true]);
            echo $this->Form->input('token_expires', ['placeholder' => $user->token_expires, 'disabled' => true]);
            echo $this->Form->input('api_token', ['placeholder' => $user->api_token, 'disabled' => true]);
            echo $this->Form->input('activation_date', ['placeholder' => $user->activation_date, 'disabled' => true]);
            echo $this->Form->input('tos_date', ['placeholder' => $user->tos_date, 'disabled' => true]);
            echo $this->Form->input('active', ['placeholder' => $user->active, 'disabled' => true]);
            echo $this->Form->input('is_superuser', ['placeholder' => $user->is_superuser, 'disabled' => true]);
            echo $this->Form->input('role', ['placeholder' => $user->role, 'disabled' => true]);
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
