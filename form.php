<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


</head>
<body>
<form action="form.php" method="POST">
    <table>
        <tr>
            <th class="name">Ваше имя:</th> <td class="point"><input type="text" name="name" size="35"> </td>
        </tr>
        <tr>
            <th class="name">Ваш телефон:</th> <td class="point"><input type="text" name="phone" size="35"></td>
        </tr>
        <tr>
            <th class="name">Вы уже пользовались нашими услугами?</th> <td class="point"> Да:<input type="checkbox" value="Да" name="call">  Нет:<input type="checkbox" value="Нет" name="call"></td>
        </tr>
        <tr>
            <th class="name">Ваш e-mail:</th> <td class="point"> <input type="text" name="website" size="35"></td>
        </tr>
        <tr>
            <th class="name">Выберите специалиста:</th> <td class="point">
                <select name="priority" size="1">
                    <option value="spec1">Специалист 1</option>
                    <option value="spec2">Специалист 2</option>
                    <option value="spec3">Специалист 3</option>
                    <option value="spec4">Специалист 4</option>
                    <option value="spec5">Специалист 5</option>
                </select>
            </td>
        </tr>
        <tr>
            <th class="name">Желаемая услуга:</th> <td class="point">
                <select name="type" size="1">
                    <option value="service1">Услуга 1</option>
                    <option value="service2">Услуга 2</option>
                    <option value="service3">Услуга 3</option>
                    <option value="service4">Услуга 4</option>
                </select> </td>
        </tr>
        <tr>
            <th class="name">Описание вопроса:</th> <td class="point"><textarea name="message" rows="8" cols="45"></textarea></td>
        </tr>
        <tr>
            <th class="name">Выберите дату приёма:</th> <td class="point"><input type="text" name="date" id="datepicker"> </td>
        </tr>
        <tr>
            <th class="name">Выберите время приёма:</th> <td class="point"><input type="text" name="timepicker" id="time"></td>
        </tr>
        <tr>
            <td class="send" colspan=2 align="left"> <input type="reset" value="Очистить"><input type="submit" value="Отправить">
            </td></tr>
    </table>
</form>

