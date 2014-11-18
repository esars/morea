<?php
//class based on code from (Steve Perkins - 21-Jun-2009 11:11):
//http://be2.php.net/manual/en/function.get-browser.php
//http://www.dinke.net/blog/2005/10/30/browser-detection/
//http://chrisschuld.com/
//http://techpatterns.com/downloads/php_browser_detection.php
//info about User Agent Strings:
//http://msdn.microsoft.com/en-us/library/ms537503(VS.85,loband).aspx
//https://developer.mozilla.org/En/User_Agent_Strings_Reference
class Browser
{
    private $agent;
    private $OS;
    private $browser;

    function __construct($userAgent='')
    {
        $this->agent = strtolower($userAgent);
        $this->OS = '';
        $this->browser = '';
        $mathes = '';
        
        //deal with IE
        if(strpos($this->agent,'msie') !== false && strpos($this->agent,'opera') === false && strpos($this->agent,'netscape') === false)
        {
            if(preg_match('/msie ([0-9]{1,2}\.[0-9]{1,2})/',$this->agent, $mathes))
            {
                $this->browser = 'Internet Explorer '.$mathes[1];
            }
        }
        //deal with Gecko based
        elseif(strpos($this->agent,'gecko'))
        {
            //if firefox
            if(preg_match('/firefox\/([0-9]{1,2}\.[0-9]{1}(\.[0-9])?)/',$this->agent,$mathes))
            {
                $arrTmp = explode('/', $this->agent);
                $version = ltrim($arrTmp[sizeof($arrTmp)-1]);
                $this->browser = 'Mozilla Firefox '.$version;
            }
            //if Netscape (based on gecko)
            /*elseif(preg_match('/netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/',$this->agent,$mathes))
            {
                $this->browser = 'Netscape '.$mathes[1];
                
            }*/
            //check chrome before safari because chrome agent contains both
            elseif(preg_match('/chrome\/([^\s]+)/',$this->agent, $mathes))
            {
                $arrTmp = explode('/', $this->agent);
                
                if (substr_count($arrTmp[4], 'opr')==0)
                {    
                    $version = ltrim($arrTmp[3]);
                    $version = str_replace(' safari', '', $version);
                    $version = str_replace(' (khtml, like gecko) chrome', '', $version);
                    $this->browser = 'Google Chrome '.$version;
                }
                else
                {
                    //Opera >= 15
                    $version = ltrim($arrTmp[5]);
                    $this->browser = 'Opera '.$version;
                }
            }
            //if Safari (based on gecko)
            elseif(preg_match('|version/([0-9\.]+)|',  $this->agent,$mathes) && strpos($this->agent, 'safari')!==false)
            {
                $this->browser = 'Safari '.$mathes[1];
            }
            //if Galeon (based on gecko)
            elseif(preg_match('/galeon\/([0-9]{1}\.[0-9]{1}(\.[0-9]{1,2})?)/',$this->agent,$mathes))
            {
                $this->browser = 'Galeon '.$mathes[1];
            }
            //if Konqueror (based on gecko)
            elseif(preg_match('/konqueror\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/',$this->agent,$mathes))
            {
                $this->browser = 'Konqueror '.$mathes[1];
            }
            else
            {
                $this->browser = 'Gecko based';
            }
        }
        //deal with Opera <= v12
        elseif(strpos($this->agent,'opera') !== false)
        {
            if(preg_match('/opera[\/ ]([0-9]{1}\.[0-9]{1}([0-9])?)/',$this->agent,$mathes))
            {
                $arrTmp = explode('/', $this->agent);
                $this->browser = 'Opera '.ltrim($arrTmp[3]);
            }
        }
        //deal with Lynx
        elseif (strpos($this->agent,'lynx') !== false)
        {
            if(preg_match('/lynx\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/',$this->agent,$mathes))
            {
                $this->browser = 'Lynx '.$mathes[1];
            }
        }
        //NN8 with IE string
        /*elseif (strpos($this->agent,'netscape') !== false)
        {
            if(preg_match('/netscape\/([0-9]{1}\.[0-9]{1}(\.[0-9])?)/',$this->agent,$mathes))
            {
                $this->browser = 'Netscape '.$mathes[1];
            }
        }*/
        else 
        {
            $this->browser = 'Unknown browser';
        }
        
        //windows server 2008 & 2008R2 & 2012?
        //check for the most popular OS first
	if (strpos($this->agent, 'windows nt 6.1') !== false)        { $this->OS='Microsoft Windows 7'; }
        elseif (strpos($this->agent, 'windows nt 6.2') !== false)    { $this->OS='Microsoft Windows 8'; }
        elseif (strpos($this->agent, 'windows nt 5.1') !== false)    { $this->OS='Microsoft Windows XP'; }
        elseif (strpos($this->agent, 'windows nt 6.0') !== false)    { $this->OS='Microsoft Windows Vista'; }
        elseif (strpos($this->agent, 'windows 98') !== false)        { $this->OS='Microsoft Windows 98'; }
        elseif (strpos($this->agent, 'windows nt 5.0') !== false)    { $this->OS='Microsoft Windows 2000'; }
        elseif (strpos($this->agent, 'windows nt 5.2') !== false)    { $this->OS='Microsoft Windows 2003 server'; }
        elseif (strpos($this->agent, 'windows nt') !== false)        { $this->OS='Microsoft Windows NT'; }
        elseif (strpos($this->agent, 'win 9x 4.90') !== false && strpos($this->agent, 'win me'))    { $this->OS='Microsoft Windows ME'; }
        elseif (strpos($this->agent, 'windows ce; ppc') !== false)    { $this->OS='Microsoft Pocket PC'; }
        elseif (strpos($this->agent, 'win ce') !== false)            { $this->OS='Microsoft Windows CE'; }
        elseif (strpos($this->agent, 'win 9x 4.90') !== false)        { $this->OS='Microsoft Windows ME'; }
        elseif (strpos($this->agent, 'msie 5.23; mac_powerpc') !== false)        { $this->OS='MacOS'; }
        elseif (strpos($this->agent, 'ipod') !== false)                { $this->OS='iPod'; }
        elseif (strpos($this->agent, 'iphone') !== false)            { $this->OS='iPhone'; }
        elseif (strpos($this->agent, 'mac os x') !== false)            { $this->OS='Mac OS X'; }
        elseif (strpos($this->agent, 'macintosh') !== false)        { $this->OS='Macintosh'; }
        elseif (strpos($this->agent, 'freebsd') !== false)            { $this->OS='Free BSD'; }
        elseif (strpos($this->agent, 'nokia') !== false)            { $this->OS='Nokia'; }
        elseif (strpos($this->agent, 'sonyericsson') !== false)        { $this->OS='SonyEricsson'; }
        elseif (strpos($this->agent, 'samsung') !== false)            { $this->OS='Samsung'; }
        elseif (strpos($this->agent, 'palmsource') !== false)        { $this->OS='Palm OS/Treo'; }
        elseif (strpos($this->agent, 'blackberry') !== false)        { $this->OS='BlackBerry'; }
        elseif (strpos($this->agent, 'symbian') !== false)            { $this->OS='Symbian'; }
        elseif (strpos($this->agent, 'linux') !== false)            { $this->OS='Linux'; }
        elseif (strpos($this->agent, 'lynx') !== false)                { $this->OS='Lynx'; }
        elseif (strpos($this->agent, 'playstation') !== false)        { $this->OS='Playstation'; }
        elseif (strpos($this->agent, 'nintendo wii') !== false)        { $this->OS='Wii'; }
        else { $this->OS='Unknown OS'; }
    }
    
    function __destruct()
    {
    }
    
    function __toString()
    {
        return 'Browser: '.$this->browser.' / OS: '.$this->OS;
    }
    
    /**
     * returns the name and the version of the browser
     * 
     * @return    string    the browser name and it's version
     */
    function getBrowser()
    {
        return $this->browser;
    }
    
    /**
     * returns the name of the OS
     * 
     * @return    string    the OS name
     */
    function getOS()
    {
        return $this->OS;
    }
}
?>
