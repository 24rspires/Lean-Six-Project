
import pyautogui
from os import system, getcwd, listdir, getlogin
from os.path import join
from shutil import move
from time import sleep
from pyperclip import copy

def get_code():
    with open('scripts/image_buster2.js', 'r') as file:
        return file.read()

def to_page(url):
    system(f'start brave "{url}"')

def open_dev_console():
    pyautogui.press('F12')

def paste():
    with pyautogui.hold('ctrl'):
        pyautogui.press('v')
    pyautogui.press('enter')

def copy_code():
    code = get_code()
    copy(code)

def close_browser():
    system("taskkill /F /IM brave.exe")

def save_images_from_page(url):
    to_page(url)
    sleep(1.8)
    open_dev_console()
    sleep(0.5)
    paste()

def get_house_urls():
    with open('scripts/house_urls.txt', 'r') as file:
        return file.read().split(';')

def get_downloads():
    return f'C:/Users/{getlogin()}/Downloads'

def move_all_images_in_downloads(save_path):
    downloads = get_downloads()
    for image in listdir(downloads):
        file_name = image.split('.')[0]
        if file_name.isnumeric():
            move(join(downloads, image), save_path)

def is_done_downloading():
    downloads = get_downloads()
    done = True
    for file in listdir(downloads):
        if '.crdownload' in file:
            done = False
    print(done)
    return done

def main():
    start = 129
    urls = get_house_urls()
    copy_code()
    for offset, url in enumerate(urls):
        p_id = start + offset
        save_images_from_page(url)
        sleep()
        while not is_done_downloading():
            sleep(1)
        move_all_images_in_downloads(f'{getcwd()}/images/{p_id}')
        break


if __name__ == "__main__":
    main()