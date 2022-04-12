<html>
  <head>
  <meta charset="utf-8" />
  <title>Форма</title>
  <link rel="stylesheet" href="style.css">
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
.error {
  border: 2px solid red;
}
    </style>
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

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>

  <header>
        <div id="sect">
            <div id="h1">
                <h1>Отправьте форму!</h1>
            </div>
        </div>
    </header>
    <main>
    
        <div id="content3">
        <section id="form">
                <h2>Форма</h2>
                <form action=""  method="POST">
              <label>
                  Имя:<br />
                  <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" />
              </label><br />
      
               <label>
                  email:<br />
                  <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"
                         type="email" />
              </label><br />
      
              <select id="year" name="year"></select> <br />
        <script>for (let year = 1920; year <= 2022; year++) {
            let options = document.createElement("OPTION");
            document.getElementById("year").appendChild(options).innerHTML = year;
          }
        </script>
      
              Пол:<br />
              <label>
                  <input type="radio"
                         name="radio-group-1" <?php if ($errors['radio-group-1']) {print 'class="error"';} ?>
                         value="male" />
                  Муж
              </label>
              <label>
                  <input type="radio"
                         name="radio-group-1" <?php if ($errors['radio-group-1']) {print 'class="error"';} ?>
                         value="female" />
                  Жен
              </label><br />
      
              Количество конечностей:<br />
              <label>
                  <input type="radio" 
                         name="radio-group-2" <?php if ($errors['radio-group-2']) {print 'class="error"';} ?> 
                         value="1" />
                  1
              </label>
              <label>
                  <input type="radio"
                         name="radio-group-2" <?php if ($errors['radio-group-2']) {print 'class="error"';} ?>
                         value="2" />
                  2
              </label>
              <label>
                  <input type="radio"
                         name="radio-group-2" <?php if ($errors['radio-group-2']) {print 'class="error"';} ?>
                         value="3" />
                  3
              </label>
              <label>
                  <input type="radio"
                         name="radio-group-2" <?php if ($errors['radio-group-2']) {print 'class="error"';} ?> 
                         value="4" />
                  4
              </label><br />
      
              <label>
                  Сверхспособности:
                  <br />
                  <select name="super"
                      multiple="multiple"> <?php if ($errors['super']) {print 'class="error"';} ?> 
                      <option value="Immortality">Бессмертие</option>
                      <option value="Passing through walls">Прохождение сквозь стены</option>
                      <option value="Levitation">Левитвция</option>
                  </select>
              </label><br />
      
              <label>
                  Биография:<br />
                  <textarea name="bio"
                  <?php print $values['bio']; ?></textarea> 
              </label><br />
      
      
              Чекбокс:<br />
              <label>
                  <input type="checkbox"
                         name="check" value="Yes"/>
                  С контрактом ознакомлен
              </label><br />
      
              Отправить данные:
              <input type="submit" value="Отправить" />
          </form>
        </section>
        </div>
    </main>
</body>
</html>
