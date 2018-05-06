# Wheel_Runner
Tracking the distance small animals run in their wheels <br><br>

[You can access my hedgehog's live data here.](https://chip.fenneltechsolutions.com)<br><br>

I made this as there were no really good ways to track how far my hedgehog runs at night.<br>

My live demo is contained on a raspberry PI, using a magnetic door sensor to track the wheel revolutions.<br><br>

Requirements: Raspberry PI, Door Sensor, Mysql Environment.
---
Setup:<br>
1. Install screen, python, and apache on a Raspberry PI<br>
2. Copy the Web_Interface files into apache's /var/www/html folder.<br>
3. Change the values in config.php to match your environment.<br><br>

4. Copy the Wheel_Tracker files into the Linux home directory<br>
5. Change the web address in 'chiprunner.py' to match your IP address on line 22.<br><br>

6. Shut down your raspberry PI, and attach the leads of the door sensor to GPIO Pins x and x.<br><br>

7. Run chiprunner.sh, and optionally add it as a daily cron job<br>
8. Test that it works by manually spinning the wheel, and refreshing the page to make sure the values are updated.<br>

<br><br>

---
Known issues: The python script freezes up after roughly 30 hours. I use a daily cronjob to restart the script every 24 hours in a screen session.<br>
'''
0 18 * * * /home/pi/chiprunner.sh
@reboot /home/pi/chiprunner.sh
'''

