# LaunchCountdown
PHP Launch Countdown

# Setting up the Launch updates screen on a Windows computer.
## You will need:
* Computer that runs Windows 10 (LattePanda recommended if you want this to be a standalone setup)
* Internet connection (Ethernet or Wi-Fi)

## Setting up Apache and PHP:
* For Apache on Windows I recommend XAMPP. It has Apache and PHP pre-installed.
  * Download and install from:
    * https://www.apachefriends.org/index.html
    * You only need Apache and PHP installed, you can uncheck all the other ones in the installer.
* Once you set this up:
  1. Open the XAMPP Control Panel and click start under `Apache`
  2. Go to http://localhost/, and you should see the default Apache webpage.
## Replacing default website with the custom one:
* The default website for XAMPP is located in the `htdocs` folder of the XAMPP directory. We need to navigate to this to remove the default files that are there.
  * By default, the XAMPP directory is at `C:\xampp\`
  * Navigate there and remove all of the files.
* Once the default webpage has been removed, we can add the launch countdown. Download `index.php` and `numeral.ttf` from this repo and put them in the `htdocs` folder.
* Now this is done go back to the browser and navigate to http://localhost/ and you should see the launch timer is working correctly!

# Setting up the Launch updates screen on a Raspberry Pi.
## You will need:
* Raspberry Pi
* Internet connection to the Pi (Ethernet or Wi-Fi)
* USB Drive
* Raspbian OS installed on the Pi.

## Setting up Apache2 and PHP:
* To get started launch the Terminal application on your pi then enter as root using the following command:
  * `sudo su`
* After this we need to make sure the Pi is up to date. Use the following command to do so:
  * `apt update`
* When that has been completed, we are ready to install apache2. Use the command:
  * `apt install apache2 -y`
* Now this has completed we need to check that Apache has installed correctly. To do this you need to navigate to the built-in website created by apache by opening the browser on your pi and typing into the box at the top http://localhost/ if it brings up a website saying Apache2 Debian Default Page at the top it has been successful.
* The next thing we will do is install PHP so the new website file we put in will work. Use the following command:
  * `apt install php libapache2-mod-php -y`
# Replacing default website with the custom one:
* The default website for apache2 is located at /var/www/html on the Pi’s filesystem. We need to navigate to this to remove the old file that is there. To do this use this command:
  * `cd /var/www/html`
* Once there we can now remove the old file using the following command:
  * `rm index.html`
* Now that the old file has been removed, we need to add the new file. To do this insert a FAT32 formatted USB drive with the font and website file on it into the pi. Once that has been done you need to know what the USB drive is called for this to work. I recommend changing the drive name to “USB” for ease of use. Now do the following command:
  * `mv /media/pi/USB/index.php /var/www/html`
* This command assumes your user is “pi” and the usb drive name is “USB” if you use a different user on the pi then change “Pi” to your user and change “USB” if the drive name is different.
Now add the font to the same location using the following command:
  * `mv /media/pi/USB/numeral.ttf /var/www/html`
  * (this command will also need changing if your user and usb drives have different names)
* Now this has been completed you should now restart Apache to apply the changes using the following command:
  * `service apache2 restart`
* Now this is done go back to the browser and navigate to http://localhost/ and you should see the launch timer is working correctly!
