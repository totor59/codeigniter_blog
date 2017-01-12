<div id="site_content">
    <div id="content">
        <!-- insert the page content here -->
        <h1>Register as a new user</h1>
        <?php if($error){echo '<div style="color:red;">'.$error.'</div>'; }?>

        <form action="<?=  base_url()?>index.php/Admin/register/" method="post">
            <div class="form_settings">
                <p><span>Username</span><input class="" type="text" name="user_name" /></p>
                <p><span>Password</span><input class="" type="password" name="password" /></p>
                <p><span>Retype Password</span><input class="" type="password" name="passconf"/></p>
                <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="add" value="Register" /></p>
            </div>
        </form>
    </div>
</div>
