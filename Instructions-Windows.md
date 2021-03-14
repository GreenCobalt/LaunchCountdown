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
