<?php

namespace WirklichDigital\SystemModuleOverview\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\Http\Request;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Symfony\Component\Filesystem\Path;
use WirklichDigital\SystemModuleOverview\Service\SysModOverviewService;

use function http_response_code;
use function json_decode;
use function json_last_error;

use const JSON_ERROR_NONE;

class IndexController extends AbstractActionController
{
    public function __construct(
        protected EntityManager $entityManager,
        protected SysModOverviewService $sysModOverviewService,
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
            $data = json_decode($postData, true);
            if (! $data || json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(500);
                return new JsonModel([
                    'status' => 'error',
                    'message' => 'Invalid JSON data',
                ]);
            }
            
            // Save data to file for cronjob processing
            $this->putDataInFile($data);
            
            return new JsonModel([
                'status' => 'success',
                'message' => 'Data saved successfully for processing'
            ]);
        }

        return new JsonModel([
            'status' => 'error',
            'message' => 'Invalid request method'
        ]);
    }

    private function putDataInFile(array $data)
    {
        $path = "data/sysmoddatas/systems";
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }
        
        if (! is_writable($path)) {
            error_log("Warning: Directory '$path' is not writable");
            return;
        }
        
        $ipaddress = $data["ipaddress"] ?? "unknown";
        $systemName = $data["j77Config"]["name"] ?? "laminassystem";
        $jsonData = json_encode($data);
        
        $systemPath = Path::join($path, "$systemName-($ipaddress).json");
        file_put_contents($systemPath, $jsonData);
    }
}
