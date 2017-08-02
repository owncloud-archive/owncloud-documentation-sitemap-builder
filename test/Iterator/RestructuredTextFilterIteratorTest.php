<?php

namespace OwnCloud\SiteMapBuilderTest\Iterator;

use OwnCloud\SiteMapBuilder\Iterator\RestructuredTextFilterIterator;
use PHPUnit\Framework\TestCase;

/**
 * Class RestructuredTextFilterIteratorTest
 * @package OwnCloud\SiteMapBuilderTest
 */
class RestructuredTextFilterIteratorTest extends TestCase
{
    /**
     * @dataProvider fileIteratorDataProvider
     * @param array $fileData
     */
    public function testFileIterator(array $fileData = [])
    {
        $iterator = new \ArrayIterator($fileData);
        $filter = 'rst';
        $rstIterator = new RestructuredTextFilterIterator($iterator, $filter);

        foreach ($rstIterator as $element) {
            $this->assertTrue(
                (pathinfo($element, PATHINFO_EXTENSION) === $filter),
                'Incorrect file was not filtered out'
            );
        }
    }

    /**
     * @return array
     */
    public function fileIteratorDataProvider()
    {
        return [
            [
                [
                    '/ownCloud/documentation/user_manual/whats_new.rst',
                    '/ownCloud/documentation/user_manual/images/sharepoint-drive-config-user.png',
                    '/ownCloud/documentation/user_manual/images/sharing',
                    '/ownCloud/documentation/user_manual/images/sharing/.',
                    '/ownCloud/documentation/user_manual/images/sharing/..',
                    '/ownCloud/documentation/user_manual/images/sharing/create-drop-folder.png',
                    '/ownCloud/documentation/user_manual/images/sharing/use-drop-folders,.png',
                    '/ownCloud/documentation/user_manual/images/usage_indicator.png',
                    '/ownCloud/documentation/user_manual/images/users-files.png',
                    '/ownCloud/documentation/user_manual/images/users-overlays-sharepoint.png',
                    '/ownCloud/documentation/user_manual/images/users-overlays-win-net-drive.png',
                    '/ownCloud/documentation/user_manual/images/users-overlays.png',
                    '/ownCloud/documentation/user_manual/images/users-share-local.png',
                    '/ownCloud/documentation/user_manual/images/users-share-local2.png',
                    '/ownCloud/documentation/user_manual/images/users-share-public.png',
                    '/ownCloud/documentation/user_manual/images/version_personal_settings.png',
                    '/ownCloud/documentation/user_manual/files/access_webdav.rst',
                    '/ownCloud/documentation/user_manual/files/deleted_file_management.rst',
                    '/ownCloud/documentation/user_manual/files/desktop_mobile_sync.rst',
                    '/ownCloud/documentation/user_manual/files/encrypting_files.rst',
                    '/ownCloud/documentation/user_manual/files/federated_cloud_sharing.rst',
                    '/ownCloud/documentation/user_manual/files/gallery_app.rst',
                    '/ownCloud/documentation/user_manual/files/index.rst',
                    '/ownCloud/documentation/user_manual/files/large_file_upload.rst',
                    '/ownCloud/documentation/user_manual/files/public_link_shares.rst',
                    '/ownCloud/documentation/user_manual/files/troubleshooting.rst',
                    '/ownCloud/documentation/user_manual/files/version_control.rst',
                ]
            ]
        ];
    }
}
