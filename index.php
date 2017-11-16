<html>
<head>
    <meta charset="utf-8"/>
    <title>My Calendar</title>
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/assets/js/jquery-3.2.1.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body>
    <div class="container">
    <h1>Календарь</h1>
        <form method="post" action="" id="ajax_form">
            <div class="input-group">
                <select class="form-control" name="yearSelect" id="yearSelect">
                    <option>2013</option>
                    <option>2014</option>
                    <option>2015</option>
                    <option>2016</option>
                    <option>2017</option>
                    <option>2018</option>
                </select>
                <span class="input-group-btn">
                <!--<button name="submit" type="submit" class="btn btn-primary align-middle">Выбрать</button>-->
                <input type="button" id="btn" class="btn btn-primary" value="Отправить" />
            </div>
        </form>

        <div id="result_form"> </div>
    </div>


</body>
</html>