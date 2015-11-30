import re
import os


speedstring=None
latencystring = None
latencystr = None
ispstring = None
externalstring = None

connectionfile = None
gatewayfile = None
pubipfile = None
latencyfile = None
ispfile = None
userfile = None


projectpath = os.path.dirname(os.path.abspath(__file__))
projectpath=projectpath+"/.."

# projectpath = "/Users/boss/Desktop/csf"
# projectpath = "/storage/csf"
#projectpath = "/Users/boss/Documents/Git/csf"

def parse_logs_connection():
    global connectionfile, gatewayfile, pubipfile, latencyfile,ispfile,userfile

    connectionfile = open(projectpath + "/CONNECTIONresults/connectionTest.log", "r")
    gatewayfile = open(projectpath + "/CONNECTIONresults/gateway.log", "r")
    pubipfile = open(projectpath + "/CONNECTIONresults/pubip.log", "r")
    userfile = open(projectpath + "/CONNECTIONresults/user.log", "r")

def get_info_from_lines_connection():
    global gatewayline,pubipline,latencyline,ispline,externalline,userline

    gatewayline = gatewayfile.readline()
    pubipline = pubipfile.readline()
    externalline = connectionfile.readline()
    userline = userfile.readline()

def parse_logs_speed():
    global uploadspeedfile,downloadspeedfile,latencyfile, ispfile

    latencyfile = open(projectpath + "/SPEEDresults/latency.log", "r")
    uploadspeedfile = open(projectpath + "/SPEEDresults/upload.log", "r")
    downloadspeedfile = open(projectpath + "/SPEEDresults/download.log", "r")
    ispfile = open(projectpath + "/SPEEDresults/isp.log", "r")


def get_info_from_lines_speed():
    global uploadspeedline,downloadspeedline,latencyline, ispline


    latencyline = latencyfile.readline()
    uploadspeedline = uploadspeedfile.readline()
    downloadspeedline = downloadspeedfile.readline()
    ispline = ispfile.readline()


def init_connection():
    parse_logs_connection()
    get_info_from_lines_connection()

def init_speed():
    parse_logs_speed()
    get_info_from_lines_speed()

def parse_speed(speedstring):
    return re.findall("\d+.\d+", speedstring)[0]

def get_upload_speed():
    upload = parse_speed(uploadspeedline)
    return upload

def get_download_speed():
    download = parse_speed(downloadspeedline)
    return download

def get_latency():
    return re.findall("\d+.\d+", latencyline)[1]


def get_area():
    start = latencyline.find('(') + 1
    stop = latencyline.find(')')
    m = latencyline
    m = m[start:stop]
    return m


def get_isp():
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


def get_external_status():
    if "ok" in externalline.lower():
        return "OK"
    else:
        return "DOWN"

def get_gateway():
    gate=gatewayline.replace("\n", "")
    return gate

def get_pubip():
    pubip = pubipline.replace("\n", "")
    return pubip

def get_username():
    username = userline.replace("\n", "")
    return username

def test(a):
    init_connection()
    init_speed()

    gateway = get_gateway()
    pubip = get_pubip()
    username = get_username()

    latency = get_latency()
    #isp = get_isp(ispline)
    area = get_area()
    externalstatus = get_external_status()

    uploadspeed="20"
    downloadspeed="44"

    if a == 1:
        outputfile = open(projectpath + "/SEND.txt", "a")
        outputfile.write(
            username + ";" + gateway + ";" + pubip + ";" + externalstatus + ";" + uploadspeed + ";" + downloadspeed + ";" + latency + ";" + downloadspeed + ";" + area + ";")
        outputfile.write("\n")
        outputfile.close()
    else:
        print (  username + ";" + gateway + ";" + pubip + ";" + externalstatus + ";" + uploadspeed + ";" + downloadspeed + ";" + latency + ";" + downloadspeed + ";" + area + ";")

#test(1) to print to file, test(0) to print to terminal
test(0)
