<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimetablesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimetablesTable Test Case
 */
class TimetablesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimetablesTable
     */
    public $Timetables;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.timetables',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.images',
        'app.communications',
        'app.communications_companies',
        'app.communications_persons',
        'app.contacts_communications',
        'app.networks',
        'app.companies_networks',
        'app.networks_persons',
        'app.tagged',
        'app.companies_tags',
        'app.tags',
        'app.tags_tagged',
        'app.openinghours'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Timetables') ? [] : ['className' => 'App\Model\Table\TimetablesTable'];
        $this->Timetables = TableRegistry::get('Timetables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Timetables);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
