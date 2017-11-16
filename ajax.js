$(document).ready(function() {
    $("#btn").click(
        function(){
            sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
            return false;
        }
    );
});

$(document).ajaxStop(function() {
    paintHoliday();
    return false;
});

//Отрисовка выходных день красным
function paintHoliday() {
    $('tr').each(function(){
        $(this).find('td').each(function(){
            if ($(this).html() === 'выходной день') {
                $(this).parent('tr').addClass('danger');
                return false;
            }
        });
    });
}

//Получить html таблицу
function getTable(tableObject) {
    var tableBody = '';
    var htmlTable = '';
    for(var i = 0; i < tableObject.length; i++)
    {
        tableBody += "<tr>";
        tableBody +=  "<th>" + tableObject[i].row + "</th>";
        tableBody += "<td>" + tableObject[i].day + "</td>";
        tableBody += "<td>" + tableObject[i].typeTitle + "</td>";
        tableBody += "<td>" + (tableObject[i].holidayTitle === null ? "" : tableObject[i].holidayTitle)  + "</td>";
        tableBody += "</tr>";
    }
    htmlTable =
        "<table class='table'>" +
        "<thead class='thead-dark'>" +
        "<tr>" +
        "<th scope='col'>#</th>" +
        "<th scope='col'>День</th>" +
        "<th scope='col'>Тип</th>" +
        "<th scope='col'>Праздник</th>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
            tableBody +
        "</tbody>" +
        "</table>";

    return htmlTable;
}

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:        url,
        type:     "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(),
        success: function(response) {
            var result = $.parseJSON(response);
            var htmlTable = getTable(result.table);

            $("#"+result_form).html(htmlTable);
        },
        error: function(response) { // Данные не отправлены
            $("#"+result_form).html('Ошибка. Данные не отправлены.');
        }
    });
}