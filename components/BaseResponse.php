<?php

namespace app\components;

class BaseResponse
{
    const MSG_OK = 'ok';
    const MSG_NO_DATA = 'no data';
    const MSG_WRONG_INPUT = 'wrong input data';
    const MSG_UNKNOWN_ERROR = 'Internal Server Error';
    const MSG_METHOD_NOT_FOUND = 'unknown method';
    const MSG_AUTHEN_REQUIRE = 'Network Authentication Required';
    const MSG_UNAUTHORIZED = 'Unauthorized';
    const MSG_BAD_REQUEST = "Bad Request";
    const MSG_BAD_GATEWAY = "Bad gateway";
    const MSG_CREATED = 'Created';
    const MSG_UPDATED = 'Updated';
    const MSG_DELETED = 'Deleted';
    const MSG_NOT_IMPLEMENT = 'Not Implemented';
    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_ERROR = 500;
    const CODE_NOT_IMPLEMENT = 501;
    const CODE_BAD_GATEWAY = 502;
    const CODE_BAD_REQUEST = 400;
    const CODE_NOT_FOUND = 404;
    const CODE_UNAUTHORIZED = 401;
    const CODE_AUTHEN_REQUIRE = 511;

    private $code;
    private $status;
    private $data;
    private $message;

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    public function __get($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : '';
    }
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
    public function __unset($name)
    {
        if (isset($this->data[$name])) {
            unset($this->data[$name]);
        }
    }
    public function setCode($code, $message, $status)
    {
        $this->code = $code;
        $this->message = $message;
        $this->status = $status;
    }


    public function send($withHeader = true)
    {
        match ((int) $this->code) {
            self::CODE_NOT_FOUND => header("HTTP/1.0 404 Not Found"),
            self::CODE_NOT_IMPLEMENT => header("HTTP/1.0 501 Not Implemented"),
            self::CODE_ERROR =>  header('HTTP/1.0 500 Internal Error'),
            self::CODE_OK =>  header('HTTP/1.0 200 OK'),
            self::CODE_CREATED => header('HTTP/1.0 201 Created'),
            default => 'unknow'
        };

        $array = array(
            'message' => $this->message,
            //'code' => $this->code,
            'status' => $this->status,
        );

        if ($withHeader) {
            $array = [
                'message' => $this->message,
                //'code' => $this->code,
                'status' => $this->status,
            ];

            if (!empty($this->data)) {
                $array = array_merge($array, $this->data);
            }

            return $array;
        }

        if (!empty($this->data)) {
            $array = array_merge($array, array('data' => $this->data));
        }

        return $this->data;
    }
}
