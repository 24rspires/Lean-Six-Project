
import os
print(os.getcwd())
for i in range(127, 255):
    os.mkdir(f'{os.getcwd()}/images/{i}')