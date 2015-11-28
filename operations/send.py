import sys
import mysql_lib
import json
import measure
import csfparser


pi_config = "pi_info.json"

def parse_pi_info():
    global pi_config
    global pi_data
    with open(pi_config) as data_file:
        pi_data = json.load(data_file)


def send_connection_results():
    print ("sending connection to db")
    #pubip = csfparser.get_pubip()
    pubip = measure.get_public_ip()
    available = measure.get_connection_status()
    mysql_lib.db_query_add_connection_record(idpi, pubip, available)


def send_speed_results():
    print ("sending speed to db")
    download_speed = csfparser.get_download_speed()
    upload_speed = csfparser.get_upload_speed()
    latency = csfparser.get_latency()
    mysql_lib.db_query_add_speed_record(idpi, upload_speed, download_speed, latency)

def get_mode():
    if "connection" in sys.argv[1].lower():
        return "connection"
    if "speed" in sys.argv[1].lower():
        return "speed"
    else:
        return "error"

def main():
    global idpi
    procedure = get_mode()
    idpi = pi_data["pi"][0]["id"]

    if "error" not in procedure:
        if "connection" in procedure:
            send_connection_results()
        elif "speed" in procedure:
            send_speed_results()
    else:
        print("pupu...")

parse_pi_info()
#send_connection_results()
main()


