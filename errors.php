<?php
$errors = array(); // Assume $errors is populated with error messages

if (count($errors) > 0) :
    ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="success">
        <p>Success message goes here!</p>
    </div>
<?php endif; ?>
