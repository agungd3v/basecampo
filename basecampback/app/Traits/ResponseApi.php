<?php

namespace App\Traits;

trait ResponseApi {
  protected $message, $data, $status, $status_code;

  public function setMessage($value) {
    $this->message = $value;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setData($value) {
    $this->data = $value;
  }

  public function getData() {
    return $this->data;
  }

  public function setStatus($value) {
    $this->status = $value;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setStatusCode($value) {
    $this->status_code = $value;
  }

  public function getStatusCode() {
    return $this->status_code;
  }

  public function success() {
    $this->setStatus(true);
    $this->setStatusCode(200);
    return $this->response();
  }

  public function error() {
    $this->setStatusCode(500);
    $this->setStatus(false);
    return $this->response();
  }

  public function response() {
    return response()->json([
        'status' => $this->getStatus(),
        'code' => $this->getStatusCode(),
        'message' => $this->getMessage(),
        'data' => $this->getData()
      ], $this->getStatusCode());
  }
}