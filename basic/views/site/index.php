<?php

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\models\User;
use yii\bootstrap\Dropdown;

/* @var $this yii\web\View */

$this->title = 'Rest Gui Application';
?>

<section class="response">
	<h2>Response</h2>
	<pre id="response">

	</pre>
</section>

<section>
	<h2>getRoster</h2>
	<form class="ajaxForm" action="<?= Url::to(['rest/getroster']); ?>" method="get">
		<label>
			Выберите пользователя
			<select name="uuid" class="form-control">
				<?php
				$users = User::find()->all();
				foreach($users as $user){
					echo "<option value='{$user->uuid}'>{$user->uuid}</option>";
				}
				?>
			</select>
		</label>
		<input type="submit">
	</form>
</section>
<hr/>

<section>
	<h2>CreateUser</h2>
	<form class="ajaxForm" action="<?= Url::to(['rest/createuser']); ?>" method="get">
		<label>
			Добавить пользователя
			<input type="text" name="uuid" placeholder="UUID"/>
		</label>
		<input type="submit">
	</form>
</section>
<hr/>

<section>
	<h2>addParticipant</h2>
	<form class="ajaxForm" action="<?= Url::to(['rest/addparticipant']); ?>" method="get">
		<label>
			Выберите пользователя
			<select name="uuid">
				<?php
				$users = User::find()->all();
				foreach($users as $user){
					echo "<option value='{$user->uuid}'>{$user->uuid}</option>";
				}
				?>
			</select>
		</label><br/>

		<label>
			UUID контакта
			<input type="text" name="participant" placeholder="UUID"/>
		</label><br/>

		<label>
			Title контакта
			<input type="text" name="title" placeholder="title"/>
		</label><br/>

		<label>
			Группа
			<input type="text" name="group" placeholder="group"/>
		</label>

		<input type="submit">
	</form>
</section>
<hr/>

<section>
	<h2>RemoveParticipant</h2>
	<form class="ajaxForm" action="<?= Url::to(['rest/removeparticipant']); ?>" method="get">
		<label>
			Выберите пользователя
			<select name="uuid">
				<?php
				$users = User::find()->all();
				foreach($users as $user){
					echo "<option value='{$user->uuid}'>{$user->uuid}</option>";
				}
				?>
			</select>
		</label><br/>

		<label>
			UUID контакта
			<input type="text" name="participant" placeholder="UUID"/>
		</label><br/>

		<label>
			Группа
			<input type="text" name="group" placeholder="group"/>
		</label>
		<input type="submit">
	</form>
</section>
<hr/>

<section>
	<h2>RenameParticipant</h2>
	<form class="ajaxForm" action="<?= Url::to(['rest/renameparticipant']); ?>" method="get">
		<label>
			Выберите пользователя
			<select name="uuid">
				<?php
				$users = User::find()->all();
				foreach($users as $user){
					echo "<option value='{$user->uuid}'>{$user->uuid}</option>";
				}
				?>
			</select>
		</label><br/>

		<label>
			UUID контакта
			<input type="text" name="participant" placeholder="UUID"/>
		</label><br/>

		<label>
			Title контакта
			<input type="text" name="title" placeholder="title"/>
		</label><br/>

		<label>
			Группа
			<input type="text" name="group" placeholder="group"/>
		</label>

		<input type="submit">
	</form>
</section>
<hr/>



<script>
	$(function () {
		$('.ajaxForm').submit(function (e) {
			e.preventDefault();
			var form = $(this);
			var data = form.serialize();

			$.ajax({
				url: form.attr('action'),
				data: data,
				dataType: 'text',
				success: function (response) {
					console.log(response);
					$('#response').html(response);
				}
			})
		})
	});
</script>

