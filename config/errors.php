<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/8
 * Time: 17:13
 */

return array(
    'bad_request' => array(
        'title' => '未能处理的客户端请求',
        'detail' => '您的请求错误，请再次尝试'
    ),
    'forbidden' => array(
        'title' => '服务器拒绝了响应',
        'detail' => '有效的请求，可能您需要认证或者联系管理员确认您是否有访问权限'
    ),
    'not_found' => array(
        'title' => '请求的资源未能发现',
        'detail' => '请求的资源未能发现，请确认您的请求是否正确或稍后再试'
    ),
//    'bad_request' => [
//        'title'  => 'The server cannot or will not process the request due to something that is perceived to be a client error.',
//        'detail' => 'Your request had an error. Please try again.'
//    ],
//
//    'forbidden' => [
//        'title'  => 'The request was a valid request, but the server is refusing to respond to it.',
//        'detail' => 'Your request was valid, but you are not authorised to perform that action.'
//    ],
//
//    'not_found' => [
//        'title'  => 'The requested resource could not be found but may be available again in the future. Subsequent requests by the client are permissible.',
//        'detail' => 'The resource you were looking for was not found.'
//    ],
//
//    'precondition_failed' => [
//        'title'  => 'The server does not meet one of the preconditions that the requester put on the request.',
//        'detail' => 'Your request did not satisfy the required preconditions.'
//    ]

);