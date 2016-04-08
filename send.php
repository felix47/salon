<?php
if((isset($_POST['date'])&&$_POST['date']!="")&&(isset($_POST['name'])&&$_POST['name']!="")&&(isset($_POST['phone'])&&$_POST['phone']!="")){ //Проверка отправилось ли наше поля name и не пустые ли они
        $to = 'admin@ekaterinahotel.com,info@ekaterinahotel.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $subject = 'Запрос мероприятия'; //Загаловок сообщения
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Дата начала: '.$_POST['date'].'</p>
                        <p>Дата окончания: '.$_POST['date1'].'</p>
                        <p>Кол-во гостей: '.$_POST['value_guest'].'</p>
                        <p>Предыдущее место: '.$_POST['prev_place'].'</p>
                        <p>Кол-во номеров: '.$_POST['value_room'].'</p>
                        <p>Дата заезда: '.$_POST['date3'].'</p>
                        <p>Дата отъезда: '.$_POST['date4'].'</p>
                        <p>Пожелание: '.$_POST['wish'].'</p>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Фамилия: '.$_POST['surname'].'</p>
                        <p>Компания: '.$_POST['company'].'</p>
                        <p>Адрес: '.$_POST['address'].'</p>
                        <p>Город: '.$_POST['city'].'</p>
                        <p>Почтовый адрес: '.$_POST['post_address'].'</p>
                        <p>Телефон: '.$_POST['phone'].'</p>
                        <p>Email: '.$_POST['email'].'</p>
                        <p>Связь по Email: '.$_POST['link_email'].'</p>
                        <p>Связь по телефону: '.$_POST['link_email'].'</p>
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: С сайта <info@ekaterinahotel.com>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
}
?>