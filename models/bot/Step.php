<?php
namespace models\bot;

use models\bot\triggers\ButtonTrigger;
use models\MainModel;

class Step extends MainModel
{
    protected string $text;

    protected array $buttonTriggers;

    protected string $uid;

    protected ?string $storageVariable = null;

    protected ?string $textTrigger = null;

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid(string $uid): void
    {
        $this->uid = $uid;
    }

    public function __construct(string $uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return ButtonTrigger[]
     */
    public function getButtonTriggers(): array
    {
        return $this->buttonTriggers;
    }

    /**
     * @param ButtonTrigger[] $buttonTriggers
     */
    public function setButtonTriggers(array $buttonTriggers): void
    {
        $this->buttonTriggers = $buttonTriggers;
    }

    public function getStorageVariable(): ?string
    {
        return $this->storageVariable;
    }

    public function setStorageVariable(?string $storageVariable): void
    {
        $this->storageVariable = $storageVariable;
    }

    public function getTextTrigger(): ?string
    {
        return $this->textTrigger;
    }

    public function setTextTrigger(?string $textTrigger): void
    {
        $this->textTrigger = $textTrigger;
    }
}