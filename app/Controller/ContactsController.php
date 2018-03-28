<?php
class ContactsController extends AppController
{
    function add_contact()
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            if($this->Contact->save($this->request->data))
            {
                $this->Session->setFlash('Cảm ơn bạn đã gửi thông tin, chúng tôi sẽ liên hệ lại bạn trong thời gian sớm nhất', 'flashSuccess');
                echo json_encode(array('status' => true));
            }
            else
            {
                $this->Session->setFlash('Lỗi. Vui lòng thử lại sau', 'flashError');
                echo json_encode(array('status' => false));
            }
        }
    }
}