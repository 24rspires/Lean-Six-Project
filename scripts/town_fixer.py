
import mysql.connector

towns = ['Berkshire', 'Berlin', 'Brown', 'Concord', 'Delaware', 'Genoa', 'Harlem', 'Kingston', 'Liberty', 'Marlboro', 'Orange', 'Oxford', 'Porter', 'Radnor', 'Scioto', 'Thompson', 'Trenton', 'Troy', 'Washington']



from random import choice
from query_buster import get_buster

query = "select * from boker.properties where city like '';"

conn = get_buster()
cursor = conn.cursor()
cursor.execute(query)
x = cursor.fetchall()

for y in x:
    id = y[0]
    print(f'update boker.properties set city="{choice(towns)}" where property_id={id}')
    # cursor.execute(f'update boker.properties set city="{choice(towns)}" where property_id={id}')
conn.commit()
conn.close()