<script>
    /* Локализация datepicker */
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
</script>
<script>
    var holidays = [
        [1,1],[2,1],[3,1],[4,1],[5,1],[6,1],[7,1],[8,1],[22,2],[23,2],[24,2],[7,3],[8,3],[9,3],[1,5],[2,5],[3,5],[4,5],[5,5],[9,5],[10,5],[11,5],[12,6],[13,6],[14,6],[4,11]
    ];


    $(function(){
        $("#datepicker").datepicker({
            beforeShowDay: function(date){
                var dayOfWeek = date.getDay();
                for (var i = 0; i < holidays.length; i++) {
                    if ((holidays[i][0] == date.getDate() && holidays[i][1] - 1 == date.getMonth()) || (dayOfWeek == 0 || dayOfWeek == 2 || dayOfWeek == 3 || dayOfWeek == 5 || dayOfWeek == 6)) {
                        return [false];
                    }
                }
                return [true];
            },
            onSelect: function(date){
                var dataArr = date.split('.');
                var data = new Date(dataArr[2], dataArr[1], dataArr[0]);
                if (data.getDay() === 3) {
                    // alert(data.getDay());
                    $('#time').timepicker('option', 'minTime', '8:30');
                    $('#time').timepicker('option', 'maxTime', '12:00');
                }
                if (data.getDay() === 6) {
                    // alert(data.getDay());
                    $('#time').timepicker('option', 'minTime', '13:30');
                    $('#time').timepicker('option', 'maxTime', '16:30');
                }
            },
        });
        $('#time').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '8:30',
            maxTime: '12:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>

<?php

//$submit = $_POST['submit'];
// && isset($_POST['phone']) && !empty($_POST['phone']) && isset($_POST['call']) && !empty($_POST['call']) && isset($_POST['website']) && !empty($_POST['website']) && isset($_POST['priority']) && !empty($_POST['priority']) && isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['timepicker']) && !empty($_POST['timepicker'])) {
if(isset($_POST['name']) && !empty($_POST['name'])){$name = $_POST['name'];}
if(isset($_POST['phone']) && !empty($_POST['phone'])){$phone = $_POST['phone'];}
if(isset($_POST['call']) && !empty($_POST['call'])){$call = $_POST['call'];}
if(isset($_POST['website']) && !empty($_POST['website'])){$email = $_POST['website'];}
if(isset($_POST['priority']) && !empty($_POST['priority'])){$specialist = $_POST['priority'];}
if(isset($_POST['type']) && !empty($_POST['type'])){$service = $_POST['type'];}
if(isset($_POST['message']) && !empty($_POST['message'])){$message = $_POST['message'];}
if(isset($_POST['date']) && !empty($_POST['date'])){$date = $_POST['date'];}
if(isset($_POST['timepicker']) && !empty($_POST['timepicker'])){$time = $_POST['timepicker'];}
//}
echo "$name <br/>"; echo "$phone <br/>"; echo "$call <br/>"; echo "$email <br/>"; echo "$specialist <br/>"; echo "$service <br/>"; echo "$message <br/>"; echo "$date <br/>"; echo "$time <br/>"; //всё хорошо


$mysqli = @new mysqli('localhost', 'root', '0000', 'feedback_form');
//if ($mysqli) {echo 'MySQL was connected';}else{echo 'MySQL was not connected';} // MySQL was connected

//mysqli_query("SET NAMES 'utf-8");
//mysqli_query("SET CHARACTER SET 'utf-8'");

$sql = "CREATE TABLE IF NOT EXISTS `feedbackValue` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(30) NOT NULL UNIQUE,
  `coll` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `specialist` VARCHAR(255) NOT NULL,
  `service` VARCHAR(255) NOT NULL,
  `message` VARCHAR(255) NOT NULL,
  `data` DATE NOT NULL,
  `time` TIME NOT NULL,
  `creation_date` TIMESTAMP
)  CHARACTER SET utf8 COLLATE utf8_bin";

//if ($mysqli->query($sql) == true){echo "yes";}else{echo "no";}

$mysqli->query('SET NAMES utf8');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $insert = $mysqli->query("INSERT INTO feedbackValue(`name`, `phone`, `coll`, `email`, `specialist`, `service`, `message`, `data`, `time`) VALUES(\"$name\",\"$phone\",\"$call\",\"$email\",\"$specialist\",\"$service\",\"$message\",\"$date\",\"$time\")");

//    if($insert){
//        print 'Success! Total ' .$mysqli->affected_rows .' rows added.<br />';
//    }else{
//        die('Error : ('. $mysqli->errno .') '. $mysqli->error);
//    }
}

$mysqli->close();

$to = "den4643@yandex.ru"; // емайл получателя данных из формы
$tema = "Форма обратной связи на PHP"; // тема полученного емайла
$message = "Ваше имя: ".$_POST['name']."<br>";//присвоить переменной значение, полученное из формы name=name
$message .= "Номер телефона: ".$_POST['phone']."<br>"; //полученное из формы name=phone
$message .= "Ранее обращались: ".$_POST['call']."<br>"; //полученное из формы name=call
$message .= "E-mail: ".$_POST['email']."<br>"; //полученное из формы name=email
$message .= "Обращение к специалисту: ".$_POST['priority']."<br>"; //полученное из формы name=priority
$message .= "За услугой: ".$_POST['type']."<br>"; //полученное из формы name=type
$message .= "Сообщение: ".$_POST['message']."<br>"; //полученное из формы name=message
$message .= "Дата: ".$_POST['date']."<br>"; //полученное из формы name=date
$message .= "Время: ".$_POST['timepicker']."<br>"; //полученное из формы name=timepicker
$headers = 'MIME-Version: 1.0' . "\r\n"; // заголовок соответствует формату плюс символ перевода строки
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // указывает на тип посылаемого контента
mail($to, $tema, $message, $headers); //отправляет получателю на емайл значения переменных
//?>


</body>
</html>
