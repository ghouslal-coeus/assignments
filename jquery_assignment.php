<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JQuery Assignment</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <div class="ip-form-area">
            <form id="ip_form" action="#" onsubmit="event.preventDefault(); validateIpAddress()">

                <input type="text" name="ip_address" id="ip_address" placeholder="Enter valid IP address" />

                <p id="ip_error"></p>

                <input name="submit" type="submit" value="Submit" />

            </form>
        </div>
        <div class="data_table">
            <table id="ip_datatable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>IP</th>
                        <th>Country</th>
                        <th>Country code</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
            <button id="remove_button"> 
                Remove Selected Row
            </button>
        </div>
    </div>
</body>
</html>