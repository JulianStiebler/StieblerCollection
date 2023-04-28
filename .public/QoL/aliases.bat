:: Julian Stiebler | 28.04.2023
:: Create registiry key for Computer\HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Command Processor -- String (Zeichenfolge)
:: with Values, NAME=AutoRun & VALUE=[PathToThisBatchScripts]
:: then this will autorun every time a .cmd is opened and those aliases will be set.

:: Linux equivalents
DOSKEY ls=dir /B $*
DOSKEY tree=tree /f /a
DOSKEY clear=cls
DOSKEY pwd=echo %cd%

:: Program shortcuts
DOSKEY github=cd /d "E:\Development\GitHub\"
DOSKEY git=explorer.exe "C:\Users\Stiebler Julian\AppData\Local\GitHubDesktop\GitHubDesktop.exe"
DOSKEY vscode=explorer.exe "E:\Development\Microsoft VS Code\Code.exe"

:: Virtual Enviroments
DOSKEY activate="E:\Development\dev_venv\Scripts\activate.bat"
DOSKEY activate-api="E:\Development\GitHub\PythonFlask_StiebAPI\venv\Scripts\activate.bat"

:: Clear Screen at end
cls