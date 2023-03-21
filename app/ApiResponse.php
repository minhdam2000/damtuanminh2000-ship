<?php
namespace App;

class ApiResponse{
    public static function ok($message = 'Ok'){
        if(!\is_string($message)){
            $message = json_encode($message);
        }
        return \response($message, 200)->header('Content-Type', 'text/plain');
    }

    public static function badRequest($message = 'Bad request'){
        if(!\is_string($message)){
            $message = json_encode($message);
        }
        return \response($message, 400)->header('Content-Type', 'text/plain');
    }

    public static function accessDeneid($message = 'You are not permission'){
        if(!\is_string($message)){
            $message = json_encode($message);
        }
        return \response($message, 401)->header('Content-Type', 'text/plain');
    }

    public static function unauthorize($message = 'Unauthorize'){
        if(!\is_string($message)){
            $message = json_encode($message);
        }
        return \response($message, 401)->header('Content-Type', 'text/plain');
    }

    public static function notfound($message = 'Not found'){
        if(!\is_string($message)){
            $message = json_encode($message);
        }
        return \response($message, 404)->header('Content-Type', 'text/plain');
    }

    public static function internalServerError($message = 'Internal server error'){
        if(!\is_string($message)){
            $message = json_encode($message);
        }
        return \response($message, 500)->header('Content-Type', 'text/plain');
    }
}