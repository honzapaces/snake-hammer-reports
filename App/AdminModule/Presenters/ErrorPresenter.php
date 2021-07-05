<?php declare(strict_types=1);


namespace App\AdminModule\Presenters;


use App\Model\Exception\BaseException;
use Tracy\ILogger;
use Tracy\Logger;

class ErrorPresenter extends BaseAdminPresenter
{
    private ILogger $logger;

    /**
     * ErrorPresenter constructor.
     * @param ILogger $logger
     */
    public function __construct(ILogger $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }


    public function actionDefault(\Throwable $exception): void
    {
        if ($exception instanceof BaseException) {
            $message = $exception->getMessage();
        } else {
            $message = 'Unexpected error';
        }
        $this->logger->log(Logger::formatMessage($exception), Logger::EXCEPTION);
        $this->sendJson([
            'error' => $message,
        ]);
    }

}