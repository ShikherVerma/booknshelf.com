<?php


namespace App\Http;


class Flash {

    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }

    public function create($title, $message, $level, $key = 'flash_message')
    {
        return session()->flash($key, [
            'title'   => $title,
            'message' => $message,
            'level'   => $level
        ]);
    }

    public function success($title, $message)
    {
        return $this->create($title, $message, 'success');
    }

    public function error($title, $message)
    {
        return $this->create($title, $message, 'error');
    }

}