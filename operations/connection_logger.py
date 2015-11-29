import measure
import time
import json
import log_json

pi_config = "pi_info.json"

def parse_pi_info():
    global pi_config
    global pi_data
    global pi_id
    with open(pi_config) as data_file:
        pi_data = json.load(data_file)
        pi_id = pi_data["pi"][0]["id"]


#generate new log
def generate_connection_log():
    parse_pi_info()
    pub_ip = measure.get_public_ip()
    connection_status = measure.get_connection_status()
    timestamp= time.strftime('%Y-%m-%d %H:%M:%S')

    log_json.add_connection_log(timestamp,pi_id,pub_ip,connection_status)

generate_connection_log()

