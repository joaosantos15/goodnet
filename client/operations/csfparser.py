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

