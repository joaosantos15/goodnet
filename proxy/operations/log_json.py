import json
import os

#file_json = "test.json"
projectpath = os.path.dirname(os.path.abspath(__file__))
#projectpath = "/Users/boss/Documents/Git/csf/operations"

if not os.path.exists(projectpath+"/results"):
    os.makedirs(projectpath+"/results")

file_connection_json = projectpath+"/results/connection_log.json"
file_speed_json = projectpath+"/results/speed_log.json"



def get_json_data(file):
    if not os.path.exists(projectpath+"/results"):
        os.makedirs(projectpath+"/results")
    try:
        with open(file) as f:
            return json.load(f)
    except Exception:
        a=[]
        return a


def add_log(log,file):
    data = get_json_data(file)
    data.append(log)
    with open(file, 'w') as f:
        json.dump(data, f)

def add_connection_log(time_stamp, pi_id, pub_ip,status):
    log= {'time_stamp':time_stamp,'pi_id':pi_id,'pub_ip':pub_ip,'status':status}
    add_log(log,file_connection_json)

def delete_connection_log():
    os.remove(file_connection_json)

def add_speed_log(time_stamp, pi_id, download_speed, upload_speed,latency):
    log={'time_stamp': time_stamp, 'pi_id':pi_id,'download_speed':download_speed, 'upload_speed':upload_speed,'latency':latency}
    add_log(log,file_speed_json)

def delete_speed_log():
    os.remove(file_speed_json)

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