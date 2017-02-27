<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunicationsLocalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunicationsLocalesTable Test Case
 */
class CommunicationsLocalesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunicationsLocalesTable
     */
    public $CommunicationsLocales;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.communications_locales',
        'app.communications',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.locales',
        'app.tagged',
        'app.companies_tags',
        'app.locales_tags',
        'app.tags',
        'app.tags_tagged',
        'app.communications_contacts',
        'app.images',
        'app.communications_companies',
        'app.networks',
        'app.companies_networks',
        'app.networks_persons',
        'app.timetables',
        'app.openinghours',
        'app.communications_persons',
        'app.locals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CommunicationsLocales') ? [] : ['className' => 'App\Model\Table\CommunicationsLocalesTable'];
        $this->CommunicationsLocales = TableRegistry::get('CommunicationsLocales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunicationsLocales);

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
