<?php

namespace OwnCloud\SiteMapBuilder;

use OwnCloud\SiteMapBuilder\Iterator\RestructuredTextFilterIterator;
use Refinery29\Sitemap\Component;
use Refinery29\Sitemap\Writer;

/**
 * Class SitemapBuilder
 * @package OwnCloud\SiteMapBuilder
 */
class SitemapBuilder
{
    const BASE_PATH = 'https://doc.owncloud.com/server';
    const PRIORITY = 0.8;
    const VERSION = '10.0';

    /**
     * @var string
     */
    private $basePath;

    /**
     * @var string
     */
    private $version;

    /**
     * @var float
     */
    private $priority;

    /**
     * SitemapBuilder constructor.
     * @param string $basePath
     * @param string $version
     * @param string $priority
     */
    public function __construct($basePath = self::BASE_PATH, $version = self::VERSION, $priority = self::PRIORITY)
    {
        $this->basePath = $basePath;
        $this->version = $version;
        $this->priority = $priority;
    }

    /**
     * Build a list of URLs from the files of the required filetype retrieved
     * @param string $path
     * @param string $extension
     * @return array
     */
    public function getFileList($path, $extension)
    {
        // retrieve a filtered list of file names, based on the specified extension.
        $iterator = new RestructuredTextFilterIterator(new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::CURRENT_AS_PATHNAME)
        ), $extension);
        $files = [];

        foreach($iterator as $file) {
            $filename = str_replace(
                ['\\', '.rst'],
                ['/', '.html'],
                preg_replace(
                    '/.*(?=user_manual|admin_manual|developer_manual)/',
                    '',
                    $file
                )
            );
            $files[] = sprintf('%s/%s/%s', $this->basePath, $this->version, $filename);
        }

        return $files;
    }

    /**
     * Generated a valid sitemap.xml string from the list of files supplied
     * @param array $fileList
     * @return string
     */
    public function generateSiteMapXml($fileList)
    {
        $urlList = [];

        foreach ($fileList as $file) {
            $url = new Component\Url($file);
            $urlList[] = $url
                ->withLastModified(new \DateTime())
                ->withChangeFrequency(Component\Url::CHANGE_FREQUENCY_WEEKLY)
                ->withPriority($this->priority)
            ;
        }

        $urlSetWriter = new Writer\UrlSetWriter();

        return $urlSetWriter->write(new Component\UrlSet($urlList));
    }
}
