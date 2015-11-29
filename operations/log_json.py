import json
import os

#file_json = "test.json"
file_json = "results/connection_log.json"



def get_json_data():
    try:
        with open(file_json) as f:
            return json.load(f)
    except Exception:
        a=[]
        return a


def add_log(log):
    data = get_json_data()
    data.append(log)
    with open(file_json, 'w') as f:
        json.dump(data, f)

def add_connection_log(time_stamp, pi_id, pub_ip,status):
    log= {'time_stamp':time_stamp,'pi_id':pi_id,'pub_ip':pub_ip,'status':status}
    add_log(log)

def delete_connection_log():
    os.remove(file_json)

"""

logs=[]
log= {'id':'1','pubip':'192.187.244','status':'OK'}
logs.append(log)




with open('test.json') as f:
    data = json.load(f)


data.append(log)

with open('test.json', 'w') as f:
    json.dump(data, f)


for obj in data:
    print (obj['status'])
"""