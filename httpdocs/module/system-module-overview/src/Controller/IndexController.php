<?php

namespace WirklichDigital\SystemModuleOverview\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\Http\Request;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Symfony\Component\Filesystem\Path;
use WirklichDigital\SystemModuleOverview\Service\LaminasSystemLogService;
use WirklichDigital\SystemModuleOverview\Service\SysModOverviewService;

use function basename;
use function file_put_contents;
use function http_response_code;
use function is_dir;
use function is_writable;
use function json_decode;
use function json_encode;
use function json_last_error;
use function mkdir;
use function sprintf;
use function str_replace;
use function uniqid;

use const JSON_ERROR_NONE;

class IndexController extends AbstractActionController
{
    private const SYSTEMS_DIR = 'data/sysmoddatas/systems';

    public function __construct(
        protected EntityManager $entityManager,
        protected SysModOverviewService $sysModOverviewService,
        protected LaminasSystemLogService $logService,
    ) {
    }

    private function request()
    {
        return $this->getRequest();
    }

    public function receiveSystemInfosAction()
    {
        /** @var Request $request*/
        $request = $this->request();

        if ($request->isPost()) {
            $postData = $request->getContent();
            $data     = json_decode($postData, true);
            if (! $data || json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(500);
                return new JsonModel([
                    'status'  => 'error',
                    'message' => 'Invalid JSON data',
                ]);
            }

            // Save data to file for cronjob processing
            $this->putDataInFile($data);

            return new JsonModel([
                'status'  => 'success',
                'message' => 'Data saved successfully for processing',
            ]);
        }

        return new JsonModel([
            'status'  => 'error',
            'message' => 'Invalid request method',
        ]);
    }

    private function putDataInFile(array $data)
    {
        $path = self::SYSTEMS_DIR;
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        if (! is_writable($path)) {
            $this->logService->warning(
                "Directory '$path' is not writable",
                'IndexController::putDataInFile'
            );
            return;
        }

        // IP address is required for proper system identification
        if (! isset($data["ipaddress"]) || empty($data["ipaddress"])) {
            $this->logService->warning(
                "Missing IP address in received data, using unique identifier",
                'IndexController::putDataInFile'
            );
            $ipaddress = "no-ip-" . uniqid();
        } else {
            // Sanitize IP address for filename safety
            $ipaddress = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $data["ipaddress"]);
        }

        // Get system name with fallback
        $systemName = $data["j77Config"]["name"] ?? "laminassystem";
        // Sanitize system name for filename safety
        $systemName = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $systemName);

        $jsonData = json_encode($data);

        $systemPath = Path::join($path, "$systemName-($ipaddress).json");
        file_put_contents($systemPath, $jsonData);

        $this->logService->info(
            sprintf("Saved data file '%s' for processing", basename($systemPath)),
            'IndexController::putDataInFile'
        );
    }
}
