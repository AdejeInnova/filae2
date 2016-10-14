<?php
use Migrations\AbstractMigration;

class ChangeRoleUsersColumn extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $users = $this->table('users');
        $users->changeColumn('role', 'string', array('limit' => 255, 'default' => 'Usuario'))
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }

}
