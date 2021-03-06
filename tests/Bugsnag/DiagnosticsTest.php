<?php

class DiagnosticsTest extends PHPUnit_Framework_TestCase
{
    /** @var Bugsnag_Configuration */
    protected $config;
    /** @var Bugsnag_Diagnostics */
    protected $diagnostics;

    protected function setUp()
    {
        $this->config = new Bugsnag_Configuration();
        $this->diagnostics = new Bugsnag_Diagnostics($this->config);
    }

    public function testDefaultAppData()
    {
        $this->config->releaseStage = 'qa1';
        $this->config->appVersion = '1.2.3';
        $this->config->type = 'laravel';

        $appData = $this->diagnostics->getAppData();

        $this->assertSame($appData['releaseStage'], 'qa1');
        $this->assertSame($appData['version'], '1.2.3');
        $this->assertSame($appData['type'], 'laravel');
    }

    public function testDefaultDeviceData()
    {
        $this->config->hostname = 'web1.example.com';

        $deviceData = $this->diagnostics->getDeviceData();

        $this->assertSame($deviceData['hostname'], 'web1.example.com');
    }

    public function testDefaultContext()
    {
        $this->config->context = 'herp#derp';
        $this->assertSame($this->diagnostics->getContext(), 'herp#derp');
    }

    public function testDefaultUser()
    {
        $this->config->user = array('id' => 123, 'email' => 'test@email.com', 'name' => 'Bob Hoskins');

        $userData = $this->diagnostics->getUser();

        $this->assertSame($userData['id'], 123);
        $this->assertSame($userData['email'], 'test@email.com');
        $this->assertSame($userData['name'], 'Bob Hoskins');
    }
}
