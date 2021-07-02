<?php declare(strict_types=1);


namespace App\Model\Bootstrap;


use Nette\Application\Application;
use Nette\Bootstrap\Configurator;
use Nette\DI\Container;

class Bootstrapper
{
    private bool $debugMode;
    private string $configFile;
    private string $tempDir;
    private string $logDir;
    private string $logEmail;

    /**
     * Bootstrapper constructor.
     * @param bool   $debugMode
     * @param string $configFile
     * @param string $tempDir
     * @param string $logDir
     * @param string $logEmail
     */
    public function __construct(bool $debugMode, string $configFile, string $tempDir, string $logDir, string $logEmail)
    {
        $this->debugMode = $debugMode;
        $this->configFile = $configFile;
        $this->tempDir = $tempDir;
        $this->logDir = $logDir;
        $this->logEmail = $logEmail;
    }


    public function build(): Container
    {
        $configurator = new Configurator();
        $configurator->addConfig($this->configFile);
        $configurator->addParameters([
            'appDir' => __DIR__ . '/../../../App',
        ]);
        $configurator->setTempDirectory($this->tempDir);
        $configurator->setDebugMode($this->debugMode);
        $configurator->enableDebugger($this->logDir, $this->logEmail);
        return $configurator->createContainer();
    }

    public function run(): int
    {
        $container = $this->build();
        $container->getByType(Application::class)->run();
        return 0;
    }

}