<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['radio-group-1'] = !empty($_COOKIE['radio-group-1_error']);
  $errors['radio-group-2'] = !empty($_COOKIE['radio-group-2_error']);
  $errors['super'] = !empty($_COOKIE['super_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  
  $errors2 = array();
  $errors2['name'] = !empty($_COOKIE['name_error2']);
  $errors2['email'] = !empty($_COOKIE['email_error2']);
  // TODO: аналогично все поля.

  // Выдаем сообщения об ошибках.
  if ($errors['name']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('name_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Заполните email.</div>';
  }
  if ($errors['radio-group-1']) {
    setcookie('radio-group-1_error', '', 100000);
    $messages[] = '<div class="error">Заполните пол.</div>';
  }
  if ($errors['radio-group-2']) {
    setcookie('radio-group-2_error', '', 100000);
    $messages[] = '<div class="error">Заполните количество конечностей.</div>';
  }
  if ($errors['super']) {
    setcookie('super_error', '', 100000);
    $messages[] = '<div class="error">Заполните суперспособности.</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages[] = '<div class="error">Заполните биографию.</div>';
  }
  
  if ($errors2['name']) {
    setcookie('name_error2', '', 100000);
    $messages[] = '<div class="error">Неверный формат имени. Допустимы только буквы.</div>';
  }
  if ($errors2['email']) {
    setcookie('email_error2', '', 100000);
    $messages[] = '<div class="error">Неверный формат email. Допустимы латинские буквы, цифры, знак подчеркивания. Пример: login@domen.ru</div>';
  }
  // TODO: тут выдать сообщения об ошибках в других полях.

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year'];
  $values['radio-group-1'] = empty($_COOKIE['radio-group-1_value']) ? '' : $_COOKIE['radio-group-1_value'];
  $values['radio-group-2'] = empty($_COOKIE['radio-group-2_value']) ? '' : $_COOKIE['radio-group-2_value'];
  $values['super'] = empty($_COOKIE['super_value']) ? '' : $_COOKIE['super_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];
  // TODO: аналогично все поля.

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  $errors = FALSE;
  $errors2 = FALSE;
  if (empty($_POST['name'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['email'])) {
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['radio-group-1'])) {
    setcookie('radio-group-1_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('radio-group-1_value', $_POST['radio-group-1'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['radio-group-2'])) {
    setcookie('radio-group-2_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('radio-group-2_value', $_POST['radio-group-2'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['super'])) {
    setcookie('super_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('super_value', $_POST['super'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['bio'])) {
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
  }
  
  
  if (!preg_match("/^[a-zа-яё]+$/i", $_POST['name']) && ("" != $_POST['name'])) {
    setcookie('name_error2', '1', time() + 24 * 60 * 60);
    $errors2 = TRUE;
  }
  else {
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  } 
  
  if (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $_POST['email']) && ("" != $_POST['email'])) {
    setcookie('email_error2', '1', time() + 24 * 60 * 60);
    $errors2 = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  } 

  setcookie('check_value', $_POST['check'], time() + 30 * 24 * 60 * 60);
  
// *************
// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
// Сохранить в Cookie признаки ошибок и значения полей.
// *************

  if ($errors || $errors2) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('radio-group-1_error', '', 100000);
    setcookie('radio-group-2_error', '', 100000);
    setcookie('super_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('name_error2', '', 100000);
    setcookie('email_error2', '', 100000);
    // TODO: тут необходимо удалить остальные Cookies.
  }

  // Сохранение в БД.
  // ...
  $user = 'u41181';
$pass = '2342349';
$db = new PDO('mysql:host=localhost;dbname=u41181', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
  $stmt = $db->prepare("INSERT INTO form (name, email, year, sex, number_of_limbs, superpowers, biography, checkbox) 
  VALUES (:name, :email, :year, :sex, :number_of_limbs, :superpowers, :biography, :checkbox)");
  
  $stmt -> bindParam(':name', $name);
  $stmt -> bindParam(':email', $email);
  $stmt -> bindParam(':year', $year);
  $stmt -> bindParam(':sex', $sex);
  $stmt -> bindParam(':number_of_limbs', $number_of_limbs);
  $stmt -> bindParam(':superpowers', $superpowers);
  $stmt -> bindParam(':biography', $biography);
  $stmt -> bindParam(':checkbox', $checkbox);
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $year = $_POST['year'];
  $sex = $_POST['radio-group-1'];
  $number_of_limbs = $_POST['radio-group-2'];
  $superpowers = $_POST['super'];
  $biography = $_POST['bio'];
  if (empty($_POST['check']))
    $checkbox = "No";
  else
    $checkbox = $_POST['check'];
  
  $stmt->execute();
}
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
}

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
