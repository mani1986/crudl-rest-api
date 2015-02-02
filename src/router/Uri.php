<?php
/**
 * The Uri file.
 */
namespace mani\blog\router;

/**
 * Class Uri
 *
 * @package mani\blog\router
 */
class Uri
{
    /**
     * Uri property constants.
     */
    const URI_SCHEME = 'scheme';
    const URI_HOST = 'host';
    const URI_PORT = 'port';
    const URI_USER = 'user';
    const URI_PASS = 'pass';
    const URI_PATH = 'path';
    const URI_QUERY = 'query';
    const URI_FRAGMENT = 'fragment';

    /**
     * URI path separator.
     */
    const PATH_SEPARATOR = '/';

    /**
     * @var string The scheme, e.g. http or https.
     */
    protected $scheme;

    /**
     * @var string The hostname, e.g. yolo.com.
     */
    protected $host;

    /**
     * @var string The port if specified, e.g. 80.
     */
    protected $port;

    /**
     * @var string The user if specified.
     */
    protected $user;

    /**
     * @var string The password if specified.
     */
    protected $password;

    /**
     * @var array The path. e.g. /payment
     */
    protected $path;

    /**
     * @var int The current part index.
     */
    protected $pathPartIndex;

    /**
     * @var string The query e.g. ?id=10.
     */
    protected $query;

    /**
     * @var string The fragment after the number sign, hashtag, octothorp.
     */
    protected $fragment;

    /**
     * Uri constructor.
     *
     * @param $uri
     */
    public function __construct($uri)
    {
        $uriParts = parse_url($uri);

        if (isset($uriParts[self::URI_SCHEME])) {
            $this->scheme = $uriParts[self::URI_SCHEME];
        }

        if (isset($uriParts[self::URI_HOST])) {
            $this->host = $uriParts[self::URI_HOST];
        }

        if (isset($uriParts[self::URI_PORT])) {
            $this->port = $uriParts[self::URI_PORT];
        }

        if (isset($uriParts[self::URI_USER])) {
            $this->user = $uriParts[self::URI_USER];
        }

        if (isset($uriParts[self::URI_PASS])) {
            $this->password = $uriParts[self::URI_PASS];
        }

        if (isset($uriParts[self::URI_PATH])) {
            $this->path = explode('/', substr($uriParts[self::URI_PATH], 1));
        }

        if (isset($uriParts[self::URI_QUERY])) {
            $this->query = $uriParts[self::URI_QUERY];
        }

        if (isset($uriParts[self::URI_FRAGMENT])) {
            $this->fragment = $uriParts[self::URI_FRAGMENT];
        }

        $this->pathPartIndex = 0;
    }

    /**
     * Get the full path.
     *
     * @return string   The full path as a string with '/' between parts.
     */
    public function getPath()
    {
        return self::PATH_SEPARATOR . implode(self::PATH_SEPARATOR, $this->path);
    }

    /**
     * Get the next path part.
     *
     * @return bool|string
     */
    public function getPathPart()
    {
        if (isset($this->path[$this->pathPartIndex])) {
            $this->pathPartIndex++;

            return $this->path[$this->pathPartIndex-1];
        }

        return false;
    }

    /**
     * Reset the path part, set the index to 0 and start over.
     */
    public function resetPathPart()
    {
        $this->pathPartIndex = 0;
    }

    /**
     * Get the query string as it was included in the path.
     *
     * @return string  The query string.
     */
    public function getQueryString()
    {
        return $this->query;
    }
} 