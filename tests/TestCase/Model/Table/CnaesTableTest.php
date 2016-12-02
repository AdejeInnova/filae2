<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CnaesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CnaesTable Test Case
 */
class CnaesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CnaesTable
     */
    public $Cnaes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cnaes',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.roads',
        'app.towns',
        'app.townships',
        'app.cores',
        'app.sedes',
        'app.contacts',
        'app.images',
        'app.communications',
        'app.communications_companies',
        'app.networks',
        'app.companies_networks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cnaes') ? [] : ['className' => 'App\Model\Table\CnaesTable'];
        $this->Cnaes = TableRegistry::get('Cnaes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cnaes);

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
