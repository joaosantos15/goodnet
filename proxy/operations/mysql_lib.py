import mysql.connector
import json
from pprint import pprint
import os

projectpath = os.path.dirname(os.path.abspath(__file__))


dbconffile = projectpath+'/dbdata.json'
#dbconffile = 'dbdata.json'



def db_parsedbconf():
    global dbconffile
    with open(dbconffile) as data_file:
        data = json.load(data_file)
        return data


def db_getdbconnection():
    global cnx
    data = db_parsedbconf()
    cnx = mysql.connector.connect(user=data["db"][0]["user"],
                                  password=data["db"][0]["password"],
                                  host=data["db"][0]["host"],
                                  database=data["db"][0]["database"])
    return cnx
    # cnx.close()


def db_query(query):
    cnx = db_getdbconnection()
    cursor = cnx.cursor()
    cursor.execute(query)
    cnx.close()
    return cursor

#INSERT INTO `ist174008`.`AVAILABILITY` (`idPi`, `pubIP`, `available`) VALUES ('4', '195.122.20.20', 'OK');

def db_query_add_connection_record(time_stamp,idpi,pubip,available):
    cnx = db_getdbconnection()
    cursor = cnx.cursor()
    values = (time_stamp,idpi,pubip,available)

    query = "INSERT INTO `ist174008`.`AVAILABILITY` (`timeStamp`,`idPi`, `pubIP`, `available`) VALUES (%s, %s, %s, %s);"
    cursor.execute(query,values)
    cnx.commit()
    cursor.close()
    cnx.close()


#INSERT INTO `ist174008`.`SPEED` (`idPi`, `uploadSpeed`, `downloadSpeed`, `latency`) VALUES ('5', '10', '100', '24');

def db_query_add_speed_record(idpi,upload_speed,download_speed,latency):
    cnx = db_getdbconnection()
    cursor = cnx.cursor()
    values = (idpi,upload_speed,download_speed,latency)

    query = "INSERT INTO `ist174008`.`SPEED` (`idPi`, `uploadSpeed`, `downloadSpeed`, `latency`) VALUES (%s,%s,%s,%s);"
    cursor.execute(query,values)
    cnx.commit()
    cursor.close()
    cnx.close()


def test_connection_query():
    if (db_getdbconnection() != False):
        print ("connected to db")

        db_query_add_connection_record("4","111.111.111.111","OKOK")
        """
        query = "SELECT * FROM ist176550.DAILY_REGISTER;"
        result = db_query(query)

        for (id, istID, timeStamp) in result:
            print ("ID " + str(istID) + " " + "timeStamp" + str(timeStamp))

        """
def test_speed_query():
    if (db_getdbconnection() != False):
        print ("connected to db")

        db_query_add_speed_record("9","14","233","22")
        """
        query = "SELECT * FROM ist176550.DAILY_REGISTER;"
        result = db_query(query)

        for (id, istID, timeStamp) in result:
            print ("ID " + str(istID) + " " + "timeStamp" + str(timeStamp))

        """
#test_speed_query()
# db_query_add_user("jjo","ist64455","jh44kjh","a")
