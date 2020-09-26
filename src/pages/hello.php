<?php
$name  = $request->query->get('name', 'Wolrd');
?>

Hello <?= htmlspecialchars($name, ENT_QUOTES) ?>

