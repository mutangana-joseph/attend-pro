<?php if($error): ?>

<div class="alert error">

    <i class="fa-solid fa-circle-xmark"></i>

    <?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>


<?php if($success): ?>

<div class="alert success">

    <i class="fa-solid fa-circle-check"></i>

    <?= htmlspecialchars($success) ?>

</div>

<?php endif; ?>