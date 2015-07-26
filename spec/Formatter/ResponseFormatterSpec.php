<?php

namespace spec\Ikwattro\GuzzleStereo\Formatter;

use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Ikwattro\GuzzleStereo\Formatter\ResponseFormatter');
    }

    function it_should_format_a_response_to_array()
    {
        $response = new Response(200);
        $format = [
            'code' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body' => (string) $response->getBody()
        ];
        $this->formatResponse($response)->shouldEqual($format);
    }

    function it_should_encode_a_responses_collection()
    {
        $response = new Response(200);
        $responses = array($response);
        $format = [
          'code' => $response->getStatusCode(),
          'headers' => $response->getHeaders(),
          'body' => (string) $response->getBody()
        ];
        $formatted = json_encode(array($format), JSON_PRETTY_PRINT);
        $this->encodeResponsesCollection($responses)->shouldEqual($formatted);
    }
}