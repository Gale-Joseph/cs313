<div class="topnav">
  
  <form action="../transactions/index.php" method="post">
        <input type="hidden" name="action" value="">
        <input type ="submit" name="submit" value="Home">
    </form>  
  <form action="../accounts/index.php" method="post">
      <input type="hidden" name="action" value="getUserInfo">
      <input type ="submit" name="submit" value="User Account">
  </form>
  <form action="../transactions/index.php" method="post">
      <input type="hidden" name="action" value="getTrans">
      <input type ="submit" name="submit" value="View Transaction History">
  </form>
  <form action="../accounts/index.php" method="post">
      <input type="hidden" name="action" value="logout">
      <input type ="submit" name="submit" value="Logout">
  </form>
</div> 