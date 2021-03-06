<?php

namespace AlibabaCloud\Tests\Feature;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Dbs\Dbs;
use AlibabaCloud\Dbs\V20190306\StartBackupPlan;
use PHPUnit\Framework\TestCase;

/**
 * Class DbsTest
 *
 * @package   AlibabaCloud\Tests\Feature
 */
class DbsTest extends TestCase
{
    /**
     * @throws ClientException
     */
    public function setUp()
    {
        parent::setUp();

        AlibabaCloud::accessKeyClient(
            \getenv('ACCESS_KEY_ID'),
            \getenv('ACCESS_KEY_SECRET')
        )->regionId('cn-shanghai')->asDefaultClient();
    }

    public function testVersionResolve()
    {
        $request1 = AlibabaCloud::dbs()
                                ->v20190306()
                                ->startBackupPlan()
                                ->host('dbs-api.cn-hangzhou.aliyuncs.com')
                                ->withBackupPlanId('id')
                                ->withOwnerId('id')
                                ->connectTimeout(60)
                                ->timeout(65);

        $request2 = Dbs::v20190306()
                       ->startBackupPlan()
                       ->host('dbs-api.cn-hangzhou.aliyuncs.com')
                       ->withBackupPlanId('id')
                       ->withOwnerId('id')
                       ->connectTimeout(60)
                       ->timeout(65);

        self::assertInstanceOf(StartBackupPlan::class, $request1);
        self::assertInstanceOf(StartBackupPlan::class, $request2);
        self::assertEquals($request1, $request2);
    }
}
