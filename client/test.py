import re

def getlatency(latencystring):
    return re.findall("\d+.\d+", latencystring)[1]

def getarea(latencystr):
    start=latencystr.find('(')+1
    stop=latencystr.find(')')
    m=latencystr
    m=m[start:stop]
    return m

latencyfile = open("SPEEDresults/latency.log", "r")

latencyline = latencyfile.readline()

latency = getlatency(latencyline)

area= getarea(latencyline)


print(latency)
print(area)