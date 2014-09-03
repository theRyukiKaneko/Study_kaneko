<h2>記事一覧</h2>

<ul>
<?php foreach ($posts as $post) : ?>
<li id="post_<?php echo h($post['Post']['id']); ?>">
<?php
//debug($image);
//echo h($image['Post']['title']);


echo $this->Html->link($post['Post']['title'],'/posts/view/' .$post['Post']['id']);
?>
<?php echo $this->Html->link('編集',array('action'=>'edit', $post['Post']['id'])); ?>

<?php echo $this->Html->link('削除', '#', array('class'=>'delete', 'data-post-id'=>$post['Post']['id'])); ?>

</li>
<?php endforeach; ?>
</ul>

<h2>Add Post</h2>
<?php echo $this->Html->link('Add Post', array('controller'=>'posts','action'=>'add')); ?>

<?php echo $this->Html->link('Add image', array('controller'=>'posts','action'=>'imageadd')); ?>


<h2>Add image</h2>
<?php echo $this->Html->link('登録',array('action'=>'fileup', $post['Post']['id'])); ?>

<?php echo $this->Html->link('登録', '#', array('class'=>'fileup', 'data-post-id'=>$post['Post']['id'])); ?>


<script>
$(function() {
	$('a.delete').click(function(e) {
		if(confirm('sure?')) {
			$.post('/dotcake/posts/delete/'+$(this).data('post-id'), {}, function(res) {
				$('#post_'+res.id).fadeOut();
			},"json");
		}
		return false;
	});
});


$(function() {
	$('a.fileup').click(function(e) {
		if(confirm('登録しますか?')) {
			$.post('/dotcake/posts/fileimage/'+$(this).data('post-id'), {}, function(res) {
				$('#post_'+res.id).fadeIn();
			},"json");
		}
		return false;
	});
});

</script> 
