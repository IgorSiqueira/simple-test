<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait HttpResponse
{
  private $response;

  private $cacheHeaders = [];

  /** @var array $cookies An array that contains the default cookies that can sent in the request */
  private $cookies = [];

  /**
   * Defines settings and options for the response.
   *
   * @param mixed $responseData The data that will be sent in the response. 
   * @param int $statusCode The HTTP status code that will be applied in the reponse.
   * @param array $headers An array containing the headers that will be merged in the default headers.
   * @param array<array> $cookies A multidimensional array containing the cookies that will be sent in the response. Structure [['name' => string, 'value' => string, 'time' => int]]
   * 
   * @return Response
   * 
   * @since 13/07/2022
   * 
   * @version 1.0
   **/
  public function sendResponse(int $statusCode = 200, mixed $responseData = [], array $headers = [], array $cookies = [])
  {
    $this->response = new Response();

    $this->prepare($responseData, $statusCode, $headers, $cookies);

    return $this->response;
  }

  /**
   * Defines settings and options for the response.
   *
   * @param mixed $responseData The data that will be sent in the response. 
   * @param int $statusCode The HTTP status code that will be applied in the reponse.
   * @param array $headers An array containing the headers that will be merged in the default headers.
   * @param array<array> $cookies A multidimensional array containing the cookies that will be sent in the response. Structure [['name' => string, 'value' => string, 'time' => int]]
   * 
   * @return void
   * 
   * @since 13/07/2022
   * 
   * @version 1.0
   **/
  public function prepare(mixed $responseData, int $statusCode, array $headers = [], array $cookies = [])
  {
    $this->setHeaders($headers);
    $this->setCookies($cookies);
    $this->response->setStatusCode($statusCode);

    if ($statusCode > 400 && !$responseData) {
      $this->response->setContent(['message' => __("http_status_code.$statusCode")]);
    } else {
      $this->response->setContent($responseData);
    }
  }

  /**
   * Set the cookies that will be applied in the response.
   *
   * @param array $cookies An array where each index has an array containing the fields name (cookie name), value (cookie value) and a time field (cookie lifetime, if none provided the cookie will live for 1 hour).
   * 
   * @return void
   * 
   * @since 13/07/2022
   * 
   * @version 1.0
   **/
  private function setCookies(array $cookies): void
  {
    $cookies = array_merge($this->cookies, $cookies);

    foreach ($cookies as $cookie) {
      $this->response->headers->setCookie(cookie($cookie['name'], $cookie['value'], $cookie['time'] ?: 60));
    }
  }

  /**
   * Add given headers in the response object.
   *
   * @param array<array> $headers An array containing the name of header and his respective value. 
   * 
   * @return void
   * 
   * @since 13/07/2022
   * 
   * @version 1.0
   **/
  private function setHeaders(array $headers): void
  {
    if (request()->isMethodCacheable()) {
      foreach ($this->cacheHeaders as $directive => $value) {
        $this->response->headers->addCacheControlDirective($directive, $value);
      }
    }

    $this->response->headers->add($headers);
  }
}
