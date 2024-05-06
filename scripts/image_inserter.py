

from query_buster import get_buster

connection = get_buster()

url_file = 'scripts/bimages2.txt'

#http://res.cloudinary.com/dpurg0teb/image/upload/

with open(url_file, 'r') as file:
    for line in file:
        id, url = line[0:3], line[4:]
        cut_url = url[49:]
        
        cursor = connection.cursor()
        cursor.execute( f"INSERT INTO media (media_type, file_path) values ('i', '{cut_url}')")
        last_insert = cursor.lastrowid
        cursor.execute(f'insert into property_media (property_id, media_id) values ({id}, {last_insert})  ')
        connection.commit()
    cursor.close()
    connection.close()