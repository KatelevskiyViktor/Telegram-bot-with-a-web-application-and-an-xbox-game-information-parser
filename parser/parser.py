import time
import re

from selenium import webdriver
from selenium.webdriver.common.by import By
from logger import Logger
from mysql_handler import MySQLHandler
from helpers import *
from config.init import DEBUG


class Parser:
    def __init__(self):
        self.lst_urls_games = []
        options = webdriver.ChromeOptions()
        options.add_argument("--headless=old")
        self.driver = webdriver.Chrome(options=options)
        self.do = Logger(__name__)
        self.get_course_rubles_per_lira()
        # self.click_load_btn()
        # self.get_all_games_links(self.find_all_games())
        # self.get_game_data()

    def click_load_btn(self, count=2):
        self.driver.get("https://www.xbox.com/tr-tr/games/browse")
        try:
            for i in range(count):
                self.driver.find_element(By.CLASS_NAME, 'typography-module__xdsButtonText___T7YHc').click()
        except Exception:
            self.do.log.exception("Error click_load_btn() is element not found")
            do_raise_to_debag(DEBUG)

    def find_all_games(self):
        time.sleep(1)
        try:
            return self.driver.find_elements(By.CSS_SELECTOR, "[href*='https://www.xbox.com/tr-TR/games/store/']")
        except Exception:
            self.do.log.exception("Error into finding_all_games() elements not found")
            do_raise_to_debag(DEBUG)

    def get_all_games_links(self, elems):
        open('db/urls_games.txt', 'w').close()
        f = open('db/urls_games.txt', 'a', encoding='utf-8')
        for elem in elems:
            url = elem.get_attribute("href")
            f.write(url + '\n')
            self.lst_urls_games.append(url)

    def get_game_data(self):
        msh = MySQLHandler()
        for url in self.lst_urls_games:
            self.driver.get(url)
            print(url)
            price = self.get_price()
            if price['full_coast'] or price['ea_play_coast'] or price['game_pass_coast']:
                rating = self.get_rating()
                relise_date = self.get_relise_date()
                img_url = self.get_img_url()
                time_sale = self.get_time_sale()
                description = self.get_description(url)
                title = self.get_title()
                ganre = self.get_ganre()
                msh.isert_or_update(title, price, rating, description, img_url, time_sale, ganre, relise_date)
        self.driver.close()

    def get_time_sale(self):
        try:
            return int(re.findall(r'\d+', self.driver.find_element(By.XPATH, "//span[contains(.,'İndirimde:')]").get_attribute('innerHTML'))[-1])
        except Exception:
            self.do.log.error('Error into get_time_sale(), no such element')
            return 0

    def get_ganre(self):
        try:
            return clear_str(self.driver.find_element(By.CSS_SELECTOR, ".ProductInfoLine-module__textInfo___jOZ96").text)
        except Exception:
            self.do.log.exception("Error into get_ganre(), no such element")
            do_raise_to_debag(DEBUG)

    def get_relise_date(self):
        try:
            date = self.driver.find_element(By.XPATH, "//h3[contains(.,'Çıkış tarihi')]/following-sibling::div").text
            return '-'.join(date.split('.')[::-1])
        except Exception:
            self.do.log.error("Error into get_relise_date(), no such element")
            do_raise_to_debag(DEBUG)
            return None

    def get_price(self):
        full_coast = 0
        ea_play_coast = 0
        game_pass_coast = 0
        time.sleep(2)
        try:
            full_coast = re.findall(r'\d+', self.driver.find_element(By.CSS_SELECTOR,
                                                                     '.AcquisitionButtons-module__listedPrice___PS6Zm')
                                    .get_attribute('innerHTML'))
        except Exception as e:
            self.do.log.exception(f"Error into get_price(), not found full_coast:\n{e}")
            do_raise_to_debag(DEBUG)

        try:
            ea_play_coast = re.findall(r'\d+', self.driver.find_element(By.XPATH, "//span[contains(.,'EA Play ile')]").text)
        except Exception:
            self.do.log.error("Error into get_price(), not found ea_play_coast:")
            do_raise_to_debag(DEBUG)

        try:
            game_pass_coast = re.findall(r'\d+', self.driver.find_element(By.XPATH, "//div[contains(.,'GAME PASS EDININ')]/following-sibling::div/span").text)
        except Exception:
            self.do.log.error("Error into get_price(), not found game_pass_coast")
            do_raise_to_debag(DEBUG)

        return {'full_coast': do_int_from_coast_str(full_coast),
                'ea_play_coast': do_int_from_coast_str(ea_play_coast),
                'game_pass_coast': do_int_from_coast_str(game_pass_coast)}

    def get_description(self, url):
        url = url.replace('tr-TR', 'ru-Ru')
        self.driver.get(url)
        time.sleep(1)
        try:
            return (self.driver.find_element(By.CLASS_NAME, 'Description-module__description___ylcn4')
                    .get_attribute('innerHTML'))
        except Exception:
            self.do.log.exception('Error into get_description()')
            do_raise_to_debag(DEBUG)

    def get_rating(self):
        try:
            return int(self.driver.find_element(By.CLASS_NAME, 'Rating-module__totalRatings___i594Q')
                       .get_attribute('innerHTML'))
        except Exception as e:
            self.do.log.exception('Error in get_rating()')
            do_raise_to_debag(DEBUG)
            return 0

    def get_img_url(self):
        try:
            return self.driver.find_element(By.CLASS_NAME, 'ProductDetailsHeader-module__productImage___QK3JA') \
                .get_attribute('src').split('?', 1)[0]
        except Exception:
            self.do.log.exception('Error into get_img_url()')
            do_raise_to_debag(DEBUG)

    def get_title(self):
        try:
            return (self.driver.find_element(By.CLASS_NAME, 'ProductDetailsHeader-module__productTitle___Hce0B')
                    .get_attribute('innerHTML'))
        except Exception:
            self.do.log.exception('Title error')
            do_raise_to_debag(DEBUG)

    def get_course_rubles_per_lira(self):
        msh = MySQLHandler()
        self.driver.get("https://yandex.ru/finance/currencies/TRY_RUB")
        time.sleep(2)
        i = 0
        rubles_per_lira = ''
        try:
            elements = self.driver.find_elements(By.CLASS_NAME, 'Textinput-Control')
            for e in elements:
                if i != 0:
                    rubles_per_lira = e.get_attribute('value').replace(',', '.')
                    print(rubles_per_lira)
                i += 1
        except Exception:
            self.do.log.exception('Get course lira error')
            do_raise_to_debag(DEBUG)
        msh.update_rubles_per_lira(rubles_per_lira)

