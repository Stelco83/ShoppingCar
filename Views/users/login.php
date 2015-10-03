<?php if(!isset($_SESSION['userid'])): ?>
<form action="" method="post">
    <table>
        <tr>
            <th>Username</th>
            <td><input type="text" name="username"/></td>
        </tr>
        <tr>
            <th>Password</th>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td><input type="submit" name="login" value="Login"/></td>
            <td><input type="submit" name="toRegister" value="ToRegister"/></td>
        </tr>
            <?php if($this->error): ?>
        <tr>
            <th>ERROR</th>
            <td><?= $this->error; ?></td>
        </tr>
        <?php endif; ?>
    </table>
</form>
<?php endif?>
