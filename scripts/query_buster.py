
import mysql.connector

host='localhost'
user='root'
password='password'
database='boker'

def get_buster():
    return mysql.connector.connect(host=host,user=user,password=password,database=database)