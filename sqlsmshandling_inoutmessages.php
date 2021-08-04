<html>
<head>
<?php
    include_once ("sqlsmshandling_functions.php");
?>
</head>
<body>
    <form action="" method="post">
    <table border=0 align="center">
        <tr>
            <td align="center"><font style="font-weight: bold;">Outgoing messages</font></td>
        </tr>
        <tr>
            <td align="center">
                <?php
                    try
                    {
                        connectToDatabase();
                        showOutgoingMessagesInTable();
                        closeConnection ();
                    }
                    catch (Exception $exc)
                    {
                        echo "Error: " . $exc->getMessage();
                    }
                ?>
            </td>
        </tr>
    </table>


    <br /><br />
    <table border=0 align="center">
        <tr>
            <td align="center"><font style="font-weight: bold;">Incoming messages</font></td>
        </tr>
        <tr>
            <td align="center">
                <?php
                    try
                    {
                        connectToDatabase();
                        showIncomingMessagesInTable();
                        closeConnection ();
                    }
                    catch (Exception $exc)
                    {
                        echo "Error: " . $exc->getMessage();
                    }
                ?>
            </td>
        </tr>
            <tr>
                <td align="center">
                    <input type="submit" value="Refresh">
                </td>
            </tr>
    </table>
    </form>
</body>
</html>
