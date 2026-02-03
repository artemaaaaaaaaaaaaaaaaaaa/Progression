<?php
declare(strict_types=1);

namespace artemaaaaaaaaaaaaaaaaaaa\progression\View;

use function cli\line;
use function cli\prompt;

function showWelcome(): void
{
    line('Добро пожаловать в игру "Арифметическая прогрессия"!');
    line('Вы увидите прогрессию из 10 чисел с пропуском.');
    line('Ваша задача — определить пропущенное число.');
    line('');
}

function askPlayerName(): string
{
    $name = trim((string) prompt('Введите ваше имя'));
    if ($name === '') {
        $name = 'Игрок';
    }
    line("Привет, {$name}!");
    return $name;
}

function promptMenu(): string
{
    line('');
    line('Выберите действие:');
    line('1) Играть');
    line('2) История');
    line('0) Выход');

    return trim((string) prompt('Ваш выбор'));
}

function showQuestion(string $progression): void
{
    line('');
    line('Вопрос:');
    line($progression);
}

function askAnswer(): string
{
    return trim((string) prompt('Ваш ответ'));
}

function showCorrect(): void
{
    line('Верно!');
}

function showWrong(string $fullProgression, string $missingValue): void
{
    line('Неверный ответ.');
    line("Правильная прогрессия: {$fullProgression}");
    line("Пропущенное число: {$missingValue}");
}

function showHistory(array $rows): void
{
    line('');
    line('История игр:');

    if ($rows === []) {
        line('Пока нет сыгранных игр.');
        return;
    }

    line(str_pad('Дата', 20) . str_pad('Игрок', 18) . str_pad('Результат', 10) . 'Прогрессия (с пропуском) / Пропущенное');
    foreach ($rows as $row) {
        $result = ((int) $row['is_win'] === 1) ? 'победа' : 'поражение';
        $lineText = str_pad((string) $row['played_at'], 20)
            . str_pad((string) $row['player_name'], 18)
            . str_pad($result, 10)
            . (string) $row['shown_progression']
            . ' / '
            . (string) $row['missing_value'];
        line($lineText);
    }
}
