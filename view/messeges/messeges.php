<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 08/06/18
 * Time: 13:42
 */

@session_start();

if($_SESSION['type_messege'] == 'sucess') { ?>

    <div class="alert alert-success my-3" role="alert">
        <?php echo $_SESSION['messege']; ?>
    </div>

<?php } elseif($_SESSION['type_messege'] == 'error') { ?>

    <div class="alert alert-danger my-3" role="alert">
        <?php echo $_SESSION['messege']; ?>
    </div>

<?php } ?>
