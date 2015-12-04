import os



#project_path = os.path.dirname(os.path.abspath(__file__))
project_path = "/home/proxy/goodnet/proxy"
file_path = project_path+"/auto_gen.sh"


f = open(file_path,'w')


def write_to_script(s):
    f.write(s+"\n")

def start_script():
    write_to_script("#! /bin/bash")

def add_pi_folder(path):
    write_to_script("python "+project_path+"/operations/send.py connection "+path+"/connection_log.json")
    write_to_script("python "+project_path+"/operations/send.py speed "+path+"/speed_log.json")




logs_path = "/home/proxy"

data_path = logs_path+"/raw_data"+"/pi"
current_pi_path = data_path+"1"

#print(current_pi_path)
#print (os.path.isdir(current_pi_path))
i=0
while os.path.isdir(current_pi_path):
    if i!=0:
        #print(current_pi_path)
        add_pi_folder(current_pi_path)
    i+=1
    current_pi_path = data_path+str(i)




