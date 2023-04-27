<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <table id="customers" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            
        </table>
    </div>

    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="module" src="{{ mix('/resources/js/app.js') }}"></script>
</body>
</html>
