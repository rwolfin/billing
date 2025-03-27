<?php
session_start();
require_once 'functions.php';

$user = getCurrentUser();
$remaining_time = 0;
$birthday_message = '';

if ($user) {
    // Расчёт времени акции
    $login_time = $_SESSION['login_time'] ?? time();
    $remaining_time = ($login_time + 86400) - time();
    
    // Проверка дня рождения
    $users = getUsersList();
    $birthday = new DateTime($users[$user]['birthday']);
    $today = new DateTime('today');
    $birthday->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));
    
    if ($birthday < $today) {
        $birthday->modify('+1 year');
    }
    
    $days_to_birthday = $today->diff($birthday)->days;
    
    if ($days_to_birthday === 0) {
        $birthday_message = "С днём рождения! Ваша скидка 5%";
    } else {
        $birthday_message = "До дня рождения осталось дней: $days_to_birthday";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPA салон - Ваш отдых и красота</title>
    <link rel="stylesheet" href="css/main.css">
</head> 

<body>
    <header>
        <div class="container">
            <h1>SPA салон "Гармония"</h1>
            <?php if ($user): ?>
                <div class="user-info">
                    Здравствуйте, <?= htmlspecialchars($user) ?>
                    <?php if ($birthday_message): ?>
                        <div class="birthday-message"><?= htmlspecialchars($birthday_message) ?></div>
                    <?php endif; ?>
                    <a href="logout.php">Выйти</a>
                </div>
            <?php endif; ?>
        </div>
        <nav class="main-nav">
            <div class="nav-container">
                <ul class="menu">
                    <li><a href="#discounts">Скидки</a></li>
                    <li><a href="#about">О нас</a></li>
                    <li><a href="#interior">Интерьер</a></li>
                    <li><a href="#reviews">Отзывы</a></li>
                    <li><a href="#articles">Статьи</a></li>
                    <li><a href="#vacancies">Вакансии</a></li>
                    <li><a href="#contacts">Контакты</a></li>
                </ul>
                <?php if ($user): ?>
                    <a href="/account" class="personal-account">Личный кабинет</a>
                <?php else: ?>
                    <a href="login.php" class="personal-account">Войти</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <div class="container">
        <section class="promo">
            <h2>Персональная скидка 20% на все услуги!</h2>
            <p>До конца акции осталось:</p>
            <div id="timer">24:00:00</div>
        </section>

        <section class="services">
            <div class="service-card flex">
                <div class="col">
                <img src="img/2.jpg" alt="">
                </div>
                <div class="col">
                <h3>Массаж</h3>
                <p>Расслабляющий массаж всего тела</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2850₽ (с учётом скидки 5%)' : '3000₽'; ?></p>
                </div>
            </div>
            <div class="service-card">
                <img src="img/1.jpg" alt="">
                <h3>Обертывание</h3>
                <p>Антицеллюлитное обертывание</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2375₽ (с учётом скидки 5%)' : '2500₽'; ?></p>
            </div>
        </section>



        <div class="container">
           <h2> Услуги - вид №2</h2>
        </div>            

        <section class="services">
            <div class="service-card">
                <img src="img/2.jpg" alt="">
                <h3>Массаж</h3>
                <p>Расслабляющий массаж всего тела</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2850₽ (с учётом скидки 5%)' : '3000₽'; ?></p>
            </div>
            <div class="service-card">
                <img src="img/1.jpg" alt="">
                <h3>Обертывание</h3>
                <p>Антицеллюлитное обертывание</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2375₽ (с учётом скидки 5%)' : '2500₽'; ?></p>
            </div>
            <div class="service-card">
                <img src="img/2.jpg" alt="">
                <h3>Массаж</h3>
                <p>Расслабляющий массаж всего тела</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2850₽ (с учётом скидки 5%)' : '3000₽'; ?></p>
            </div>
            <div class="service-card">
                <img src="img/1.jpg" alt="">
                <h3>Обертывание</h3>
                <p>Антицеллюлитное обертывание</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2375₽ (с учётом скидки 5%)' : '2500₽'; ?></p>
            </div>
            <div class="service-card">
                <img src="img/2.jpg" alt="">
                <h3>Массаж</h3>
                <p>Расслабляющий массаж всего тела</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2850₽ (с учётом скидки 5%)' : '3000₽'; ?></p>
            </div>
            <div class="service-card">
                <img src="img/1.jpg" alt="">
                <h3>Обертывание</h3>
                <p>Антицеллюлитное обертывание</p>
                <p>Цена: <?php echo $user && $days_to_birthday === 0 ? '2375₽ (с учётом скидки 5%)' : '2500₽'; ?></p>
            </div>
            <!-- Другие услуги по аналогии -->
        </section>
    </div>

    <script>
        <?php if ($user): ?>
        // Используем серверное время для таймера
        const serverStartTime = <?php echo $login_time * 1000; ?>;
        const timeLimit = 24 * 60 * 60 * 1000; // 24 часа в миллисекундах

        function updateTimer() {
            const currentTime = Date.now();
            const elapsed = currentTime - serverStartTime;
            const remaining = timeLimit - elapsed;

            if (remaining <= 0) {
                document.getElementById('timer').innerHTML = 'Акция завершена';
                return;
            }

            const hours = Math.floor(remaining / (60 * 60 * 1000));
            const minutes = Math.floor((remaining % (60 * 60 * 1000)) / (60 * 1000));
            const seconds = Math.floor((remaining % (60 * 1000)) / 1000);

            document.getElementById('timer').innerHTML = 
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        setInterval(updateTimer, 1000);
        updateTimer();
        <?php else: ?>
        document.getElementById('timer').innerHTML = 'Войдите для получения персональной скидки';
        <?php endif; ?>
    </script>
</body>
</html>