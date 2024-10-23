import mysql.connector
from logger import Logger
from helpers import do_raise_to_debag
from datetime import datetime
from config.init import (DEBUG)


class MySQLHandler:
    def __init__(self):
        self.do = Logger(__name__)
        self.db = mysql.connector.connect(
            host="MariaDB-10.4",
            user="root",
            passwd="",
            database="xbox_store"
        )
        self.cursor = self.db.cursor()

    def isert_or_update(self, title, price, rating, description, img, time_sale, ganre, relise_date):
        sql = "select id from games where title=%s"
        param = (title,)
        try:
            self.cursor.execute(sql, param)
            result = self.cursor.fetchall()
        except Exception as e:
            self.do.log.exception(f'Error find record by id: {e}\n')
            do_raise_to_debag(DEBUG)

        if not result:
            sql = "insert into games (title, description, rating, full_coast, ea_play_coast, game_pass_coast, time_sale, img, ganre, relise_date) values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
            param = (title, description, rating, price['full_coast'], price['ea_play_coast'], price['game_pass_coast'],
                     time_sale, img, ganre, relise_date)
            try:
                self.cursor.execute(sql, param)
            except Exception as e:
                self.do.log.exception(f'Error insert request: {e}\n')
                do_raise_to_debag(DEBUG)
        else:
            sql = "update games set title=%s, description=%s, rating=%s, full_coast=%s, ea_play_coast=%s, game_pass_coast=%s, time_sale=%s, img=%s, ganre=%s, relise_date=%s, last_update=%s where id=%s"
            param = (title, description, rating, price['full_coast'], price['ea_play_coast'], price['game_pass_coast'],
                     time_sale, img, ganre, relise_date, datetime.now().strftime('%Y-%m-%d %H:%M:%S'), result[0][0],)
            try:
                self.cursor.execute(sql, param)
            except Exception as e:
                self.do.log.exception(f'Error update request: {e}\n')
                do_raise_to_debag(DEBUG)
        self.db.commit()

    def update_rubles_per_lira(self, rubles_per_lira):
        sql = "update course_tur_lirа set rubles_per_lira=%s"
        param = (rubles_per_lira,)
        try:
            self.cursor.execute(sql, param)
        except Exception as e:
            self.do.log.exception(f'Error update_rubles_per_lira: {e}\n')
            do_raise_to_debag(DEBUG)
        self.db.commit()

 