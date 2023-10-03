import mysql.connector
from mysql.connector import Error

# Configura la conexión a MySQL
try:
    connection = mysql.connector.connect(
        host='localhost',
        database='proyecto',
        user='root',
        password=''
    )

    if connection.is_connected():
        cursor = connection.cursor()

        # Lee el archivo CSV y carga los datos en la tabla
        with open('C:\\Users\\carolnet\\Desktop\\appProyecto\\songs.csv', 'r', encoding='utf-8') as file:
            next(file)  # Saltar la primera fila si contiene encabezados
            for line in file:
                data = line.strip().split(';')
                cursor.execute('INSERT INTO estadisticas (title, artist, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity, cantidadop, calificacion) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 0, 0)', data)

        connection.commit()
        print("Los datos se han importado correctamente")

except Error as e:
    print(f"Error: {e}")