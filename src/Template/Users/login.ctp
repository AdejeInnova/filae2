<!-- File: src/Template/Users/login.ctp -->

<?= $this->Form->create() ?>
<?= $this->Form->input('email') ?>
<?= $this->Form->input('password', ['type' => 'password']) ?>
<?= $this->Form->submit(__('Login')); ?>
<?= $this->Form->end() ?>
