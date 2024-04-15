from query_buster import get_buster
from os import listdir
from os.path import join

buster = get_buster()
cursor_buster = buster.cursor()

IMAGE_FOLDER = r'C:\xampp\htdocs\adp2\leansig\images\houses'

for dir in listdir(IMAGE_FOLDER):
    images = listdir(join(IMAGE_FOLDER, dir))
    for image in images:
        property_id = int(dir)
        path = f'{property_id}/{image}'
        media_type = "image"

        # create media
        cursor_buster.execute(f'''
            insert into boker.media (media_type, file_path)
            values ("{media_type}", "{path}")
        ''')
        media_id = cursor_buster.lastrowid
        # create junction
        cursor_buster.execute(f'''
            insert into boker.property_media (property_id, media_id)
            values ({property_id}, {media_id})
        ''')

        print(f'created media {media_id}')
        print(f'created junction {cursor_buster.lastrowid}')
buster.commit()
buster.close()