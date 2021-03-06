# coding=utf-8

# Скрипт написан для Python3

# Необходимо уставноаить pip install requests
import requests


class BibinetAPI(object):
    def __init__(self):
        pass

    def get_url(self, url):
        json_data = {}
        try:
            o = requests.get(url)
            json_data = o.json()
        except Exception as e:
            print(e)
        return json_data

    def get_tovar(self, type_tovar, id=None, invnn=None):
        """
        Возвращает словарь данных по товару.
        Входные параметры:
            type_tovar - тип товара:
                contracts - контрактные запчасти
                newparts - новые запчасти
                tires - шины
                wheels - диски
            id - идентификатор товара
            invnn - инвентарный номер товара (если есть)
        """

        if type_tovar == "contracts":
            url = "https://bibinet.ru/service/search/used_parts?ver_api=v3&ver2=1&format=json&onerow&"
        elif type_tovar == "newparts":
            url = "https://bibinet.ru/service/search/new_parts_v1?ver_api=v3&onerow&"
        elif type_tovar == "tires":
            url = "https://bibinet.ru/service/search/tires?ver_api=v3&"
        elif type_tovar == "wheels":
            url = "https://bibinet.ru/service/search/wheels?ver_api=v3&"
        else:
            raise Exception("Не верный тип товара!")

        if not invnn and not id:
            raise Exception("Не указан invnn или id")

        if invnn:
            url += "invnn=%s" % invnn
        else:
            url += "id=%s" % id

        return self.get_url(url)


""" Пример использования """

bibinet_obj = BibinetAPI()

# Наименование параметров
contracts_label = {
    'company': {
        'sb_phone': 'Телефоны',
        'sco_site': 'Сайт',
        'sb_address': 'Адрес',
        'sco_name': 'Название компании',
        'sco_id': 'ID компании',
        'ratio': 'Рейтинг',
        'sc_name': 'Город',
        'ya_lat': 'Координаты на карте. Широта',
        'ya_long': 'Координаты на карте. Долгота',
    },
    'data': {
        'sma_name': 'Марка',
        'smo_name': 'Модель',
        'photos': 'Фото',
        'sf_name': 'Кузов',
        'year_period_model': 'Период выпуска',
        'sma_name_ru': 'Марка по-русски',
        'spt_name': 'Наименование запчасти',
        'sup_part_comment': 'Комментарий',
        'sup_discount': 'Процент скидки',
        'part_status': 'Статус',
        'last_edit': 'Дата публикации',
        'smo_name_ru': 'Модель по-русски',
        'sup_invnn': 'Инвентарный номер',
        'id': 'ID товара',
        'sb_id': 'ID филиала',
        'price': 'Цена',
        'se_name': 'Двигатель',
        'position': 'Расположение',
        'sup_device_code': 'Код производителя',
        'sup_oem_code': 'OEM код'
    }
}

# Получаем данные по товару. Контрактные запчасти.
contracts_data = bibinet_obj.get_tovar("contracts", invnn='408-3783-3149040')

# Выводим параметры товара
if contracts_label and 'data' in contracts_data:
    for key in contracts_label['data']:
        if key in contracts_data['data'] and contracts_data['data'][key]:
            if key == 'year_period_model':
                val = contracts_data['data'][key][0]
            elif key == 'photos':
                val = []
                for ph in contracts_data['data'][key]['part']:
                    # размеры фотографий можно ставить свои 800x600, 100x100, ... , 800x0 если с левой или с правой стороны стоит 0 то авторасчет ширины или высоты
                    val.append('https://img.bibinet.ru%(path)s-%(photo)s_c800x0.jpg' % {
                        'path': contracts_data['data'][key]['path'],
                        'photo': ph
                    })
            else:
                val = contracts_data['data'][key]
            print(contracts_label['data'][key], ': ', val)

    print("\n", "-= Компания продавец =-", "\n")
    for key in contracts_label['company']:
        if key in contracts_data['company'] and contracts_data['company'][key]:
            val = contracts_data['company'][key]
            print(contracts_label['company'][key], ': ', val)
else:
    print('Данные не найдены.')
