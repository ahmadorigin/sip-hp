<?php 

      session_start();
      $_SESSION["login"] = [];
      session_unset();
      session_destroy();

      // hapus cookie ketika logout
      setcookie('id', '', time() - 30 * 24 * 60 * 60);
      setcookie('key', '', time() - 30 * 24 * 60 * 60);

      header("Location: ../index.php");
      exit;