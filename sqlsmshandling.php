<html>
<head>
<?php
    include_once ("sqlsmshandling_functions.php");
?>
    <title>SMS sending by PHP7 and MySQL</title>
</head>
<body>
<form action="" method="post">
    <table border="0" align="center">
        <tr>
            <td colspan="2" align="center">
                <font style="font-weight: bold; font-size: 16px;">Compose message</font>
                <br /><br />
            </td>
        </tr>
        <tr>
            <td valign="top">Recipient: </td>
            <td>
                <textarea name="textAreaRecipient" cols="40" rows="2"><?php  echo ((isset($_POST["textAreaRecipient"])) ? ($_POST["textAreaRecipient"]) : ("")); ?></textarea>
            </td>
        </tr>
        <tr>
            <td valign="top">Message text: </td>
            <td>
                <textarea name="textAreaMessage" cols="40" rows="10"><?php  echo ((isset($_POST["textAreaMessage"])) ? ($_POST["textAreaMessage"]) : ("")); ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Send">
            </td>
        </tr>
        <tr><td colspan='2' align='center'>
        <?php
        if (isset($_POST["textAreaRecipient"]) && $_POST["textAreaRecipient"] == "")
        {
            echo "<font style=\"color: red; font-weight: bold;\">Recipient field mustn't be empty!</font>";
        }
        else if (isset($_POST["textAreaRecipient"]) && $_POST["textAreaRecipient"] != "")
        {
            try
            {
                connectToDatabase();
                if (insertMessage ($_POST["textAreaRecipient"], "SMS:TEXT", $_POST["textAreaMessage"]))
                {
                    echo "<font style=\"color: red; font-weight: bold;\">Insert was successful!</font>";
                }
                closeConnection ();
            }
            catch (Exception $exc)
            {
                echo "Error: " . $exc->getMessage();
            }
        }
        ?>
        </td></tr>
    </table>
</form>

<iframe src="sqlsmshandling_inoutmessages.php" align="center" width="90%" height="500" frameborder="0"></iframe>

</body>
</html>