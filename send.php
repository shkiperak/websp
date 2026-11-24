<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: https://gidrodel.ru/');
    exit;
}

if (!empty($_POST['website'])) {
    header('Location: https://gidrodel.ru/');
    exit;
}

$work_type = isset($_POST['work_type']) ? trim(strip_tags($_POST['work_type'])) : '';
$name      = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$phone     = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$details   = isset($_POST['details']) ? trim(strip_tags($_POST['details'])) : '';

if ($phone === '') {
    echo '<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Ошибка</title></head><body style="font-family:sans-serif;text-align:center;padding:60px 20px;"><h2>Пожалуйста, укажите номер телефона</h2><p><a href="https://gidrodel.ru/#s2" style="display:inline-block;margin-top:16px;padding:12px 28px;background:#0088cc;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;">Вернуться к форме</a></p></body></html>';
    exit;
}

$to = 'gidrodel2366@yandex.ru';
$subject_text = 'Новая заявка с сайта ГидроДел';
$subject = '=?UTF-8?B?' . base64_encode($subject_text) . '?=';

$message  = "Новая заявка с сайта gidrodel.ru\n";
$message .= "----------------------------------------\n";
$message .= "Телефон: " . $phone . "\n";
$message .= "Имя: " . ($name !== '' ? $name : 'Не указано') . "\n";
$message .= "Вид работ: " . ($work_type !== '' ? $work_type : 'Не указан') . "\n";
$message .= "Подробнее: " . ($details !== '' ? $details : 'Нет') . "\n";
$message .= "----------------------------------------\n";
$message .= "Дата: " . date('d.m.Y H:i') . "\n";

$headers  = "From: GidroDel <no-reply@gidrodel.ru>\r\n";
$headers .= "Reply-To: no-reply@gidrodel.ru\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";

$sent = @mail($to, $subject, $message, $headers, '-fno-reply@gidrodel.ru');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sent ? 'Заявка отправлена | ГидроДел' : 'Ошибка отправки | ГидроДел'; ?></title>
    <link rel="icon" type="image/png" href="img/imglogo.png">
</head>
<body style="margin:0;font-family:Roboto,Arial,sans-serif;background:#f5f5f5;color:#222;display:flex;align-items:center;justify-content:center;min-height:100vh;padding:20px;">
    <div style="background:#fff;max-width:480px;width:100%;padding:40px 30px;border-radius:10px;box-shadow:0 4px 20px rgba(0,0,0,0.08);text-align:center;">
        <?php if ($sent): ?>
            <h1 style="margin:0 0 12px;font-size:26px;color:#0088cc;">Заявка отправлена!</h1>
            <p style="margin:0 0 28px;font-size:16px;line-height:1.5;color:#555;">Спасибо за обращение. Наш инженер свяжется с вами в ближайшее время.</p>
        <?php else: ?>
            <h1 style="margin:0 0 12px;font-size:24px;color:#cc2200;">Не удалось отправить заявку</h1>
            <p style="margin:0 0 28px;font-size:16px;line-height:1.5;color:#555;">Пожалуйста, позвоните нам напрямую: <a href="tel:+78129246044" style="color:#0088cc;font-weight:bold;">+7 812 924-60-44</a>.</p>
        <?php endif; ?>
        <a href="https://gidrodel.ru/" style="display:inline-block;padding:12px 28px;background:#0088cc;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;font-size:15px;">Вернуться на сайт</a>
    </div>
</body>
</html>