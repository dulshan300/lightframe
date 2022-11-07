<?php $this->layout('layouts/site', ['title' => 'Home']) ?>

<h1 class="bb">hello world</h1>

<?=$this->e("hello world trim",'trim|upper')?>