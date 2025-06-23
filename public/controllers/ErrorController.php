<?php

//Tento kontroler funguje jako směrovač na errorový pohled
class ErrorController extends Controller {
    public function process(array $params): void {
        //Header request
        header("HTTP/1.0 404 Not Found");
        //Header web
        $this->header['title'] = 'Error 404';
        //View config
        $this->view = 'error';
    }
}
