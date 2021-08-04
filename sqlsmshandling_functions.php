<?php
    $connection = null; //a global variable. From function we access it: $GLOBALS["connection"]
    
    function connectToDatabase()
    {
        $serverName = "127.0.0.1";
        $userName = "root";
        $password = "";
        $databaseName = "student_management_system";
        
        //create connection and select database by given data
        $GLOBALS["connection"] = mysqli_connect($serverName, $userName, $password, $databaseName);
        if ($GLOBALS["connection"] == null)
        {
            echo mysqli_error . "<br>";
            return false;
        }
		
        return true;
    }
    
    function closeConnection ()
    {
        try
        {
            mysqli_close($GLOBALS["connection"]);
        }
        catch (Exception $exc)
        {
            //echo ($exc->getMessage() . "<br>");
        }
    }
    
    function insertMessage ($recipient, $messageType, $messageText)
    {
        $query = "insert into ozekimessageout (receiver,msgtype,msg,status) ";
        $query .= "values ('" . $recipient . "', '" . $messageType . "', '" . $messageText . "', 'send');";
        $result = mysqli_query($GLOBALS["connection"], $query);
        if (!$result)
        {
            echo (mysqli_error() . "<br>");
            return false;
        }
        
        return true;
    }
    
    function showOutgoingMessagesInTable()
    {
        $query = "select id,sender,receiver,senttime,receivedtime,operator,status,msgtype,msg from ozekimessageout;";
        $result = mysqli_query($GLOBALS["connection"], $query);
        if (!$result)
        {
            echo (mysqli_error() . "<br>");
            return false;
        }
        
        try
        {
            echo "<table border='1'>";
            echo "<tr><td>ID</td><td>Sender</td><td>Receiver</td><td>Sent time</td><td>Received time</td><td>Operator</td>";
            echo "<td>Status</td><td>Message type</td><td>Message text</td></tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["sender"] . "</td>";
                echo "<td>" . $row["receiver"] . "</td>";
                echo "<td>" . $row["senttime"] . "</td>";
                echo "<td>" . $row["receivedtime"] . "</td>";
                echo "<td>" . $row["operator"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["msgtype"] . "</td>";
                echo "<td>" . $row["msg"] . "</td>";
                
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        }
        catch (Exception $exc)
        {
            echo (mysqli_error() . "<br>");
            return false;
        }
        
        return true;
    }
    
    function showIncomingMessagesInTable()
    {
        $query = "select id,sender,receiver,senttime,receivedtime,operator,msgtype,msg from ozekimessagein;";
        $result = mysqli_query($GLOBALS["connection"], $query);
        if (!$result)
        {
            echo (mysqli_error() . "<br>");
            return false;
        }
        
        try
        {
            echo "<table border='1'>";
            echo "<tr><td>ID</td><td>Sender</td><td>Receiver</td><td>Sent time</td><td>Received time</td><td>Operator</td>";
            echo "<td>Message type</td><td>Message text</td></tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["sender"] . "</td>";
                echo "<td>" . $row["receiver"] . "</td>";
                echo "<td>" . $row["senttime"] . "</td>";
                echo "<td>" . $row["receivedtime"] . "</td>";
                echo "<td>" . $row["operator"] . "</td>";
                echo "<td>" . $row["msgtype"] . "</td>";
                echo "<td>" . $row["msg"] . "</td>";
                
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        }
        catch (Exception $exc)
        {
            echo (mysqli_error() . "<br>");
            return false;
        }
        
        return true;
    }
?>