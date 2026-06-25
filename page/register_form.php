<?php
/**
 * Program: Register_form
 * 
 * Register a new user.
 * php version 5
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 */
?>
<div class="w3-container">
<form class="form-control full-width" action="../page/register.php" method="post">
    <fieldset>
        <div class="form-group">
            Username:<br>
            <input autofocus class="form-control full-width" style="width: 100%"
             name="username" type="text"/>
        </div>
        <div class="form-group">
                Password:<br>
            <input class="form-control full-width" style="width: 100%"
             name="password" type="password"/>
        </div>
        <div class="form-group">
                Re-enter password:<br>
            <input class="form-control" style="width: 100%" name="confirmation"
             type="password"/>
        </div>
        <div class="form-group">
                Title:<br>
                <select name="title_id">
                    <option value="0" selected>Please choose</option>
                    <!php
                    $sql = "SELECT id, title FROM `title` order by title";
                    $rows = query($sql);
                    foreach ($rows as $row) {
                        echo '<option value="' . $row["id"] . '"' . ">" . $row["title"] . "</option>\n";
                    }
                    ?>
                </select>
        </div>
        <div class="form-group">
                Surname:<br>
            <input class="form-control" style="width: 100%" name="surname" type="text"/>
        </div>
        <div class="form-group">
                First name:<br>
            <input class="form-control" style="width: 100%" name="first_name" type="text"/>
        </div>
        <div class="form-group">
                Given name:<br>
            <input class="form-control" style="width: 100%" name="given_name" type="text"/>
        </div>
        <div class="form-group">
                Address line 1:<br>
            <input class="form-control" style="width: 100%" name="address_line_1" type="text"/>
        </div>
        <div class="form-group">
                Address line 2:<br>
            <input class="form-control" style="width: 100%" name="address_line_2" type="text"/>
        </div>
        <div class="form-group">
                Address line 3:<br>
            <input class="form-control" style="width: 100%" name="address_line_3" type="text"/>
        </div>
        <div class="form-group">
                City:<br>
                <select name="city_id">     
                    <option value="0" selected>Please choose</option>
                    <?php
                    $sql = "SELECT id, city FROM `city` order by city";
                    $rows = query($sql);
                    foreach ($rows as $row) {
                        echo '<option value="' . $row["id"] . '"' . ">" . $row["city"] . "</option>\n";
                    }
                    ?>
                </select>
            </div>
        <div class="form-group">
                Postal code:<br>
            <input class="form-control" style="width: 100%" name="postal_code" type="text"/>
        </div>
        <div class="form-group">
                Phone number:<br>
            <input class="form-control" style="width: 100%" name="phone_no" type="text"/>
        </div>
        <div class="form-group">
                Mobile number:<br>
            <input class="form-control" style="width: 100%" name="mobile_no" type="text"/>
        </div>
        <div class="form-group">
                Email address:<br>
            <input class="form-control" style="width: 100%" name="email" type="text"/>
        </div>
        <div class="form-group">
                Are you a speaker?:<br>
                <select name="speaker">
                    <option value="0" selected>Please choose</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select>
            </div>
        <div class="form-group">
                Field of interest:<br>
            <input class="form-control" style="width: 100%" name="field_of_interest" type="text"/>
        </div>
        <div class="form-group">
                Skills:<br>
            <input class="form-control" style="width: 100%" name="skills" type="text"/>
        </div>
        <div class="form-group">
                Subjects:<br>
            <input class="form-control" style="width: 100%" name="subjects" type="text"/>
        </div>
<?php
echo '<option value="0" selected>Please choose</option>\n';
$sql = "SELECT id, surname, first_name, given_name FROM `people` ";
$sql .= "where status in ('Staff', 'Contractor', 'Associate') ";
$sql .= "order by surname, first_name";
$rows = query($sql);
foreach ($rows as $row) {
    $name = $row["surname"];
    if (!empty($row["first_name"])) {
        $name .= ", " . $row["first_name"];
    }
    if (!empty($row["given_name"])) {
        $name .= " (" . $row["given_name"] . ")";
    }
    echo '<option value="' . $row["id"] . '"' . ">" . $name . "</option>\n";
}
?>
                </select>
            </div>
            <br>
        <div class="form-group">
            <button type="submit" class="w3-button w3-green">Register</button> or 
            choose another menu option
        </div>
    </fieldset>
</form>
<h2>Registering a User</h2>
<p>All Residents are registered, by default, so they need not be registered here.  
    Only register staff, contractors, and associates.</p>
<p>Details will be taken from the People records, so please ensure that the record 
    has been updated and checked.</p>
<p>If any information found on the site is thought to be inaccurate or 
    inappropriate, please send details to 
    <a href="mailto:rob@crothall.co.za?Subject=SPRV%20Website" target="_top">
        the General Manager</a> of Settlers Park Retirement Village.
</p>
</div>
