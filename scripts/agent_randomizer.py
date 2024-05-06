

from query_buster import get_buster

connection = get_buster()

agent_ids = [1, 3, 5]

from random import choice

cursor = connection.cursor()
cursor.execute('select * from properties;')
results = cursor.fetchall()
for result in results:
    agent_id = choice(agent_ids)
    sql = f'update properties set agent_id={agent_id} where property_id={result[0]};'
    cursor.execute(sql)
    connection.commit()
    # cursor.execute()
    # print(sql)
    