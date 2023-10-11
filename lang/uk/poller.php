<?php

return [
    'settings' => [
        'settings' => [
            'poller_groups' => [
                'description' => 'Призначені групи',
                'help' => 'Цей вузол буде виконувати операції лише на пристроях у вказаних групах опитувача.',
            ],
            'poller_enabled' => [
                'description' => 'Опитувач увімкнено',
                'help' => 'Увімкнути процеси опитування на цьому вузлі.',
            ],
            'poller_workers' => [
                'description' => 'Процеси опитування',
                'help' => 'Кількість процесів опитування що будуть створюватися на цьому вузлі.  Занадто велика кількість може призвести до перевантаження.',
            ],
            'poller_frequency' => [
                'description' => 'Частота опитування (Обережно!)',
                'help' => 'Як часто опитувати пристрої на цьому вузлі.  Обережно! Зміна цього параметра без змін до файлів rrd зламає графіки. Зверніться до документації.',
            ],
            'poller_down_retry' => [
                'description' => 'Повтор для недосяжних',
                'help' => 'Якщо пристрій недосяжний при спробі опитування, повторну спробу буде здійснено згідно цього налаштування.',
            ],
            'discovery_enabled' => [
                'description' => 'Віднайдення увімкнено',
                'help' => 'Увімкнути процеси віднайдення на цьому вузлі.',
            ],
            'discovery_workers' => [
                'description' => 'Процеси віднайдення',
                'help' => 'Кількість процесів віднайдення що будуть створюватися на цьому вузлі.  Занадто велика кількість може призвести до перевантаження.',
            ],
            'discovery_frequency' => [
                'description' => 'Частота віднайдення',
                'help' => 'Як часто запускати віднайдення пристроїв на цьому вузлі.  За замовчуванням 4 рази на день.',
            ],
            'services_enabled' => [
                'description' => 'Сервіси увімкнено',
                'help' => 'Увімкнути процеси сервісів на цьому вузлі.',
            ],
            'services_workers' => [
                'description' => 'Процеси сервісів',
                'help' => 'Кількість процесів сервісів на цьому вузлі.',
            ],
            'services_frequency' => [
                'description' => 'Частота сервісів',
                'help' => 'Як часто запускати перевірку сервісів на цьому вузлі.  Має співпадати з частотою опитувача.',
            ],
            'billing_enabled' => [
                'description' => 'Білінг увімкнено',
                'help' => 'Увімкнути процес білінгу на цьому вузлі.',
            ],
            'billing_frequency' => [
                'description' => 'Частота білінгу',
                'help' => 'Як часто збирати дані білінгу на цьому вузлі.',
            ],
            'billing_calculate_frequency' => [
                'description' => 'Частота обчислення білінгу',
                'help' => 'Як часто обчислювати використання ресурсів на цьому вузлі.',
            ],
            'alerting_enabled' => [
                'description' => 'Сповіщення увімкнено',
                'help' => 'Увімкнути процес сповіщення на цьому вузлі.',
            ],
            'alerting_frequency' => [
                'description' => 'Частота сповіщення',
                'help' => 'Як часто правила сповіщень обчислюються на цьому вузлі.  Врахуйте що дані оновлюються лише з інтервалом опитування.',
            ],
            'ping_enabled' => [
                'description' => 'Швидкий Ping увімкнено',
                'help' => 'Швидкий Ping надсилає запит ping на пристрої для перевірки їх доступності',
            ],
            'ping_frequency' => [
                'description' => 'Частота Ping',
                'help' => 'Як часто перевіряти ping на цьому вузлі.  Обережно! При зміні цього параметра необхідні додаткові дії.  Зверніться до документації Fast Ping.',
            ],
            'update_enabled' => [
                'description' => 'Щоденне обслуговування увімкнено увімкнено',
                'help' => 'Запускати скрипт обслуговування daily.sh після чого рестартувати сервіс диспетчер.',
            ],
            'update_frequency' => [
                'description' => 'Частота обслуговування',
                'help' => 'Як часто запускати щоденне обслуговування на цьому вузлі. За замовчуванням 1 день. Рекомендовано не змінювати це значення.',
            ],
            'loglevel' => [
                'description' => 'Рівень логування',
                'help' => 'Рівень логування сервіса диспетчера.',
            ],
            'watchdog_enabled' => [
                'description' => 'Наглядач увімкнено',
                'help' => 'Наглядач читає лог файл та перезапускає сервіс якщо не бачить свіжих записів',
            ],
            'watchdog_log' => [
                'description' => 'Лог файл для нагляду',
                'help' => 'За замовчуванням лог файл KartsNMS.',
            ],
        ],
        'units' => [
            'seconds' => 'Секунди',
            'workers' => 'Процеси',
        ],
    ],
];
