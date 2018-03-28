<?php
class CommentproductsController extends AppController
{
    public $components = array('Library');

    //////////////
    //////////////
    //User
    //////////////
    //////////////
    function send_post()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
                $comment = $this->request->data['comment'];
                $member_id = $this->Session->read('Member.id');
                $product_id = $this->request->data['product_id'];
                $this->Commentproduct->set('member_id', $member_id);
                $this->Commentproduct->set('product_id', $product_id);
                $this->Commentproduct->set('comment', $comment);
                if($this->Commentproduct->save())
                {
                    ClassRegistry::init('Member')->recursive = -1;
                    $member = ClassRegistry::init('Member')->find('first', array(
                        'joins' => array(
                            array(
                                'table' => 'profiles',
                                'alias' => 'Profile',
                                'type' => 'INNER',
                                'foreignKey' => false,
                                'conditions' => 'Member.id = Profile.member_id'
                            )
                        ),
                        'fields' => array('Member.fullname', 'Member.image', 'Profile.admin'),
                        'conditions' => array('Member.id' => $member_id)
                    ));
                    $this->Commentproduct->recursive = -1;
                    $commentproduct = $this->Commentproduct->findById($this->Commentproduct->id);
                    $data = array(
                        'status' => 'success',
                        'comment' => nl2br(htmlentities($commentproduct['Commentproduct']['comment'], ENT_QUOTES, 'UTF-8')),
                        'comment_id' => $commentproduct['Commentproduct']['id'],
                        'created' => $this->Library->time_elapsed_string($commentproduct['Commentproduct']['created']),
                        'fullname' => $member['Member']['fullname'],
                        'image' => $member['Member']['image'],
                        'admin' => $member['Profile']['admin'],

                    );
                    echo json_encode($data);
                }
                else
                {
                    echo json_encode(array('status' => 'fail'));
                }
            }
        }
        else
        {
            echo json_encode(array('status' => 'notSession'));
        }
    }
    function get_comment()
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $limit = 5;
            $page = isset($this->request->data['page'])? $this->request->data['page']: 1;
            $product_id = $this->request->data['product_id'];
            $this->Commentproduct->recursive = -1;
            $sum_remain = $this->Commentproduct->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Commentproduct.member_id = Member.id'
                    ),
                    array(
                        'table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Member.id = Profile.member_id'
                    ),
                ),
                'fields' => array('Commentproduct.id'),
                'conditions' => array('Commentproduct.product_id' => $product_id),
                'limit' => $limit,
                'page' => ($page + 1)
            ));
            $this->Commentproduct->recursive = -1;
            $commentproducts = $this->Commentproduct->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Commentproduct.member_id = Member.id'
                    ),
                    array(
                        'table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Member.id = Profile.member_id'
                    ),
                ),
                'fields' => array(
                    'Member.fullname',
                    'Member.image',
                    'Profile.admin',
                    'Commentproduct.id',
                    'Commentproduct.comment',
                    'Commentproduct.created',
                    'Commentproduct.like',
                ),
                'conditions' => array('Commentproduct.product_id' => $product_id),
                'order' => array('Commentproduct.id' => 'DESC'),
                'limit' => $limit,
                'page' => $page
            ));
            $data = null;
            $i = 0;
            foreach ($commentproducts as $item)
            {
                //Get reply
                ClassRegistry::init('Commentproductreply')->recursive = -1;
                $sum_remain_reply = ClassRegistry::init('Commentproductreply')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'members',
                            'alias' => 'Member',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Commentproductreply.member_id = Member.id'
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'Profile',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Member.id = Profile.member_id'
                        )
                    ),
                    'order' => array('Commentproductreply.id' => 'DESC'),
                    'fields' => array('Commentproductreply.id'),
                    'conditions' => array(
                        'Commentproductreply.comment_product_id' => $item['Commentproduct']['id']
                    ),
                    'limit' => 2,
                    'page' => 2,
                ));
                ClassRegistry::init('Commentproductreply')->recursive = -1;
                $replys = ClassRegistry::init('Commentproductreply')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'members',
                            'alias' => 'Member',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Commentproductreply.member_id = Member.id'
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'Profile',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Member.id = Profile.member_id'
                        )
                    ),
                    'order' => array('Commentproductreply.id' => 'DESC'),
                    'fields' => array(
                        'Member.fullname',
                        'Member.image',
                        'Profile.admin',
                        'Commentproductreply.reply',
                        'Commentproductreply.created',
                        'Commentproductreply.like',
                        'Commentproductreply.id'
                    ),
                    'conditions' => array(
                        'Commentproductreply.comment_product_id' => $item['Commentproduct']['id']
                    ),
//                    'limit' => 2,
                ));
                $data_reply = null;
                $j = 0;
                foreach ($replys as $reply)
                {
                    $data_reply[$j] = array(
                        'reply_id' => $reply['Commentproductreply']['id'],
                        'reply' => nl2br(htmlentities($reply['Commentproductreply']['reply'], ENT_QUOTES, 'UTF-8')),
                        'created' => $this->Library->time_elapsed_string($reply['Commentproductreply']['created']),
                        'like' => $reply['Commentproductreply']['like'],
                        'fullname' => $reply['Member']['fullname'],
                        'image' => $reply['Member']['image'],
                        'admin' => $reply['Profile']['admin']
                    );
                    $j = $j + 1;
                }
                //
                $data[$i] = array(
                    'id' => $item['Commentproduct']['id'],
                    'comment' => nl2br(htmlentities($item['Commentproduct']['comment'], ENT_QUOTES, 'UTF-8')),
                    'created' => $this->Library->time_elapsed_string($item['Commentproduct']['created']),
                    'like' => $item['Commentproduct']['like'],
                    'fullname' => $item['Member']['fullname'],
                    'image' => $item['Member']['image'],
                    'admin' => $item['Profile']['admin'],
                    'reply' => $data_reply,
                    'sum_remain_reply' => count($sum_remain_reply)
                );
                $i = $i + 1;
            }
            echo json_encode(array('data' => $data, 'sum_remain' => count($sum_remain)));
        }
    }
    function like()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            if($this->request->is('post'))
            {
                $comment_id = $this->request->data['comment_id'];
                $this->Commentproduct->recursive = -1;
                if($this->Commentproduct->updateAll(array('Commentproduct.like' => 'Commentproduct.like + 1'), array('Commentproduct.id' => $comment_id)))
                {
                    $this->Commentproduct->recursive = -1;
                    $like = $this->Commentproduct->find('first', array('conditions' => array('id' => $comment_id)));
                    echo json_encode(array(
                        'status' => 'success',
                        'like' => $like['Commentproduct']['like']
                    ));
                }
            }
        }
        else
        {
            echo json_encode(array('status' => 'notSession'));
        }
    }

}