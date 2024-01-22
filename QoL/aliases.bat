:: Julian Stiebler | 28.04.2023
:: Save this .bat under C:\Windows\Tasks\aliases.bat
:: Create a registry key in Computer\HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Command Processor
:: Type String - NAME=AutoRun & VALUE=[P
:: with Values, NAME=AutoRun & VALUE=C:\Windows\Tasks\aliases.bat
:: then this batch will autorun every time a .cmd is opened and those DOSKEY's will be set.

:: Linux equivalents
DOSKEY ls=dir /B $*
DOSKEY tree=tree /f /a
DOSKEY clear=cls
DOSKEY pwd=echo %cd%

:: Program shortcuts
DOSKEY program=explorer.exe "C:\Path\to\my\program.exe"

:: Virtual Enviroments
DOSKEY activate="C:\my\venv\Scripts\activate.bat"

:: Clear Screen at end
cls
