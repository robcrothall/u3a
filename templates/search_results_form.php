<h2>List of matching People</h2>
      <a class="w3-button w3-green" href="../page/search.php">Back</a>
            <?php //echo($search_string); ?>
            <table class="w3-table" width="100%">
                <thead>
                    <tr>
                        <th>People</th>
                        <th>Asset</th>
                        <!--<th>Membership</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rows = query($search_string);
                    //$rows = query("SELECT a.id, a.surname, a.first_name, 
                    // a.other_name, a.given_name
                    // from people a 
                    //order by surname, first_name");
                    if (count($rows) > 0) {
                        foreach ($rows as $row) {
                            $people_id = $row["id"];
                            if (!empty($row["first_name"])) {
                                $first_name = ucfirst(strtolower($row["first_name"]));
                            } else {
                                $first_name = "";
                            }
                            if (!empty($row["other_name"])) {
                                $other_name = ucfirst(strtolower($row["other_name"]));
                            } else {
                                $other_name = "";
                            }
                            if (!empty($row["given_name"])) {
                                $given_name = ucfirst(strtolower($row["given_name"]));
                            } else {
                                $given_name = "";
                            }
                            if (!empty($row["surname"])) {
                                $surname = ucfirst(strtolower($row["surname"]));
                        } else {
                            $surname = "";
                        }
                        echo '<tr>';
                            echo '<td>';
                            /*
                            echo $surname . ", " . $first_name;
                            if (strlen($other_name) > 0) {
                                echo ' ' . $other_name;
                            }
                            if (strlen($given_name) > 0) {
                                echo ' (' . $given_name . ')';
                            }
                            */
                            echo full_name($people_id);
                            echo '</td>';
                            echo '<td>';  // Asset
                            $sql = "select a.asset_name ";
                            $sql .= "from asset a, people_asset pa ";
                            $sql .= "where a.id = pa.asset_id ";
                            $sql .= "and pa.people_id = ? ";
                            $sql .= "order by a.asset_seq ";
                            $assets = query($sql, $people_id);
                            $comma = "";
                            foreach ($assets as $asset) {
                                echo $comma . $asset["asset_name"];
                                $comma = ", ";
                            }
                            echo '</td>';
                            //echo '<td>';
                            //$sql = "select a.group_name ";
                            //$sql .= "from `groups` a, memberships b ";
                            //$sql .= "where a.id = b.group_id ";
                            //$sql .= "and b.people_id = ? ";
                            //$sql .= "order by a.group_name ";
                            //$groups = query($sql, $people_id);
                            //$comma = "";
                            //foreach ($groups as $group) {
                            //    echo $comma . $group["group_name"];
                            //    $comma = ", ";
                            //}
                            //echo '</td>';
                            echo '<td>';
                            echo '<a class="w3-button w3-green"';
                            echo 'href="../page/people_read.php?id=' . $row['id'];
                            echo '">Read</a>' . '&nbsp;';
                            if (check_role("STAFF") 
                                or check_role("ADMIN") 
                            ) {
                                echo '<a class="w3-button w3-green" ';
                                echo 'href="../page/people_update.php?id=';
                                echo $row['id'] . '">Update</a>' . '&nbsp;';
                                if (check_role("ADMIN")) {
                                    echo '<a class="w3-button w3-red" ';
                                    echo 'href="../page/people_delete.php?id=';
                                    echo $row['id'] . '">Delete</a>';
                                }
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr>";
                        echo "<td>No records found - please try again.</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "</tr>";
                    }
                    //$message .= "Clearing temporary table;";
                    //$sql = "delete from email_addresses ";
                    //$sql .= "where user_id = " .  $_SESSION["id"] . " and text_type in ('email', 'phone')";
                    //$result = query($sql);
                    ?>
                </tbody>
            </table>
      <a class="w3-button w3-green" href="../page/search.php">Back</a>
