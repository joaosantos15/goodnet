import measure
import time
import json
import log_json
import csfparser

pi_config = "pi_info.json"


def parse_pi_info():
    global pi_config
    global pi_data
    global pi_id
    with open(pi_config) as data_file:
        pi_data = json.load(data_file)
        pi_id = pi_data["pi"][0]["id"]


# generate new log
def generate_speed_log():
    parse_pi_info()
    #pub_ip = measure.get_public_ip()
    csfparser.init_speed()
    download_speed = csfparser.get_download_speed()
    upload_speed = csfparser.get_upload_speed()
    latency = csfparser.get_latency()
    timestamp = time.strftime('%Y-%m-%d %H:%M:%S')
    log_json.add_speed_log(timestamp,pi_id,download_speed,upload_speed,latency)

generate_speed_log()