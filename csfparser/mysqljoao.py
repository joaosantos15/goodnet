import mysql.connector
import json
from pprint import pprint

dbconffile = 'dbdata.json'
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

def db_query_add_connection_record(idpi,pubip,available):
    cnx = db_getdbconnection()
    cursor = cnx.cursor()
    values = (idpi,pubip,available)

    query = "INSERT INTO `ist174008`.`AVAILABILITY` (`idPi`, `pubIP`, `available`) VALUES (%s, %s, %s);"
    cursor.execute(query,values)
    cnx.commit()
    cursor.close()
    cnx.close()


def test():
    if (db_getdbconnection() != False):
        print ("connected to db")

        db_query_add_connection_record("4","111.111.111.111","OKOK")
        """
        query = "SELECT * FROM ist176550.DAILY_REGISTER;"
        result = db_query(query)

        for (id, istID, timeStamp) in result:
            print ("ID " + str(istID) + " " + "timeStamp" + str(timeStamp))

        """
#test()
# db_query_add_user("jjo","ist64455","jh44kjh","a")
