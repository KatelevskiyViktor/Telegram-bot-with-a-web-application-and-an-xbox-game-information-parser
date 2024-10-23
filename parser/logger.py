import logging


class Logger:
    def __init__(self, name_file):
        self.log = logging.getLogger(name_file)
        self.log.setLevel(logging.INFO)
        self.file = f'log/{name_file}.log'
        handler = logging.FileHandler(f"log/{name_file}.log", mode='a')
        formatter = logging.Formatter("-------------------------------------------------------------\
        \n[%(name)s] [%(asctime)s] [%(levelname)s] > %(message)s")
        handler.setFormatter(formatter)
        self.log.addHandler(handler)
