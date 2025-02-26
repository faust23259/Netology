<?php

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;
const OPERATION_UPDATE = 4;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
    OPERATION_UPDATE => OPERATION_UPDATE . '. Измените список покупок.'
];

$items = [];

function displayItems(array $items): void {
    if (count($items)) {
        echo 'Ваш список покупок: ' . PHP_EOL;
        foreach ($items as $item => $quantity) {
            echo "$item - $quantity шт." . PHP_EOL;
        }
    } else {
        echo 'Ваш список покупок пуст.' . PHP_EOL;
    }
}

function getOperations(array $operations): int {
    do {
        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
        $operationNumber = trim(fgets(STDIN));

        if (!array_key_exists($operationNumber, $operations)) {
            system('clear');

            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
        }

    } while (!array_key_exists($operationNumber, $operations));

    return (int)$operationNumber;
}

function addItem(array &$items): void {
    echo "Введите название товара для добавления в список: \n> ";
    $itemName = trim(fgets(STDIN));

    echo "Введите количество товара: \n> ";
    $quantity = (int)trim(fgets(STDIN));

    if (array_key_exists($itemName, $items)) {
        $items[$itemName] += $quantity;
    } else {
        $items[$itemName] = $quantity;
    }
}

function deleteItem(array &$items): void {
    if (empty($items)) {
        echo 'Список покупок пуст.' . PHP_EOL;
        return;
    }

    echo 'Текущий список покупок:' . PHP_EOL;
    displayItems($items);

    echo 'Введите название товара для удаления из списка:' . PHP_EOL . '> ';
    $itemName = trim(fgets(STDIN));

    if (array_key_exists($itemName, $items)) {
        unset($items[$itemName]);
        echo "Товар '$itemName' удален из списка." . PHP_EOL;
    } else {
        echo "Товар '$itemName' не найден в списке." . PHP_EOL;
    }
}

function printItems(array &$items): void {
    echo 'Ваш список покупок: ' . PHP_EOL;
    displayItems($items);
    echo 'Всего ' . count($items) . ' позиций. '. PHP_EOL;
    echo 'Нажмите enter для продолжения';
    fgets(STDIN);
}

function updateItems(array &$items): void {
    if (empty($items)) {
        echo 'Список покупок пуст.' . PHP_EOL;
        return;
    }

    echo 'Текущий список покупок:' . PHP_EOL;
    displayItems($items);

    echo 'Введите название товара для изменения:' . PHP_EOL . '> ';
    $oldItemName = trim(fgets(STDIN));

    if (array_key_exists($oldItemName, $items)) {
        echo 'Введите новое название товара:' . PHP_EOL . '> ';
        $newItemName = trim(fgets(STDIN));

        // Сохраняем количество и удаляем старый товар
        $quantity = $items[$oldItemName];
        unset($items[$oldItemName]);

        // Добавляем новый товар с тем же количеством
        $items[$newItemName] = $quantity;

        echo "Товар '$oldItemName' переименован в '$newItemName'." . PHP_EOL;
    } else {
        echo "Товар '$oldItemName' не найден в списке." . PHP_EOL;
    }
}

do {
    system('cls');
    displayItems($items);
    $operationNumber = getOperations($operations);

    echo 'Выбрана операция: '  . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            addItem($items);
            break;

        case OPERATION_DELETE:
            deleteItem($items);
            break;

        case OPERATION_PRINT:
            printItems($items);
            break;
        
        case OPERATION_UPDATE:
            updateItems($items);
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;
