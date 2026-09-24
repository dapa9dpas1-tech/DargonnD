import sqlite3

conn = sqlite3.connect('c:/xampp/htdocs/king/data/dragonnorth.sqlite')
cursor = conn.cursor()
cursor.execute("SELECT id, name, image FROM products ORDER BY id DESC LIMIT 5")
rows = cursor.fetchall()
for r in rows:
    print(r)
conn.close()
