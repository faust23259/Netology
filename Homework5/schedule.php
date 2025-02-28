<?php
function generateSchedule($year, $month, &$lastWorkDay = null) {
    $daysInMonth = date('t', strtotime("$year-$month-01"));
    $schedule = array_fill(1, $daysInMonth, false);
    
    $currentDay = 1;
    $nextWorkDay = 1;
    
    while ($currentDay <= $daysInMonth) {
        $date = new DateTime("$year-$month-$currentDay");
        $dow = $date->format('N');
        
        // Проверка на выходные
        if ($dow >= 6) {
            // Перенос на понедельник
            $date->modify('next monday');
            if ($date->format('n') != $month) break;
            $currentDay = $date->format('j');
        }
        
        $schedule[$currentDay] = true;
        $lastWorkDay = $currentDay;
        
        // Пропускаем 2 выходных дня
        $currentDay += 3;
    }
    
    return $schedule;
}

function printCalendar($year, $month, $schedule) {
    $monthName = date('F Y', strtotime("$year-$month-01"));
    echo "\033[1;34m$monthName\033[0m\n";
    
    $daysInMonth = count($schedule);
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $date = new DateTime("$year-$month-$day");
        $dow = $date->format('N');
        
        $output = str_pad($day, 2, ' ', STR_PAD_LEFT);
        if ($schedule[$day]) {
            $output = "\033[32m" . $output . "\033[0m";
        } elseif ($dow >= 6) {
            $output = "\033[31m" . $output . "\033[0m";
        }
        
        echo $output . " ";
        if ($dow == 7) echo "\n";
    }
    echo "\n\n";
}

$year = date('Y');
$month = date('n');
$monthsCount = 1;

if ($argc > 1) {
    $year = (int)$argv[1];
    $month = (int)$argv[2] ?? $month;
    $monthsCount = (int)($argv[3] ?? 1);
}

$lastWorkDay = null;
for ($i = 0; $i < $monthsCount; $i++) {
    $currentMonth = $month + $i;
    $currentYear = $year + intdiv($currentMonth - 1, 12);
    $currentMonth = ($currentMonth - 1) % 12 + 1;
    
    $schedule = generateSchedule($currentYear, $currentMonth, $lastWorkDay);
    printCalendar($currentYear, $currentMonth, $schedule);
}