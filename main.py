import random

import telebot
from telebot import types
from telebot.types import WebAppInfo

TELEGRAM_TOKEN = ''

bot = telebot.TeleBot(TELEGRAM_TOKEN)


@bot.message_handler(commands=['start'])
def start(message):
    c1 = types.BotCommand(command='start', description='🚀 Запустить бота')
    c2 = types.BotCommand(command='help', description='❓Помощь')
    bot.set_my_commands([c1, c2])
    bot.set_chat_menu_button(message.chat.id, types.MenuButtonCommands('commands'))

    markup = types.InlineKeyboardMarkup(row_width=1)

    video = open('video/xbox' + str(random.randint(1, 10)) + '.mp4', 'rb')
    item1 = types.InlineKeyboardButton('🛍️ Магазин', web_app=WebAppInfo(url='index.html'))
    item2 = types.InlineKeyboardButton('📝 Подписка', callback_data='podpiska')
    item3 = types.InlineKeyboardButton('ℹ️ Информация', callback_data='info'
                                                                      '')
    markup.add(item1, item2, item3)
    bot.send_video(message.chat.id, video,
                   None, 430, 240,
                   None, reply_markup=markup)
    # bot.send_message(message.chat.id, 'Привет, {0.first_name}'.format(message.from_user), reply_markup=markup)


@bot.message_handler(content_types=['text'])
def bot_message(message):
    if message.chat.type == 'private':
        if message.text == '📝 Подписка':
            markup = types.InlineKeyboardMarkup(row_width=3)
            item1 = types.InlineKeyboardButton('🎮 PS')
            item2 = types.InlineKeyboardButton('🕹️ Xbox')
            back = types.InlineKeyboardButton('🔙 Назад')
            markup.add(item1, item2, back)
            bot.send_message(message.chat.id, '📝 Подписка'.format(message.from_user), reply_markup=markup)
        elif message.text == 'ℹ️ Информация':
            markup = types.InlineKeyboardMarkup(row_width=3)
            item1 = types.InlineKeyboardButton('🤖 О боте')
            back = types.InlineKeyboardButton('🔙 Назад')
            markup.add(item1, back)
            bot.send_message(message.chat.id, 'ℹ️ Информация'.format(message.from_user), reply_markup=markup)
        elif message.text == '🔙 Назад':
            markup = types.InlineKeyboardMarkup(row_width=3)
            item1 = types.InlineKeyboardButton('🛍️ Магазин')
            item2 = types.InlineKeyboardButton('📝 Подписка')
            item3 = types.InlineKeyboardButton('ℹ️ Информация')
            markup.add(item1, item2, item3)
            bot.send_message(message.chat.id, '🔙 Назад'.format(message.from_user), reply_markup=markup)


bot.polling(none_stop=True)
