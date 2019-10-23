<body>

<div id="menu"><?php include_once __DIR__ . '/.php'; ?></div>

<h1>||<?php echo __CLASS__ ?>||</h1>

<div id="app">
  {{ message }}
</div>

<div id="app-3">
  <span v-if="seen">Now you see me</span>
</div>

