<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>bibinet запрос для получения подробностей запчасти</title>
        <style>
            .vh{
                background: red;
                height:10px;
                margin:30px 0;
            }
        </style>
    </head>
    <body>
		<h1>Подробная информация о товаре</h1>


		<?php require $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . 'env.php';?>

		<h2>Для контрактных запчастей</h2>
		<?php
			// КОНТРАКТНЫЕ ЗАПЧАСТИ
			// В функцию надо передавать инвентарный номер если его нето то ID запчасти - это первым параметром
			// Вторым патаметром тип, если это инвентарный номер то 'invnn' если ID то 'id'
			$part_data =  get_UsedPartInfo('34813-34770-E1025210043', 'invnn'); // Или если нет инвентарного номера то get_UsedPartInfo('77129674', 'id');
            $part = $part_data['data'];
			echo "<h3>Товар:</h3>";
			echo "<div>Инвентарный номер: ".$part['sup_invnn']."</div>";
			echo "<div>Наименование: ".$part['spt_name']."</div>";
            if($part['sma_name']) echo "<div>Марка: ".$part['sma_name']."</div>";
            if($part['smo_name']) echo "<div>Модель: ".$part['smo_name']."</div>";
            if($part['sf_name']) echo "<div>Кузов: ".$part['sf_name']."</div>";
			if($part['se_name']) echo "<div>Двигатель: ".$part['se_name']."</div>";

            if($part['position']) echo "<div>Рассположение: ".$part['position']."</div>";
            if($part['sup_device_code']) echo "<div>Код производителя: ".$part['sup_device_code']."</div>";
            if($part['sup_oem_code']) echo "<div>OEM код: ".$part['sup_oem_code']."</div>";

            if($part['sup_price']) echo "<div>Цена: ".$part['sup_price']."</div>";
            if($part['sup_part_comment']) echo "<div>Дополнительное описание: ".$part['sup_part_comment']."</div>";
			if($part['photos']){
				echo "<div>Фото: <br/>";
				foreach ($part['photos']['part'] as $value) {
					echo "<img width='200px' src='http://bibinet.ru". $part['photos']['path'] . '-' . $value . "_c800x600.jpg'/>";
					// Можно задавать любые размеры фотографий для получения к примеру 400x300
				}
				echo "</div>";
			}

            $company = $part_data['company'];
			echo "<h3>КОМПАНИЯ:</h3>";
			echo "<div>Название: ".$company['sco_name']."</div>";
			echo "<div>Город: ".$company['sc_name']."</div>";
			echo "<div>Адрес: ".$company['sb_address']."</div>";
			if($company['sco_site'])echo "<div>Сайт: ".$company['sco_site']."</div>";
		?>

        <div class="vh"></div>

        <h2>Для новых запчастей</h2>
        <?php
            // НОВЫЕ ЗАПЧАСТИ
            // В функцию надо передавать инвентарный номер если его нето то ID запчасти - это первым параметром
            // Вторым патаметром тип, если это инвентарный номер то 'invnn' если ID то 'id'
            //$part_data =  get_NewPartInfo('78069102', 'id'); // Или если нет инвентарного номера то get_UsedPartInfo('77129674', 'id');
            $part_data =  get_NewPartInfo('34114-34054-816', 'invnn');
            $part = $part_data['data'];
            echo "<h3>Товар:</h3>";
            echo "<div>Инвентарный номер: ".$part['invnn']."</div>";
            echo "<div>Наименование: ".$part['part_type']."</div>";
            echo "<div>Производитель: ".$part['sp_name']."</div>";

            echo "<div>Код производителя: ".$part['producer_code']."</div>";
            echo "<div>OEM код: ".$part['oem_code']."</div>";

            echo "<div>Цена: ".$part['price']."</div>";
            echo "<div>Дополнительное описание: ".$part['comment']."</div>";
            if($part['photos']){
                echo "<div>Фото: <br/>";
                foreach ($part['photos']['img'] as $value) {
                    echo "<img width='200px' src='http://bibinet.ru". $part['photos']['path'] . '-' . $value . "_c800x600.jpg'/>";
                    // Можно задавать любые размеры фотографий для получения к примеру 400x300
                }
                echo "</div>";
            }

            $company = $part_data['company'];
            echo "<h3>КОМПАНИЯ:</h3>";
            echo "<div>Название: ".$company['sco_name']."</div>";
            echo "<div>Город: ".$company['sc_name']."</div>";
            echo "<div>Адрес: ".$company['sb_address']."</div>";
            if($company['sco_site'])echo "<div>Сайт: ".$company['sco_site']."</div>";
        ?>


        <div class="vh"></div>

        <h2>Для шин</h2>
        <?php
        // Шины
        // В функцию надо передавать инвентарный номер если его нето то ID шины - это первым параметром
        // Вторым патаметром тип, если это инвентарный номер то 'invnn' если ID то 'id'
        //$part_data =  get_TiresInfo('34114-34054-816', 'invnn'); // Или если нет инвентарного номера то get_TiresInfo('77129674', 'id');
        $part_data =  get_TiresInfo('33989-33919-670094830', 'invnn');
        $part = $part_data['data'];
        echo "<h3>Товар:</h3>";
        echo "<div>Инвентарный номер: ".$part['m_invnn']."</div>";

        foreach( [
                    m_carcass=> "Каркас шины",
                    m_is_run_flat=> "Технология RunFlat (true)",
                    m_is_spikes=> "С шипами (true)",
                    m_max_load=> "Индекс нагрузки",
                    m_state=> "Состояние (bu - контрактная, new - новая)",
                    sea_name=> "Сезонность",
                    stc_name=> "Конструкция шины",
                    td_name=> "Диаметр шины",
                    th_name=> "Высота шины",
                    tm_name=> "Марка",
                    tmo_name=> "Модель",
                    tod_name=> "Внешний диаметр шины",
                    tsi_name=> "Индекс скорости",
                    tta_name=> "Тип автомобиля",
                    tw_name=> "Ширина шины",
                    twm_name=> "Ширина шины  метрическая",
        ] as $arr => $v ){
            if($part[$arr]){
                echo "<div>".$v.": ".$part[$arr]."</div>";
            }
        }

        echo "<div>Цена: ".$part['m_price']."</div>";
        echo "<div>Дополнительное описание: ".$part['m_comments']."</div>";
        if($part['photos']){
            echo "<div>Фото: <br/>";
            foreach ($part['photos']['img'] as $value) {
                echo "<img width='200px' src='http://bibinet.ru". $part['photos']['path'] . '-' . $value . "_c800x600.jpg'/>";
                // Можно задавать любые размеры фотографий для получения к примеру 400x300
            }
            echo "</div>";
        }

        $company = $part_data['company'];
        echo "<h3>КОМПАНИЯ:</h3>";
        echo "<div>Название: ".$company['sco_name']."</div>";
        echo "<div>Город: ".$company['sci_name']."</div>";
        echo "<div>Адрес: ".$company['sb_address']."</div>";
        if($company['sco_site'])echo "<div>Сайт: ".$company['sco_site']."</div>";
        ?>


        <div class="vh"></div>

        <h2>Для дисков</h2>
        <?php
        // Диски
        // В функцию надо передавать инвентарный номер если его нето то ID Диски - это первым параметром
        // Вторым патаметром тип, если это инвентарный номер то 'invnn' если ID то 'id'
        //$part_data =  get_WheelsInfo('34114-34054-816', 'invnn'); // Или если нет инвентарного номера то get_WheelsInfo('77129674', 'id');
        $part_data =  get_WheelsInfo('2845-2719-4290002894', 'invnn');
        $part = $part_data['data'];
        echo "<h3>Товар:</h3>";
        echo "<div>Инвентарный номер: ".$part['m_invnn']."</div>";

        foreach( [
                    m_state=> "Состояние (bu - контрактная, new - новая)",
                    wd_name=> "Диаметр диска",
                    wdco_name=> "Диаметр центрального отверстия",
                    wet_name=> "Вылет",
                    wlz_name=> "Количество отверстий под болты",
                    wma_name=> "Марка",
                    wmo_name=> "Модель",
                    wpcd_name=> "Диаметр расположения болтов крепления PCD",
                    wt_name=> "Тип диска",
                    ww_name=> "Ширина"
                 ] as $arr => $v ){
            if($part[$arr]){
                echo "<div>".$v.": ".$part[$arr]."</div>";
            }
        }

        echo "<div>Цена: ".$part['m_price']."</div>";
        echo "<div>Дополнительное описание: ".$part['m_comments']."</div>";
        if($part['photos']){
            echo "<div>Фото: <br/>";
            foreach ($part['photos']['img'] as $value) {
                echo "<img width='200px' src='http://bibinet.ru". $part['photos']['path'] . '-' . $value . "_c800x600.jpg'/>";
                // Можно задавать любые размеры фотографий для получения к примеру 400x300
            }
            echo "</div>";
        }

        $company = $part_data['company'];
        echo "<h3>КОМПАНИЯ:</h3>";
        echo "<div>Название: ".$company['sco_name']."</div>";
        echo "<div>Город: ".$company['sci_name']."</div>";
        echo "<div>Адрес: ".$company['sb_address']."</div>";

        if($company['sco_site'])echo "<div>Сайт: ".$company['sco_site']."</div>";
        ?>
    </body>
</html>
