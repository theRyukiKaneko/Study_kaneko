

<?php

class UploadsController extends AppController {

	var $name = 'Uploads';
	var $users = ('Upload');

// 他のメンバー変数

	// ファイルのアップロードメソッド
	public function upload() {
		if (!empty($this->data)) {
			if(is_uploaded_file($this->data['Upload']['file_name']['tmp_name']) ){
				if(strlen($this->data['Upload']['file_name']['tmp_name']) ){
					//　アップロードするファイルの場所
					$uploaddir = Configure::read('upload.path');
					$uploadfile = $uploaddir.DS.basename($this->data['Upload']['file_name']['name']);
					// 同じ名前のファイルがすでに存在すれば、別名に変える
					$info = pathinfo($uploadfile);
					$i = 1;
					while(file_exists($uploadfile) ){
						$i++;
						$file_name = basename($info['basename'],'.'.$info['extension'].'_'.$i.'.'.$info['dirname'].DS.$file_name;
						$this->log('アップロードファイル名を再作成:'.$uploadfile,:LOG_DEBUG);
						$this->data['Upload']['file_name']['name'] = $file_name;
					}
					// 画像をテンポラリーの場所から、正式な置き場所へ移動
					if (move_uploaded_file($this->data['Upload']['file_name']['tmp_name'], $uploadfile)) {
						chmod($uploadfile,0666);
						$this->Upload->create();
						// DBにレコード登録
						$this->data['Upload']['file_name'] = $this->params['data']['Upload']['file_name']['tmp_name'];
						if ($this->Upload->save($this->data) ) {
							// 成功
							$this->Upload->setFlash("ファイルのアップロードに成功しました。");
								} else {
							// 失敗
							$this->Session->setFlash("データベースの登録に失敗しました。");
								} else {
							// 失敗
							$this->Session->setFlash("ファイルのアップロードに失敗しました。");
							}
						} else {
						$this->Upload->invalidate("file_name","ファイル名に全角文字は使用できません。");
						} else {
						$this->Upload->invalidate("file_name","ファイルをアップロードしてください。");
						}
					}
				}
							
			// 他のメソッド
			}
