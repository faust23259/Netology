<?php

function generateSchedule($year, $month) {
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $schedule = [];

    $workDayCounter = 0; // Счетчик для отслеживания цикла "сутки через двое"
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $currentDate = new DateTime("$year-$month-$day");
        $dayOfWeek = $currentDate->format('N'); // 1 (понедельник) - 7 (воскресенье)

        // Определяем, является ли день рабочим
        if ($workDayCounter % 3 == 0) { // Рабочий день (каждый 3-й день)
            if ($dayOfWeek >= 6) { // Если рабочий день выпадает на выходные
                // Переносим рабочий день на понедельник
                $day += (8 - $dayOfWeek); // Переходим на понедельник
                if ($day > $daysInMonth) {
                    break; // Если вышли за пределы месяца, завершаем
                }
                $currentDate = new DateTime("$year-$month-$day");
                $dayOfWeek = $currentDate->format('N');
                $schedule[$day] = 'work'; // Рабочий день
            } else {
                $schedule[$day] = 'work'; // Рабочий день
            }
            $workDayCounter = 1; // Сбрасываем счетчик
        } else {
            $schedule[$day] = ($dayOfWeek >= 6) ? 'weekend' : 'off'; // Выходной или выходные
            $workDayCounter++;
        }
    }

    // Вывод расписания
    $monthName = DateTime::createFromFormat('!m', $month)->format('F');
    echo "$monthName $year \n";

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $currentDate = new DateTime("$year-$month-$day");
        $dayOfWeek = $currentDate->format('N'); // 1 (понедельник) - 7 (воскресенье)

        if (isset($schedule[$day]) && $schedule[$day] === 'work') {
            echo "\033[32m$day\033[0m "; // Рабочий день выделен зеленым и знаком (+)
        } elseif ($dayOfWeek >= 6) {
            echo "\033[31m$day\033[0m "; // Суббота и воскресенье выделены красным
        } else {
            echo "$day "; // Обычные выходные дни
        }
    }
    echo "\n";
}

// Чтение данных из стандартного ввода
echo 'Введите год: ' . PHP_EOL . '> ';
$year = trim(fgets(STDIN));
echo 'Введите месяц: ' . PHP_EOL . '> ';
$month = trim(fgets(STDIN));

generateSchedule($year, $month);