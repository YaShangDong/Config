<?php

declare(strict_types=1);

namespace YaSD\Config;

use Nette\Schema\Processor;
use Nette\Schema\Schema;
use Noodlehaus\Config;

abstract class AbstractConfig
{
    /**
     * @var string|string[]
     */
    private string | array $files;

    private Config $config;

    private Processor $processor;

    /**
     * @param string|string[]
     */
    public function __construct(string | array $configFiles)
    {
        $this->files = $configFiles;
        $this->config = Config::load($configFiles);
        $this->processor = new Processor();
    }

    /**
     * @return $this
     */
    public function reload(): static
    {
        $this->config = Config::load($this->files);
        return $this;
    }

    public function get(string $key, Schema $schema = null)
    {
        $value = $this->config->get($key);
        if ($schema) $value = $this->processor->process($schema, $value);
        return $value;
    }
}
