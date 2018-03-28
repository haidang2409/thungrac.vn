<?php
class RegisterproductsController extends AppController
{

    function register_info()
    {
        $this->autoRender = false;
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Registerproduct->save($this->request->data))
            {
                echo 'success';
            }
            else
            {
                echo 'fail';
            }
        }
    }
}