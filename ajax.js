$(document ).ready(function() {
    $("#btn").click(
        function(){
            sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
            return false;
        }
    );
});

$( document ).ajaxStop(function() {
    paintHoliday();
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

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:        url,
        type:     "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(),
        success: function(response) {
            var result = $.parseJSON(response);
            function getTable() {
                var tbody = '';
                var table = '';
                for(var i = 0; i < result.table.length; i++)
                {
                    tbody += "<tr>";
                    tbody +=  "<th>" + result.table[i].row + "</th>";
                    tbody += "<td>" + result.table[i].day + "</td>";
                    tbody += "<td>" + result.table[i].typeTitle + "</td>";
                    tbody += "<td>" + (result.table[i].holidayTitle === null ? "" : result.table[i].holidayTitle)  + "</td>";
                    tbody += "</tr>";
                }
                table =
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
                            tbody+
                        "</tbody>" +
                    "</table>";

                return table;
            }

            $("#"+result_form).append(getTable());
        },
        error: function(response) { // Данные не отправлены
            $("#"+result_form).html('Ошибка. Данные не отправлены.');
        }
    });
}