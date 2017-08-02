<?php

namespace OwnCloud\SiteMapBuilderTest;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use OwnCloud\SiteMapBuilder\SitemapBuilder;

/**
 * Class SitemapBuilderTest
 * @package OwnCloud\SiteMapBuilderTest
 */
class SitemapBuilderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var array|\Traversable
     */
    private $fileList;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    public function setUp()
    {
        $this->fileList = [
            'ownCloud' => [
                'documentation' => [
                    'user_manual' => [
                        'whats_new.rst' => 'content',
                        'files' => [
                            'access_webdav.rst' => 'content',
                            'deleted_file_management.rst' => 'content',
                            'desktop_mobile_sync.rst' => 'content',
                            'encrypting_files.rst' => 'content',
                            'federated_cloud_sharing.rst' => 'content',
                            'gallery_app.rst' => 'content',
                            'index.rst' => 'content',
                            'large_file_upload.rst' => 'content',
                            'public_link_shares.rst' => 'content',
                            'troubleshooting.rst' => 'content',
                            'version_control.rst' => 'content',
                            'version_control.png' => 'content',
                            'version_control.jpg' => 'content',
                        ],
                        'images' => [
                            'an_image.png' => 'content',
                            'another_image.jpg' => 'content',
                        ]
                    ]
                ]
            ]

        ];
        $this->root = vfsStream::setup('root', 755, $this->fileList);
    }

    public function testCanBuildFileListSuccessfuly()
    {
        $builder = new SitemapBuilder();
        $matchingFiles = [
            'https://doc.owncloud.com/server/10.0/user_manual/whats_new.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/access_webdav.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/deleted_file_management.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/desktop_mobile_sync.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/encrypting_files.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/federated_cloud_sharing.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/gallery_app.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/index.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/large_file_upload.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/public_link_shares.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/troubleshooting.html',
            'https://doc.owncloud.com/server/10.0/user_manual/files/version_control.html',
        ];

        $files = $builder->getFileList(vfsStream::url('root/ownCloud/documentation'), 'rst');
        $this->assertSame($matchingFiles, $files, "Expected a different set of matching files");
    }

    public function testCanBuildSitemapCorrectly()
    {
        $changeFreq = 0.6;
        $builder = new SitemapBuilder('https://doc.owncloud.com/server', '10.0', $changeFreq);

        $testSitemapXml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/whats_new.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/access_webdav.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/deleted_file_management.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/desktop_mobile_sync.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/encrypting_files.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/federated_cloud_sharing.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/gallery_app.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/index.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/large_file_upload.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/public_link_shares.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/troubleshooting.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
  <url>
    <loc>https://doc.owncloud.com/server/10.0/user_manual/files/version_control.html</loc>
    <lastmod>%1$s</lastmod>
    <changefreq>weekly</changefreq>
    <priority>%2$s</priority>
  </url>
</urlset>';

        $generatedSitemapXml = $builder->generateSiteMapXml(
            $builder->getFileList(vfsStream::url('root/ownCloud/documentation'), 'rst')
        );

        // Format the generated output so that it's easier to test against
        $dom = new \DOMDocument;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($generatedSitemapXml);
        $dom->formatOutput = true;

        $this->assertSame(
            sprintf($testSitemapXml, (new \DateTime())->format(\DateTime::W3C), $changeFreq),
            trim($dom->saveXml())
        );
    }
}
