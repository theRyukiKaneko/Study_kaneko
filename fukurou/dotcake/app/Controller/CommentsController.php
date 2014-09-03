<?php

class CommentsController extends AppController {
	//public $scaffold;	１行追加で多機能。
	public $helpers = array('Html', 'Form');

	public function add() {
		if ($this->request->is('post')) {			//postされた値を次のように処理しなさい
			if ($this->Comment->save($this->request->data)) {	//postデータをpostにセーブ。
			    $this->Session->setFlash('Success!');	//成功した場合Success!を表示
			    $this->redirect(array('controller'=>'posts','action'=>'view', $this->data['Comment']['post_id']));
		} else {
			    $this->Session->setFlash('failed!!');	//失敗した場合failed!を表示
			}
		}
	}

	public function delete($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if($this->request->is('ajax')) {
			if($this->Comment->delete($id)) {
			   $this->autoRender = false;
			   $this->autoLayout = false;
			   $response = array('id' => $id);
			   $this->header('Content-Type: application/json');
			   echo json_encode($response);
			   exit();
			}
		}
		$this->redirect(array('controller'=>'posts', 'action' => 'index'));
	}
}
