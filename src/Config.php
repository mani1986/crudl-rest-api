<?php
/**
 * The Config file.
 */
namespace mani\blog;

/**
 * Class Config
 *
 * @package mani\blog
 */
class Config
{
    /**
     * Configuration keys.
     */
    const PRE_PROCESSOR = 'preProcessor';
    const POST_PROCESSOR = 'postProcessor';
    const PERSISTENCE = 'persistence';
    const PERSISTENCE_OBJECT = 'object';
    const PERSISTENCE_LOCATION = 'location';
    const ENVIRONMENT = 'environment';
    const ENVIRONMENT_DEVELOPMENT = 0;
    const ENVIRONMENT_PRODUCTION = 1;

    /**
     * Constructor.
     */
    public static function get()
    {
        return [
            self::ENVIRONMENT => self::ENVIRONMENT_DEVELOPMENT,
            self::PERSISTENCE => [
                self::PERSISTENCE_OBJECT => 'mani\\blog\\persistence\\FilesystemJson',
                self::PERSISTENCE_LOCATION => 'data.json'
            ],
            self::PRE_PROCESSOR => 'mani\\blog\\processor\\PreProcessorJson',
            self::POST_PROCESSOR => 'mani\\blog\\processor\\PostProcessorJson'
        ];
    }
}
