import sys
import mysql_lib
import json
import measure
import csfparser
import log_json

projectpath = "/Users/boss/Documents/Git/csf/operations"


pi_config = projectpath+"/pi_info.json"
log_connection_file = projectpath+"/results/connection_log.json"
log_speed_file = projectpath+"/results/speed_log.json"

def parse_pi_info():
    global pi_config
    global pi_data
    with open(pi_config) as data_file:
        pi_data = json.load(data_file)
def execute_connection_query(time_stamp,idpi, pubip, available):
    mysql_lib.db_query_add_connection_record(time_stamp,idpi, pubip, available)

def execute_speed_query(time_stamp,idpi,download_speed,upload_speed,latency):
    mysql_lib.db_query_add_speed_record(idpi, upload_speed, download_speed, latency)


def send_connection_results():
    logs = log_json.get_json_data(log_connection_file)
    try:
        for obj in logs:
            execute_connection_query(obj['time_stamp'],obj['pi_id'],obj['pub_ip'],obj['status'])
    except Exception as e:
        print("Erro ao enviar logs de conexao")
        print e.message
        return
    #if logs correctly sent to db, delete logs
    log_json.delete_speed_log()

def new_send_speed_results():
    logs = log_json.get_json_data(log_speed_file)
    try:
        for obj in logs:
            execute_speed_query(obj['time_stamp'],obj['pi_id'],obj['download_speed'],obj['upload_speed'],obj['latency'])
    except Exception as e:
        print("Erro ao enviar logs de velocidade")
        print e.args
        return
    #if logs correctly sent to db, delete logs
    log_json.delete_speed_log()


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
#send_connection_results()
#new_send_speed_results()
#main()


