import os
import json
import random
import time

projectpath = projectpath = os.path.dirname(os.path.abspath(__file__))
pi_config = projectpath+"/operations/pi_info.json"

def parse_pi_info():
    global pi_config
    global pi_data
    global pi_id
    with open(pi_config) as data_file:
        pi_data = json.load(data_file)
        pi_id = pi_data["pi"][0]["id"]

def get_sleep_time(pi_id):
    return random.seed()

parse_pi_info()
random.seed(pi_id)
time.sleep( random.randint(1,30) )
print("bye")

