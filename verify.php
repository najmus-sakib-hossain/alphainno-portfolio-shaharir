<?php $hash = '$2y$12$RQ1NnKUSF3CFun1UxCIqGeXOQWS/WdFZ5u2KjoqKUujYHZA6KUmEa'; $password = '00000000'; if (password_verify($password, $hash)) { echo $password; } else { echo 'no match'; } ?>
