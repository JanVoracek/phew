@echo off

if "%PHPBIN%" == "" set PHPBIN=C:\php\php.exe
"%PHPBIN%" "C:\php\phpjasmine" %*
