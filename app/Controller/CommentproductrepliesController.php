<?php
class CommentproductrepliesController extends AppController
{
    public $components = array('Library');

    //////////////
    //////////////
    //User
    //////////////
    //////////////
    function send_reply()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
                $reply = $this->request->data['reply'];
                $member_id = $this->Session->read('Member.id');
                $id = $this->request->data['id'];
                $this->Commentproductreply->set('member_id', $member_id);
                $this->Commentproductreply->set('comment_product_id', $id);
                $this->Commentproductreply->set('reply', $reply);
                if($this->Commentproductreply->save())
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
                    $this->Commentproductreply->recursive = -1;
                    $replypost = $this->Commentproductreply->findById($this->Commentproductreply->id);
                    $data = array(
                        'status' => 'success',
                        'reply' => nl2br(htmlentities($replypost['Commentproductreply']['reply'], ENT_QUOTES, 'UTF-8')),
                        'reply_id' => $replypost['Commentproductreply']['id'],
                        'created' => $this->Library->time_elapsed_string($replypost['Commentproductreply']['created']),
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
            $this->Commentpost->recursive = -1;
            $post_id = $this->request->data['post_id'];
            $commentposts = $this->Commentpost->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Commentpost.member_id = Member.id'
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
                    'Commentpost.id',
                    'Commentpost.comment',
                    'Commentpost.created',
                    'Commentpost.like',
                ),
                'conditions' => array('Commentpost.post_id' => $post_id),
                'order' => array('Commentpost.id' => 'DESC')
            ));
            $data = null;
            $i = 0;
            foreach ($commentposts as $item)
            {
                //Get reply
                ClassRegistry::init('Commentpostreply')->recursive = -1;
                $replys = ClassRegistry::init('Commentpostreply')->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'members',
                            'alias' => 'Member',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Commentpostreply.member_id = Member.id'
                        ),
                        array(
                            'table' => 'profiles',
                            'alias' => 'Profile',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Member.id = Profile.member_id'
                        )
                    ),
                    'order' => array('Commentpostreply.id' => 'DESC'),
                    'fields' => array(
                        'Member.fullname',
                        'Member.image',
                        'Profile.admin',
                        'Commentpostreply.reply',
                        'Commentpostreply.created',
                        'Commentpostreply.like'
                    ),
                    'conditions' => array(
                        'Commentpostreply.comment_post_id' => $item['Commentpost']['id']
                    )
                ));
                $data_reply = null;
                $j = 0;
                foreach ($replys as $reply)
                {
                    $data_reply[$j] = array(
                        'reply' => nl2br(htmlentities($reply['Commentpostreply']['reply'], ENT_QUOTES, 'UTF-8')),
                        'created' => $this->Library->time_elapsed_string($reply['Commentpostreply']['created']),
                        'like' => $reply['Commentpostreply']['like'],
                        'fullname' => $reply['Member']['fullname'],
                        'image' => $reply['Member']['image'],
                        'admin' => $reply['Profile']['admin']
                    );
                    $j = $j + 1;
                }
                //
                $data[$i] = array(
                    'id' => $item['Commentpost']['id'],
                    'comment' => nl2br(htmlentities($item['Commentpost']['comment'], ENT_QUOTES, 'UTF-8')),
                    'created' => $this->Library->time_elapsed_string($item['Commentpost']['created']),
                    'like' => $item['Commentpost']['like'],
                    'fullname' => $item['Member']['fullname'],
                    'image' => $item['Member']['image'],
                    'admin' => $item['Profile']['admin'],
                    'reply' => $data_reply
                );
                $i = $i + 1;
            }
            echo json_encode($data);
        }
    }
    function like()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            if($this->request->is('post'))
            {
                $reply_id = $this->request->data['reply_id'];
                $this->Commentproductreply->recursive = -1;
                if($this->Commentproductreply->updateAll(array('Commentproductreply.like' => 'Commentproductreply.like + 1'), array('Commentproductreply.id' => $reply_id)))
                {
                    $this->Commentproductreply->recursive = -1;
                    $like = $this->Commentproductreply->find('first', array('conditions' => array('id' => $reply_id)));
                    echo json_encode(array(
                        'status' => 'success',
                        'like' => $like['Commentproductreply']['like']
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