<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

$_SESSION["module"] = $_SERVER["PHP_SELF"];
$doc_id         = $_SESSION["doc_id"];
$doc_group      = $_SESSION["doc_group"];
$doc_subgroup   = $_SESSION["doc_subgroup"];
$doc_name       = $_SESSION["doc_name"];
$doc_file       = $_SESSION["doc_file"];
$submitted      = $_SESSION["submitted"];
$approved       = $_SESSION["approved"];
$review         = $_SESSION["review"];
?>
<h2 align="center">Document upload</h2>
<h3 align="left">Please select:</h3>
<form action="../page/docs_ctl_form.php" method="post" 
    enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
<table cellspacing=0 cellpadding=4>
<tr>
<td><label for="doc_group">Document Group:</label></td>
<td><select name="doc_group">
<?php
$rows = query("SELECT distinct doc_group FROM docs order by doc_group");
foreach ($rows as $row) {
    if ($row["doc_group"] == $doc_group) {
        $selected = " selected";
    } else {
        $selected = "";
    }
    echo '<option value="' . $row["doc_group"] . '"' . $selected . ">";
    echo $doc_group . "</option>\n";
}
?>
    </select>

</tr>
</table>
<input type="submit">
</div>
<?php

?>
