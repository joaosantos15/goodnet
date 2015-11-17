import re


def getspeed(speedstring):
    return re.findall("\d+.\d+", speedstring)[0]


def getlatency(latencystring):
    return re.findall("\d+.\d+", latencystring)[1]


def getisp(ispstring):
    if "nos" in ispstring.lower():
        return "NOS"
    if "vodafone" in ispstring.lower():
        return "Vodafone"
    if "meo" in ispstring.lower():
        return "MEO"
    if "visao" in ispstring.lower():
        return "Cabo Visao"
    if "tecnologia" in ispstring.lower():
        return "FCCN"
    else:
        return "Other"


def getexternalstatus(externalstring):
    if "ok" in externalstring.lower():
        return "OK"
    else:
        return "DOWN"


projectpath = "/Users/boss/Desktop/csf"

connectionfile = open(projectpath + "/results/connectionTest.log", "r")
gatewayfile = open(projectpath + "/results/gateway.log", "r")
pubipfile = open(projectpath + "/results/pubip.log", "r")
uploadspeedfile = open(projectpath + "/SPEEDresults/upload.log", "r")
downloadspeedfile = open(projectpath + "/SPEEDresults/download.log", "r")
latencyfile = open(projectpath + "/SPEEDresults/latency.log", "r")
ispfile = open(projectpath + "/SPEEDresults/isp.log", "r")
userfile = open(projectpath + "/results/user.log", "r")

gatewayline = gatewayfile.readline()
pubipline = pubipfile.readline()
uploadspeedline = uploadspeedfile.readline()
downloadspeedline = downloadspeedfile.readline()
latencyline = latencyfile.readline()
ispline = ispfile.readline()
externalline = connectionfile.readline()
userline = userfile.readline()
# DEBUG
"""
print(gatewayline)
print(pubipline)
print(uploadspeedline)
print(downloadspeedline)
"""
gateway = gatewayline.replace("\n", "")
pubip = pubipline.replace("\n", "")
uploadspeed = getspeed(uploadspeedline)
downloadspeed = getspeed(downloadspeedline)
latency = getlatency(latencyline)
isp = getisp(ispline)
externalstatus = getexternalstatus(externalline)
username = userline.replace("\n", "")

# DEBUG
"""print ("up: "+uploadspeed+" down: "+downloadspeed)"""

# Nome;         Gateway         IP;             External;       Upload;   Download;   Latencia;   Bandwidth;  Operador
# Passos Portas; 192.168.1.254;  192.168.1.45;   OK;              234;     0;          300;        79;         MEO;
# print (username+";"+gateway+";"+pubip+";"+externalstatus+";"+uploadspeed+";"+"0"+";"+latency+";"+downloadspeed+";"+isp)

outputfile = open(projectpath + "/SEND.txt", "w")
outputfile.write(
    username + ";" + gateway + ";" + pubip + ";" + externalstatus + ";" + uploadspeed + ";" + "0" + ";" + latency + ";" + downloadspeed + ";" + isp)
outputfile.close()
