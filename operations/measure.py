from json import load
from urllib2 import urlopen
import csfparser


def get_public_ip():
    global connection_status
    print("Getting current IP")
    try:
        my_ip = load(urlopen('https://api.ipify.org/?format=json'))['ip']
    except Exception as e:
        connection_status="DOWN"
        return ("no connection")
    connection_status="OK"
    return my_ip

def get_connection_status():
    print("Getting status")
    get_public_ip()
    return connection_status
