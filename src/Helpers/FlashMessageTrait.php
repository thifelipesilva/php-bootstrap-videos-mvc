<?php

namespace APP\Sk8play\Helpers;

trait FlashMessageTrait
{
    private function addErrorMessage(string $errorMessage): void
    {
        $_SESSION['error_message'] = $errorMessage;
    }
}