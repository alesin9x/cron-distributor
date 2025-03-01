<?php
/**
 * @var DatabaseService $dbService
 */

use common\CronDistributorService\CronDistributorService;
use common\DatabaseService\DatabaseService;

require_once "common/bootstrap.php";

$service = new CronDistributorService($dbService);
try {
    echo $service->run();
} catch (Throwable $t) {
    //TODO save log errors
    echo "Internal Error";
}
