import sys
import mysql_lib
import json
import measure
import csfparser
import log_json


pi_config = "pi_info.json"
log_file = "results/connection_log.json"

def parse_pi_info():
    global pi_config
    global pi_data
    with open(pi_config) as data_file:
        pi_data = json.load(data_file)
def execute_connection_query(time_stamp,idpi, pubip, available):
    mysql_lib.db_query_add_connection_record(time_stamp,idpi, pubip, available)

def send_connection_results():
    logs = log_json.get_json_data()
    try:
        for obj in logs:
            execute_connection_query(obj['time_stamp'],obj['pi_id'],obj['pub_ip'],obj['status'])
    except Exception as e:
        print("Erro ao enviar logs")
        print e.message
        return
    #if logs correctly sent to db, delete logs
    log_json.delete_connection_log()


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
            if measure.check_connection_to_send_log():
                send_connection_results()
            else:
                return
        elif "speed" in procedure:
            send_speed_results()
    else:
        print("pupu...")

#parse_pi_info()
send_connection_results()
#main()


