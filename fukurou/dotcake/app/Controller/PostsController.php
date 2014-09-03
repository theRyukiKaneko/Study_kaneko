<?php

class PostsController extends AppController {
	//public $scaffold;	１行追加で多機能。
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('posts', $this->Post->find('all'));
		$this->set('title_for_layout', '記事一覧');

	}

	public function view($id = null) {
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());
	}
	public function add() {
		if ($this->request->is('post')) {			//postされた値を次のように処理しなさい
			if ($this->Post->save($this->request->data)) {	//postデータをpostにセーブ。
			    $this->Session->setFlash('Success!');	//成功した場合Success!を表示
			    $this->redirect(array('action'=>'index'));	//一覧にリダイレクトする
		} else {
			    $this->Session->setFlash('failed!!');	//失敗した場合failed!を表示
			}
		}
	}
	public function edit($id = null) {
		$this->Post->id = $id;
		if($this->request->is('get')){
		   $this->request->data = $this->Post->read();
		} else {
			if($this->Post->save($this->request->data)){
				$this->Session->setFlash('success!');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('failed!');
			}
		}
	}
	public function delete($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if($this->request->is('ajax')) {
			if($this->Post->delete($id)) {
			   $this->autoRender = false;
			   $this->autoLayout = false;
			   $response = array('id' => $id);
			   $this->header('Content-Type: application/json');
			   echo json_encode($response);
			   exit();
			}
		}
		$this->redirect(array('action' => 'index'));
	}
	
	//上の削除のシステムを応用したスクリプト
	public function fileimage($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if($this->request->is('ajax')) {
			if($this->Post->delete($id)) {
			   $this->autoRender = false;
			   $this->autoLayout = false;
			   $response = array('id' => $id);
			   $this->header('Content-Type: application/json');
			   echo json_encode($response);
			   exit();
			}
		}
		$this->redirect(array('action' => 'index'));
	}
	public function fileup(){
	  if ($this->request->is('post') || $this->request->is('put')) {
	    //画像の保存
	    if($this->Post->save($this->request->data)){
	      //画像保存先のパス
	      $path = IMAGES;
	      $image = $this->request->data['Post']['image'];
	      $this->Session->setFlash('画像を登録しました');
	      move_uploaded_file($image['tmp_name'], $path . DS . $image['name']);
	    }else{
	      $this->Session->setFlash('画像が登録できませんでした');
	    }
	  }
	}
/*
	public function imageadd(){

        if (!empty($this->request->data) && $this->request->is('ajax')) {
            Configure::write('debug',0);
            $this->autoRender = false;
            $this->autoLayout = false;
            
            $type = array(
                'image/png' => '.png',
                'image/jpeg' => '.jpg',
                'image/gif' => '.gif',
            );
            
            $fileName = $this->request->data['Image']['fileName']. $type[$this->request->data['Image']['type']];
            
            move_uploaded_file($this->request->data['Image']['tmp_name'], /ファイルの保存場所/. $fileName);

            $params = array(
                'Image' => array(
                    'name' => $fileName
                )
            );
            
            if ($this->Image->save($params)) {
                return $fileName;
            } else {
                return 'error';
            }
        }
        exit();
	}*/
}
