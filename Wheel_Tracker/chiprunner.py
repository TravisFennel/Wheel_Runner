import RPi.GPIO as GPIO
import urllib2
import time
from time import gmtime, strftime

sw_in = 8
count = 0

GPIO.setmode(GPIO.BOARD)
GPIO.setup(sw_in,GPIO.IN,pull_up_down=GPIO.PUD_UP)
GPIO.add_event_detect(sw_in,GPIO.FALLING)
GPIO.setwarnings(False)


print("Chip Runner activated")
print(strftime("%Y-%m-%d %H:%M:%S", gmtime()))
while True:
#    print count
    if GPIO.event_detected(sw_in):
        GPIO.remove_event_detect(sw_in)
#        count +=1
	content = urllib2.urlopen('http://Your_IP_Address/logRotation.php').read()
#	print content
#        print count
        time.sleep(.35)
        GPIO.add_event_detect(sw_in,GPIO.RISING)
