<?php

$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$languages = []; 

try {
    $stmt = $db->prepare("SELECT * FROM p_languages;");
    $stmt->execute(); 

 
    $languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
}
?>

<html lang="ru">

<head>
    <link rel="icon" type="image/x-icon" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Задание 4</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>
<?php

if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }


  print('</div>');
}


?>

    <div class="col col-10 col-md-6" id="forma">
        <form id="form1" action="" method="POST">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input name="fio" id="name" class="form-control <?php if ($errors['fio']) {print 'is-invalid';} ?>" placeholder="Введите ваше имя"  value="<?php print $values['fio']; ?>">
            </div>
            <div class="form-group">
                <label for="tel">Телефон:</label>
                <input type="tel" name="tel" id="tel" class="<?php if ($errors['tel']) {print 'error';} ?> form_input _req form-control w-50 shadow bg-white rounded"
                value="<?php print $values['tel']; ?>" placeholder="Введите телефон" />
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>

                <input name="email" type="email" class="<?php if ($errors['email']) {print 'error';} ?> form_input _req _email form-control w-50 shadow bg-white rounded"
                value="<?php print $values['email']; ?>" placeholder="Введите E-mail" />

            </div>
            <div class="form-group">

                Дата рождения:
                <input name="date_of_birth" type="date" class="form-control <?php if ($errors['date_of_birth']) {print 'is-invalid';} ?>" value="<?php print $values['date_of_birth']; ?>" />

            </div>
            <div class="form-group">
                Пол:
                <label for="g1"><input type="radio" class="form-check-input <?php if ($errors['gender']) {print 'is-invalid';} ?>" name="gender" id="g1" value="m" <?php if ($values['gender']=='m') {print 'checked';} ?>>
                    Мужской</label>
                <label for="g2"><input type="radio" class="form-check-input <?php if ($errors['gender']) {print 'is-invalid';} ?>" name="gender" id="g2" value="w" <?php if ($values['gender']=='w') {print 'checked';} ?>>
                    Женский</label>
            </div>
            <div class="form-group">
                <label for="mltplslct">Любимые языки программирования:</label>
                <select class="form-control <?php if ($errors['languages']) {print 'is-invalid';} ?>" name="languages[]" id="mltplslct" multiple="multiple">
                <?php foreach ($languages as $language): ?>
            <option value="<?= htmlspecialchars($language['id']); ?>" 
                <?php if (!empty($values['languages']) && in_array($language['id'], $values['languages'])) {echo 'selected';} ?>>
                <?= htmlspecialchars($language['title']); ?>
            </option>
        <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="bio">Биография:</label>
                <textarea name="bio" id="bio" rows="3" class="form-control <?php if ($errors['bio']) {print 'is-invalid';} ?>" ><?php print $values['bio']; ?></textarea>
            </div>
            <label><input type="checkbox" class="form-check-input <?php if ($errors['checkbox']) {print 'is-invalid';} ?>" id="checkbox" value="1" name="checkbox" <?php if ($values['checkbox']=='1') {print 'checked';} ?>>
                с контрактом ознакомлен (а) </label><br>
            <input type="submit" id="btnend" class="btn btn-primary" value="Отправить">
        </form>
    </div>
</body>