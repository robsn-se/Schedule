<?php
namespace exceptions;

use core\Log;
use Exception;
use Throwable;

class SystemFailure extends Exception
{
    const LOG_NAME = "system_failure";

    protected array $data;

    public function __construct(string $message = "", array $data = [], int $code = 0, ?Throwable $previous = null)
    {
        Log::add($data, self::LOG_NAME);
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

}