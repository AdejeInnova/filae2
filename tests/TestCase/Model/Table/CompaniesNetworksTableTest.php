<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompaniesNetworksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompaniesNetworksTable Test Case
 */
class CompaniesNetworksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompaniesNetworksTable
     */
    public $CompaniesNetworks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.companies_networks',
        'app.networks',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.roads',
        'app.towns',
        'app.townships',
        'app.cores',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.images',
        'app.communications',
        'app.communications_companies',
        'app.networks_persons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CompaniesNetworks') ? [] : ['className' => 'App\Model\Table\CompaniesNetworksTable'];
        $this->CompaniesNetworks = TableRegistry::get('CompaniesNetworks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompaniesNetworks);

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
