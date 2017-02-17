<?php
/**
 * Created by PhpStorm.
 * User: Frost Wong <frostwong@gmail.com>
 * Date: 12/12/16
 * Time: 5:22 PM
 */

namespace Spe;


class Env
{
    const DEV = 'dev';
    const TEST = 'test';
    const PROD = 'prod';
    const EMU = 'emu';

    private $envList = [
        self::DEV,
        self::TEST,
        self::PROD,
        self::EMU,
    ];

    /**
     * Current env setting.
     *
     * @var string
     */
    private $currentEnv = 'dev';

    /**
     * Env config path.
     *
     * @var string
     */
    private $envPath;

    /**
     * Env constructor.
     * @param $envList
     * @param $envPath
     * @throws EnvException
     */
    public function __construct($envList = [])
    {
        if (defined('WEB_ROOT')) {
            $defaultEnvFile = WEB_ROOT . '/env';
            if (file_exists($defaultEnvFile)) {
                $this->envPath = $defaultEnvFile;
            }
        } else {
            $this->envPath = getenv('DOCUMENT_ROOT') . '/env';
        }

        if (!file_exists($this->envPath)) {
            throw new EnvException('No env file exists, please check again');
        }

        if (!empty($envList)) {
            $this->envList = $envList;
        }

        $this->currentEnv = trim(file_get_contents($this->envPath));
        if (!in_array($this->currentEnv, $this->envList, true)) {
            throw new EnvException('String inside ' . $this->envPath . ' must be element of ' . json_encode($this->envList));
        }
    }

    /**
     * Get the current env setting.
     *
     * @return string
     */
    public function get()
    {
        return $this->currentEnv;
    }

    /**
     * Set temporary env config.
     *
     * @param $env
     * @throws EnvException
     */
    public function set($env)
    {
        if (!in_array($env, $this->envList, true)) {
            throw new EnvException('Env must be element of ' . json_encode($this->envList) . ', ' . $env . ' is given');
        }

        $this->currentEnv = $env;
    }
}