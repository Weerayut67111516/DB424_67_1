<?php
include 'header.php';
$sql = "select *, a.activityID, 
        if(r.activityID is null, 0, 1) registed 
        from activity a left join
        (
            select *
            from register
            where studentID ='{$_SESSION['user']['studentID']}'
        )   r on a.activityID=r.activityID
        where activityDate > curdate()
        and (r.activityID is not null or available > 0) ";
$result = $conn->query($sql);
?>
<table class="table table-striped">
    <tr class="table-dark">
        <th>activityID</th>
        <th>activityName</th>
        <th>activityDate</th>
        <th>startTime</th>
        <th>available</th>
        <th>endTime</th>
</tr>
<?php
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo "<td>{$row['activityID']}</td>";
    echo "<td>{$row['activityName']}</td>";
    echo "<td>{$row['activityDate']}</td>";
    echo "<td>{$row['startTime']}</td>";
    echo "<td>{$row['endTime']}</td>";
    echo "<td>{$row['available']}</td>";
    echo "<td>
            <a href='#' class='btn btm-sm btn-success ".
            ($row['registed'] ? 'disabled' : '')." '>+</a>
            <a href='#' class='btn btm-sm btn-danger ".
            ($row['registed'] ? '' : 'disabled')."'>-</a>
         </td>";
    echo '</tr>';
    
}
?>
</table>
<?php
include 'footer.php';
?>