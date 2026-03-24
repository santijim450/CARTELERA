<?php

class ProblemDetailsException extends Exception {
    private array $problemDetails;

    public function __construct(array $problemDetails) {

        $status = $problemDetails['status'] ?? 500;

        parent::__construct($problemDetails['title'] ?? 'Error', $status);
        $this->problemDetails = $problemDetails;
    }

    public function getProblemDetails(): array {
        return $this->problemDetails;
    }
}