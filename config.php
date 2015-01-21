<?
	/*
	Контроль версий:
	1.0 -> после диплома (июнь 2012)
	1.0.1 -> обновление после диплома (осень 2012)
	>мелкие изменения
	>кодировка
	>запись в файлы (недоделано)
	1.0.2 -> исправление на компьютере ИТА (май 2013) [текущая]
	>параметр ACTIVE работает
	>название БД не имеет значения
	>отключение кнопки в test_list при ACTIVE_LOCK
	
	Возможные места с ошибками:
	>прокрутка body отключена, поэтому некоторые модули могут оказаться без прокрутки
	мобильные и устаревшие браузеры не поддерживают прокрутку блока вообще
	>отключено использование имени базы данных при работе с системой, поэтому некоторые запросы могут не работать

	
	Web-приложение имеет следующую структуру
	Файлы общего назначения:
		- config.php. Содержит значения основных переменных программы;
		- calendar.js. Содержит календарь для некоторых страниц;
		- functions.php. Содержит пользовательские функции;
		- connect.php. Содержит настройки подключения к БД.
		- style.css. Содержит таблицы стилей, общие для всех страниц.
	Страницы, не ограниченные доступом:
		- index.php. Содержит алгоритм авторизации пользователя в системе;
		- test_lister.php. Содержит алгоритм работы пользователя с доступным списком тестов;
		- test_loader.php. Содержит алгоритм прохождения теста и сохранения результата;
	Страница, доступные только администратору:
		- admin.php. Содержит алгоритм работы со списком дисциплин и специальностей;
		- admin/test_list.php. Содержит алгоритм работы с полным списком тестов;
		- admin/test_edit.php. Содержит алгоритм работы с содержимым теста;
		- admin/user_edit.php. Содержит алгоритм работы со списком пользователей;
		- admin/result_list.php. Содержит алгоритм работы со списком результатов;
		- admin/result_loader.php. Содержит алгоритм просмотра выбранного результата;
		- admin/print_form.php. Содержит алгоритм создания печатной формы по выбранному результату.
	*/
	
	//Файл, хранящий основные глобальные значения 
	
	header('Content-Type: text/html; charset=utf-8');//Установка кодировки для данного файла
	error_reporting(E_ERROR); //Выводить только критические ошибки

	$admin_index = 'Prog_ID_admiN'; //Указатель на администратора в глобальном массиве $_SESSION
	$admin_write = 'PGPK_use_THAT_program'; //Указатель на администратора в базе данных. Изменение может нарушить работу программы!
	
	$copy_file_dir = 'D:\tmp\uploads'; //Директория, используемая для хранения входящей информации 
	
	//Название учебного заведения, показываемое в заголовке печатной формы
	define (PGPK,'ГАПОУ ПО &quot;Пензенский многопрофильный колледж&quot;<br>Отделение информационных технологий');
		
	//Выводимое предупреждение в том случае, если JavaScript отключен пользователем
	echo "<noscript><div id='js_alert'>JavaScript отключен! Программа не будет выводить уведомления!</div></noscript>";
	
	//Настройка вывода файла лога на экран
	$log_view_limit = 20; //Лимит записей лога, единовременно выводимых на экран
	$log_show_numbers = true; //Показывать нумерацию строк файла?
	
	//Настройка сохранения лога
	$log_check_admin_panel = true; //Проверять, была ли попытка войти в панель администратора
	$log_check_login_error = true; //Проверять, сколько совершил ошибок пользователь при входе в систему
	$log_check_login_count = 2; //Число ошибок, после которых будет произведена запись в лог (1 или более)
	
	//Автоочищение файла лога
	$log_autoclear_active = false; //Включено? 
	$log_autoclear_max_record_count = ''; //Число записей, при котором инициируется автоочищение
	$log_autoclear_delete_count = ''; //Число единовременно удаляемых записей
	
	//Уведомления о превышении размера файла лога
	$log_attention_active = false; //Включено?
	$log_attention_max_record_count = ''; //Записи, превышая число которых появляется уведомление
	$log_button_delete_count = ''; //Число записей, удаляемых при нажатии на кнопку на сайте
	
	/*ЗАДАЧНИК-----------------------
	
	— проверка количества записей в файле
	— проверка размера файла
	
	
	— страница настроек и очищения файла лога
	— автоматическое очищение файла
	— предупреждения о превышении размера файла
	
	
	
	*/
	
	
?>