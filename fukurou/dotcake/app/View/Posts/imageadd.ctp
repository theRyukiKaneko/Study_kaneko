<h2>Add post</h2>

<?php
/*echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows'=>3));
echo $this->Form->end('Save Post');
*/



    echo $this->Form->create('Image',array('action' => 'add', 'type' => 'file')).PHP_EOL;

    echo $this->Form->input(false,array(
        'type' => 'file',
        'label' => '画像選択',
    )).PHP_EOL;

    echo $this->Form->input('fileName', array(
        'type' => 'text',
        'label' => '画像名',
        'required' => true,
        )).PHP_EOL;

    echo $this->Form->submit('upload',array('id' => 'img')).PHP_EOL;
    echo $this->Form->end('add').PHP_EOL;
?>


